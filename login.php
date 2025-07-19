<?php

	ini_set('display_errors',1);
	error_reporting(E_ALL);
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods:GET,POST,PUT,DELETE,OPTIONS');
	header('Access-Control-Allow-Methods:Content-Type,Accept');
	require_once 'DBS_config.php';
	file_put_contents('post_debug.log', print_r($_POST, true));
	
	//setting secure session cookie params at session start(especially if using htpps)
	session_set_cookie_params([
	'lifetime'=> 0, //session cookie, ends when browser closes
	'path' =>'/',
	//'domain' =>'my _domain' PLACED THIS HERE IF I HAVE A domain
	'secure'=>true, // true if HTTPS
	'httponly'=>true,
	'samesite'=>'Strict', //OR 'Lax' DEPENDING ON ME!!
	]);
	
	//start session
		session_start();
	


//this code below prevents session hijacking where someone steals a session ID via XSS,network sniffing....
//and tries to use it in another browser
//the user agent is a quick way to detect abnormal behaviour
if(!isset($_SESSION['user_agent'])){
	$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
}
elseif(($_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT'] )||
	($_SESSION['ip'] !== $_SERVER['REMOTE_ADDR'])){
	session_unset();
	session_destroy();
	die("Session Hijacking attempt detected");
	
	}
///SESSION HIJACKING PROTECTION ABOVE


	$connection = mysqli_connect(db_host,db_username,db_password,db_name);

	
		
	//check connection
if (mysqli_connect_errno()) {
    http_response_code(500);
    die("Connection failed: " . mysqli_connect_error());
}

	if($_SERVER["REQUEST_METHOD"]=="POST"){
	//Collecting the type from login.js form
	$type = $_POST['certificate_type'] ?? '';
	
	//collecting password and identifier
	$identifier = $_POST['identifier_'] ?? '';
	$password = $_POST['pwd'] ?? '';
	
	
	
	//authentication and session
	//checks if user exist in the dbs if true session is created

	$sql = "SELECT * FROM login_authen WHERE User_identifier = ?";
	$s = mysqli_prepare($connection,$sql);
	mysqli_stmt_bind_param($s,"s",$identifier);
	mysqli_stmt_execute($s);
	$result = mysqli_stmt_get_result($s);
	$user = mysqli_fetch_assoc($result);
	
	
	if($user && password_verify($password,$user['User_Authen_pwd']))
	{
		//if identifier and password exist we create session varibles
		//session id regenration after login help prevent session fixation
		session_regenerate_id(true);
		
		//session varibles to be used throughout if login succesful
		$_SESSION['user_ident'] = $user['User_identifier'];
		$_SESSION['username'] = $user['User_Authen_Name'];
		$_SESSION['user_email'] = $user['User_Authen_email'];
		$_SESSION['certificate_type'] = $type;
		
		
		//Checking if the user choosed birth or marriage
		if($_SESSION['certificate_type']=='birth')
		{echo 'successBirth';}
	
		if($_SESSION['certificate_type']=='marriage')
		{echo'successMarriage';}
	
		exit;
	}
	else {
		echo "Not Success";
	}

	mysqli_stmt_close($s);
}
	
	
		mysqli_close($connection);
	?>