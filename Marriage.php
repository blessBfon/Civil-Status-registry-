<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Methods: Content-Type,Accept');
  
file_put_contents('post_debug_1.log', print_r($_POST, true));//fetch items

require_once 'DBS_config.php';//dbs configuration file

	
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

//dbs connection
$connection = mysqli_connect(db_host, db_username, db_password, db_name);


 if (mysqli_connect_errno()) {
    http_response_code(500);
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	
//COLLECTION OF INPUTS FROM JS FETCH AND FILTERING..--------------------------------
    $husband_name = filter_var(trim($_POST['husband_name'] ?? ''), FILTER_SANITIZE_STRING);
    $wife_name = filter_var(trim($_POST['wife_name'] ?? ''), FILTER_SANITIZE_STRING);
    $dateOfMarr = filter_var($_POST['spouse_dom'] ?? '');

    $hus_pob = filter_var($_POST['h_pop'] ?? '', FILTER_SANITIZE_STRING);
    $hus_dob = filter_var($_POST['hus_dob'] ?? '', FILTER_SANITIZE_STRING);
    $hus_red = filter_var(trim($_POST['h_red'] ?? ''), FILTER_SANITIZE_STRING);
    $hus_ref = filter_var(trim($_POST['h_ref'] ?? ''), FILTER_SANITIZE_STRING);
    $hus_nat = filter_var(trim($_POST['h_nation'] ?? ''), FILTER_SANITIZE_STRING);
    $hus_occ = filter_var(trim($_POST['h_occ'] ?? ''), FILTER_SANITIZE_STRING);
    $hus_father_name = filter_var(trim($_POST['hus_fath_name'] ?? ''), FILTER_SANITIZE_STRING);
    $hus_mother_name = filter_var(trim($_POST['hus_moth_name'] ?? ''), FILTER_SANITIZE_STRING);

    $wife_pob = filter_var($_POST['w_pop'] ?? '', FILTER_SANITIZE_STRING);
    $wife_dob = filter_var($_POST['wus_dob'] ?? '', FILTER_SANITIZE_STRING);
    $wife_red = filter_var(trim($_POST['w_red'] ?? ''), FILTER_SANITIZE_STRING);
    $wife_ref = filter_var(trim($_POST['w_ref'] ?? ''), FILTER_SANITIZE_STRING);
    $wife_nat = filter_var(trim($_POST['w_nation'] ?? ''), FILTER_SANITIZE_STRING);
    $wife_occ = filter_var(trim($_POST['w_occ'] ?? ''), FILTER_SANITIZE_STRING);
    $wife_father_name = filter_var(trim($_POST['wus_fath_name'] ?? ''), FILTER_SANITIZE_STRING);
    $wife_mother_name = filter_var(trim($_POST['wus_moth_name'] ?? ''), FILTER_SANITIZE_STRING);

    $mat_regime = filter_var(trim($_POST['Matrimonal'] ?? ''), FILTER_SANITIZE_STRING);
    $marr_type = filter_var(trim($_POST['Marriage_type'] ?? ''), FILTER_SANITIZE_STRING);
//END OF INPUT COLLECTION---------------------------------------------------



//INSERTING TO DATABASE-----------------------------------------------------

      $query = "INSERT INTO marriagereg(
        User_identifier,MarriageReg_husbandName, MarriageReg_WifeName, MarriageReg_MarriageDob, MarriageReg_husbandDob, 
        MarriageReg_husbandPob, MarriageReg_husbandOcc, MarriageReg_husbandNat, MarriageReg_husbandIdn, 
        MarriageReg_husbandRed, MarriageReg_husbandFather, MarriageReg_husbandMother, MarriageReg_wifeDob, 
        MarriageReg_wifePob, MarriageReg_wifeOcc, MarriageReg_wifeNat, MarriageReg_wifeIdn, MarriageReg_wifeRed, 
        MarriageReg_wifeFather, MarriageReg_wifeMother, MarriageReg_MatReg, MarriageReg_MarrType
    ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssss",
        $user_id,$husband_name, $wife_name, $dateOfMarr,
        $hus_dob, $hus_pob, $hus_occ, $hus_nat, $hus_ref, $hus_red, $hus_father_name, $hus_mother_name,
        $wife_dob, $wife_pob, $wife_occ, $wife_nat, $wife_ref, $wife_red, $wife_father_name, $wife_mother_name,
        $mat_regime, $marr_type
    );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
	mysqli_close($connection);
//END FOR DATABASE INSERTION----------------------------------------------


    // CSV file handling------------------------------------------------
    $Marriage_file = 'Marriage.csv';

    if (!file_exists($Marriage_file)) {
        $fp = fopen($Marriage_file, 'w');
        fputcsv(true, array(
            'Husband Name', 'Wife Name', 'Date of Marriage', 'Husband Pob', 'Husband Dob', 'Husband Red', 'Husband Ref', 'Husband Nationality', 'Husband Occ',
            'Husband Father Name', 'Husband Mother Name', 'Wife Pob', 'Wife Dob', 'Wife Red', 'Wife Ref', 'Wife Nationality', 'Wife Occ', 'Wife Father Name', 'Wife Mother Name',
            'Matrimonal Regime', 'Marriage Type'
        ));
    } else {
        $fp = fopen($Marriage_file, 'a');
    }

  	//write the form data to the csv file
	fputcsv(true,array($husband_name,$wife_name,$dateOfMarr,$hus_pob,$hus_dob,$hus_red,$hus_ref,$hus_nat,
	$hus_occ,$hus_father_name,$hus_mother_name,$wife_pob,$wife_dob,$wife_red,$wife_ref,$wife_nat,$wife_occ,
	$wife_father_name,$wife_mother_name,$mat_regime,$marr_type));
	
	fclose($fp);

	 
	}
	//-------------------------------------END FOR CSV FILE---------------
	
	  exit;
	  ?>
	  