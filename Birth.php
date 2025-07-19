<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Methods: Content-Type,Accept');  // Fix header name
file_put_contents('post_debug_2.log', print_r($_POST, true));
require_once 'DBS_config.php';
 
 
	
	//setting secure session cookie params at session start(especially if using htpps)
	session_set_cookie_params([
	'lifetime'=> 0, //session cookie, ends when browser closes
	'path' =>'/',
	//'domain' =>'my _domain' PLACED THIS HERE IF I HAVE A domain
	'secure'=>true, // true if HTTPS
	'httponly'=>true,
	'samesite'=>'Strict', //OR 'Lax' DEPENDING ON ME!!
	]);
	

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
elseif(($_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) ||
	$_SESSION['ip'] !== $_SERVER['REMOTE_ADDR']){
	session_unset();
	session_destroy();
	die("Session Hijacking attempt detected");
	
	}
	

//if the identifier was set as a session varaible then redirect back to login.html	
if(!isset($_SESSION['user_ident']))
{header("Location:login.html");exit;}

$user_id = $_SESSION['user_ident'];



$connection = mysqli_connect(db_host, db_username, db_password, db_name);



  	//check connection
if (mysqli_connect_errno()) {
    http_response_code(500);
    die("Connection failed: " . mysqli_connect_error());
}



// Check if POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  

    // Sanitize inputs
    $region = filter_var(trim($_POST['region']), FILTER_SANITIZE_STRING);
    $division = filter_var(trim($_POST['division'] ?? ''), FILTER_SANITIZE_STRING);
    $subdivision = filter_var(trim($_POST['subdivision'] ?? ''), FILTER_SANITIZE_STRING);
    $child_name = filter_var(trim($_POST['ch_name'] ?? ''), FILTER_SANITIZE_STRING);
    $child_pob = filter_var($_POST['child_pob']);
    $child_dob = filter_var($_POST['child_do'] ?? '');
    $gender = $_POST['child_gender'] ?? '';
	
    $father_name = filter_var(trim($_POST['father_name'] ?? ''), FILTER_SANITIZE_STRING);
    $father_pob = filter_var(trim($_POST['father_pob'] ?? ''), FILTER_SANITIZE_STRING);
    $f_dob = filter_var(trim($_POST['father_dob'] ?? ''));
     $father_dob = !empty($f_dob)?$f_dob:null;
	 
    $father_red = filter_var(trim($_POST['father_red'] ?? ''), FILTER_SANITIZE_STRING);
    $father_occ = filter_var(trim($_POST['father_occ'] ?? ''), FILTER_SANITIZE_STRING);

    $mother_name = filter_var(trim($_POST['Mother_name'] ?? ''), FILTER_SANITIZE_STRING);
    $mother_pob = filter_var(trim($_POST['Mother_pob'] ?? ''), FILTER_SANITIZE_STRING);
	
    $m_dob = filter_var(trim($_POST['Mother_dob'] ?? ''), FILTER_SANITIZE_STRING);
	$mather_dob = !empty($m_dob)?$f_dob:null;
	
    $mother_red = filter_var(trim($_POST['Mother_red'] ?? ''), FILTER_SANITIZE_STRING);
    $mother_occ = filter_var(trim($_POST['Mother_occ'] ?? ''), FILTER_SANITIZE_STRING);
	echo $child_name;

	
    // Insert into database using prepared statement
    $query = "INSERT INTO birthreg (
        User_identifier,BirthReg_region, BirthReg_div, BirthReg_subdiv, BirthReg_childName, BirthReg_dob,
        BirthReg_pob, BirthReg_Gender, BirthReg_fatherName,BirthReg_fatherDob,BirthReg_fatherPob,
        BirthReg_fatherRed, BirthReg_motherName, BirthReg_motherDob, BirthReg_motherpob,
        BirthReg_motherRed, BirthReg_motherOcc, BirthReg_fatherOcc
    ) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

     $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param( $stmt,"ssssssssssssssssss",
        $user_id,$region, $division, $subdivision, $child_name, $child_dob,
        $child_pob, $gender, $father_name, $father_dob, $father_pob,
        $father_red, $mother_name, $mother_dob, $mother_pob,
        $mother_red, $mother_occ, $father_occ
    );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
mysqli_close($connection);
    // CSV Export
    $Birth_file = 'Birth.csv';
  
   $fp = fopen($Birth_file, 'a');

    if (!(file_exists($Birth_file))) {
        // Write header
		
        fputcsv(true, [
            'Region', 'Division', 'Sub Division', 'Child Name', 'Child Pob', 'Child Dob', 'Child Gender',
            'Father Name', 'Father Pob', 'Father Dob', 'Father Red', 'Father Occ',
            'Mother Name', 'Mother Pob', 'Mother Dob', 'Mother Red', 'Mother Occ'
        ]);
    }
	else{
		 $fp = fopen($Birth_file, 'a');
	}

    // Write data row
    fputcsv(true, [
        $region, $division, $subdivision, $child_name, $child_pob, $child_dob, $gender,
        $father_name, $father_pob, $father_dob, $father_red, $father_occ,
        $mother_name, $mother_pob, $mother_dob, $mother_red, $mother_occ
    ]);

    fclose($fp);

    // Respond
   
    exit;
}
?>
