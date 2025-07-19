<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods:GET,POST,PUT,DELETE,OPTIONS');
	header('Access-Control-Allow-Methods:Content-Type,Accept');
	require_once 'DBS_config.php';
	file_put_contents('post_debug.log', print_r($_POST, true));
	
	//Mailing the Identifier to the user	
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust path if not using Composer
	$connection = mysqli_connect(db_host,db_username,db_password,db_name);
	
	
	//check connection
if (mysqli_connect_errno()) {
    http_response_code(500);
    die("Connection failed: " . mysqli_connect_error());
}

		if($_SERVER["REQUEST_METHOD"]=="POST"){

	$first_name = filter_var(trim($_POST['username'] ?? ''),FILTER_SANITIZE_STRING);
	$last_name = filter_var(trim($_POST['username_2'] ?? ''),FILTER_SANITIZE_STRING);
	$user_pob = filter_var(trim($_POST['POB'] ?? ''),FILTER_SANITIZE_STRING);
	$user_dob = filter_var($_POST['DOB'] ?? '');
	$user_email = filter_var(trim($_POST['email'] ?? ''),FILTER_SANITIZE_EMAIL);
	$user_id_num = ($_POST['id_num'] ?? '');
	
	//we dont sanitize password as it will weaken their security as it removes certain character
	//so we hash them simply
	$user_pwd = $_POST['pwd'] ?? '';
	$user_hashed_pwd = password_hash($user_pwd,PASSWORD_DEFAULT);
	
	$user_cpwd = $_POST['cpwd'] ?? '';
	$user_hashed_cpwd = password_hash($user_cpwd,PASSWORD_DEFAULT);
	
	$user_tel = filter_var(trim($_POST['tel'] ?? ''),FILTER_SANITIZE_NUMBER_INT);
	
	$user_gender = $_POST['gender'] ?? '';
	
	//Make sure the identification number to inserted doesnt nexist in the table
	$sql = "SELECT * FROM user WHERE User_idn = ?";
	$m = mysqli_prepare($connection,$sql);
	mysqli_stmt_bind_param($m,"s",$user_id_num);
	mysqli_stmt_execute($m);
	$result = mysqli_stmt_get_result($m);
	$user = mysqli_fetch_assoc($result);
	//after collecting all rows user_idn is bounded to user_id_num 
	//and verify if it exist an echo is sent from php to js to throw an alert message
	//else insertion of new entries is proceeded and generation of new identifier is stored
	
	if($user)
	
	{echo'exist'; }
	
	else{
	
	
	
//submit to the dbs table
$query = "INSERT INTO user(User_firstName,User_lastName,User_pob,User_dob,User_emailAdr, 
	User_idn,User_pwd,User_tel,User_gender) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";	
	   
	  $s = mysqli_prepare($connection,$query);
	  mysqli_stmt_bind_param($s,"sssssssss",$first_name,$last_name,$user_pob,$user_dob,$user_email,$user_id_num,$user_hashed_pwd,$user_tel,$user_gender);
	  mysqli_stmt_execute($s);
	mysqli_stmt_get_result($s);

	
	
		
			//?? find a way to generate the user_identifier ?? 
			
			//default $generated_user_identifier='000000000001';
			
			
			//generating the user_identifer
			$var_extrac = substr($user_id_num,0,6);//extracting  first 6 character from id_num
			$var_rand_extrac = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'),0,6);//random extraction of 6 characters
			//concatenating the 2 varibles above to make the identifier which will be stored in the database
			
			$generated_user_identifier = $var_extrac . $var_rand_extrac;
			
			$name = $first_name.' '.$last_name;
			
			
			$sql_2 = "INSERT INTO login_authen(User_Authen_Name,User_identifier,User_Authen_pwd,User_Authen_email) VALUES(?,?,?,?)";
			$q = mysqli_prepare($connection,$sql_2);	
			 mysqli_stmt_bind_param($q,"ssss",$name,$generated_user_identifier,$user_hashed_pwd,$user_email);
			mysqli_stmt_execute($q);
			 mysqli_stmt_close($q);
			//?? user identifier will be sent to user through mail or sms??
	
	
	
	
	

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $emailTo = $user_email;  // Your email here
 
    $mail = new PHPMailer(true);
 
    try {
        //Server settings
        $mail->isSMTP();
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = 'smtp.gmail.com'; // Your SMTP server
		//i use my gmail account as my smtp server but for development and deployment
		//i would have to use a third party service like sendgrid,mailtrap,aha send,smtp2go,mailersend
		
        $mail->SMTPAuth = true;
		 $mail->SMTPSecure = 'tls'; // or 'ssl'
        $mail->Port = 587; // SMTP port

        $mail->Username = 'blessfonmtoh@gmail.com'; // SMTP username
        $mail->Password = '@Esselb102102'; // SMTP password
       
        //Recipients
        $mail->setFrom('blessfonmtoh@gmail.com', 'fonbless blessmtoh');
        $mail->addAddress($user_email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'New Registration Data';
        $mail->Body    = "<h3>New Registration Submitted</h3>
                          <p><strong>Identifier:</strong> {$generated_user_identifier}</p>
                          <p><strong>Username:</strong> {$name}</p>";

        $mail->send();
        echo json_encode(['success' => true, 'message' => 'Email sent successfully']);
    }


	catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => "Mailer Error: {$mail->ErrorInfo}"]);
    }
	
	
}

 else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}




	}
		echo json_encode(["success"=> true]);
	mysqli_close($connection);
	
	}
exit;

?>