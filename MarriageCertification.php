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
	

//if the identifier was set as a session varaible then redirect back to login.html	
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
$sql = "SELECT * FROM marriagereg WHERE User_identifier = ? ORDER BY MarriageReg_MarriageDob DESC";
$s = mysqli_prepare($connection,$sql);
	mysqli_stmt_bind_param($s,"s",$identifier);
	mysqli_stmt_execute($s);
	$result = mysqli_stmt_get_result($s);
	$row = mysqli_fetch_assoc($result);
	
	
	
// === Step 1: Load Spreadsheet ===
$input = 'MarriageCertificateFile.xlsx'; // Change this if you already have a file

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
$entry = [
    $row['MarriageReg_husbandName'], $row['MarriageReg_WifeName'],
	$row['MarriageReg_MarriageDob'],$row['MarriageReg_husbandDob'],
	$row['MarriageReg_husbandOcc'],$row['MarriageReg_husbandRed'],
	$row['MarriageReg_husbandFather'],$row['MarriageReg_husbandMother'],
	$row['MarriageReg_wifeDob'],$row['MarriageReg_wifeOcc'],
	$row['MarriageReg_wifeRed'],$row['MarriageReg_wifeFather'],
	$row['MarriageReg_wifeMother'],$row['MarriageReg_MatReg'],
	$row['MarriageReg_MarrType']
	];

	//Providing the entries to the files
    $sheet->setCellValue("B6", $entry[0]);
	$sheet->setCellValue("B7", $entry[1]);
	$sheet->setCellValue("B8", $entry[2]);
	 
	$sheet->setCellValue("B10", $entry[0]);
	 $sheet->setCellValue("B11", $entry[3]);
	 $sheet->setCellValue("B12", $entry[4]);
	 $sheet->setCellValue("B13", $entry[5]);
	 $sheet->setCellValue("B14", $entry[6]);
	 $sheet->setCellValue("B15", $entry[1]);
	 $sheet->setCellValue("B16", $entry[7]);
	 $sheet->setCellValue("B17", $entry[8]);
	 $sheet->setCellValue("B18", $entry[9]);
	 $sheet->setCellValue("B19", $entry[10]);
	 $sheet->setCellValue("B20", $entry[11]);
	 $sheet->setCellValue("B21", $entry[12]);
	
	 $sheet->setCellValue("B22", $entry[13]);
	 $sheet->setCellValue("B23", $entry[14]);
	 
	 

	
	
	//Save the entries in the file
	$writer  = new xlsx($spreadsheet);
	$writer->save($input);
	

	$outputDir =__DIR__;//directory of this project folder


	//library office always create the pdf file 
	//and saves it as the name of the original file
    $officepath='"C:\\Program Files\\LibreOffice\\program\\soffice.exe"';
	$command = "$officepath --headless --convert-to pdf \"$input\" --outdir \"$outputDir\"";
	exec($command,$output,$resultCode);
	//file converted saved as the originalname.pdf
	
	
	$outputfile = "MarriageCertificateFile.pdf";//filename must match that produced by libraryoffice
	
	
	//if resultCode is 0 and output file exist 
	if ($resultCode === 0){
	
	//Sending the pdf file to header so that readfile() can read it  
	 header('Content-Type:application/pdf');
	 header('Content-Disposition:attachment;filename="' . basename($outputfile) . '"');
	 header('Content-Length:'.filesize($outputfile));
	 //make sure incase of error the downloaded file will redownload
	 //no cache, no store
	 header('Cache-Control: no-store,no-cache,must-revalidate,max-age=0');
	 header('Expires:0');
	 header('Pragma:no-cache');
	 
	 flush (); //flush the headers
	 
	 //readfile() must read the file that libreoffice produces
	 //clean and clear buffer
	 readfile($outputfile);
	
	
	ob_end_clean(); //clear output buffer
	
	
	//clearing the entries of the original file
	$sheet -> fromArray(array_fill(0,$sheet->getHighestRow(), array_fill(0, $sheet->getHighestColumn(), '')));
	$writer = new Xlsx($spreadsheet);
	$writer->save($input);
	
	exit;
	header('Location:Marriagepage_1.php');
	}
	
	else {
		echo "<script>alert('No record found')</script>";
	}
	//add an html code below 
?>