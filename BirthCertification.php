<?php

require 'vendor/autoload.php'; // Ensure PhpSpreadsheet is installed via Composer
require_once 'DBS_config.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



//session continues
session_start();


//SESSION HIJACKING PROTECTION
//this code below prevents session hijacking where someone steals a session ID via XSS,network sniffing....
//and tries to use it in another browser
//the user agent is a quick way to detect abnormal behaviour
if(!isset($_SESSION['user_agent'])){
	$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
}
else if(($_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) ||
	$_SESSION['ip'] !== $_SERVER['REMOTE_ADDR']){
	session_unset();
	session_destroy();
	die("Session Hijacking attempt detected");
	}
	

//if the identifier was not set as a session varaible then redirect back to login.html	
if(!isset($_SESSION['user_ident']))
{header("Location:login.html");exit;}


$identifier = $_SESSION['user_ident'];

// Connect to DB
$connection = mysqli_connect(db_host, db_username, db_password, db_name);

//if connection not succesfull
if (!$connection) {
    die("DB connection failed: " . mysqli_connect_error());
}


// Fetch data
$sql = "SELECT * FROM birthreg WHERE User_identifier = ? ORDER BY BirthReg_dob DESC";
$s = mysqli_prepare($connection,$sql);
	mysqli_stmt_bind_param($s,"s",$identifier);
	mysqli_stmt_execute($s);
	$result = mysqli_stmt_get_result($s);
	$row = mysqli_fetch_assoc($result);//collects the entire row for that identifier
	
	
	
// === Step 1:  Load Spreadsheet ===
$input= __DIR__.'/BirthCertificateFile.xlsx'; //My excel file


if (file_exists($input)) {
    $spreadsheet = IOFactory::load($input);//loads file if exists
} else {
    $spreadsheet = new Spreadsheet();
}

//access the activesheet which is the first sheet as $sheet
$sheet = $spreadsheet->getActiveSheet();

//all entries taken from the dbs 
//some will be display
//we could have collected the enties we needed
$entry= [
$row['BirthReg_region'],$row['BirthReg_div'],
$row['BirthReg_subdiv'],$row['BirthReg_childName'] ,
$row['BirthReg_dob'],$row['BirthReg_pob'],
$row['BirthReg_Gender'],($row['BirthReg_fatherName'] ?? ''), 
$row['birthreg_fatherPob'] ?? '' ,$row['Birthreg_fatherDob']?? '' ,
$row['birthreg_fatherRed']?? '' ,$row['birthreg_fatherOcc']?? '',
$row['birthreg_motherName']?? '' ,$row['birthreg_motherpob']?? '' ,
$row['birthreg_motherDob'] ?? '' ,$row['birthreg_motherRed'] ?? '' ,
$row['birthreg_motherOcc'] ?? ''
];


	//Providing the entries to the corresponding fields
    $sheet->setCellValue("B4", $entry[0]);
	$sheet->setCellValue("B5", $entry[1]);
	$sheet->setCellValue("B6", $entry[2]);
	 
	 $sheet->setCellValue("B9", $entry[3]);
	 $sheet->setCellValue("B10", $entry[4]);
	 $sheet->setCellValue("B11", $entry[5]);
	 $sheet->setCellValue("B12", $entry[3]);
	 $sheet->setCellValue("B13", $entry[6]);
	 $sheet->setCellValue("B14", $entry[7]);
	 $sheet->setCellValue("B15", $entry[8]);
	 $sheet->setCellValue("B16", $entry[9]);
	 $sheet->setCellValue("B17", $entry[10]);
	 $sheet->setCellValue("B18", $entry[11]);
	 $sheet->setCellValue("B19", $entry[12]);
	 $sheet->setCellValue("B20", $entry[13]);
	 $sheet->setCellValue("B22", $entry[14]);
	 $sheet->setCellValue("B23", $entry[15]);	
	 $sheet->setCellValue("B24", date("Y-m-d"));
	 
	
	//Save the entries in the file
	$writer  = new xlsx($spreadsheet);
	$writer->save($input);
	

	$outputDir =__DIR__;//directory of this project folder


	//note library office always create the pdf file and saves it as the name of the original file
    $officepath='"C:\\Program Files\\LibreOffice\\program\\soffice.exe"';
	$command = "$officepath --headless --convert-to pdf \"$input\" --outdir \"$outputDir\"";
	exec($command,$output,$resultCode);//file converted saved as the originalname.pdf
	
	
	$outputfile = __DIR__."/BirthCertificateFile.pdf";//filename must match that produced by libraryoffice
	
	//if resultCode is 0 and output file exist 
	if ($resultCode === 0 && file_exists($outputfile)){
	
	//Sending the pdf file to header so that readfile() can read it  
	 header('Content-Type:application/pdf');
	 header('Content-Disposition:attachment;filename="' . basename($outputfile) . '"');
	 header('Content-Length:'.filesize($outputfile));
	 //make sure incase of error the downloaded file will redownload
	 //no cache, no store
	 header('Cache-Control: no-store,no-cache,must-revalidate,max-age=0');
	 header('Expires:0');
	 header('Pragma:no-cache');
	 
	
	 //readfile() must read the file that libreoffice produces
	 //clean and clear buffer
	 //flush()
	 
	 
	 readfile($outputfile);
	//ob_clean;
	
	header('Location:Birthpage_1.php');

	exit;
	}
	
	else {
		echo "<script>alert('No record found')</script>";
	}
	//add an html 
?>
