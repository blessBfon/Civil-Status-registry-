<?php 
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

?>




<!DOCTYPEhtml>
<html lang="en-Us">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Apply for Birth Certificate online</title>
<link rel = "Icon" type = "image/x-icon"  href ="Birth.png"/>
<link rel = "stylesheet" text = "type/css" href = "BirthPage.css"/>
<style>
body{
	
	  border: 1px white;
  position: relative;
  display: flex;
  margin-bottom:50px;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  min-height:1vh;


}

#loader {
      display: none;
      border: 6px solid #f3f3f3;
      border-top: 6px solid #3498db;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      animation: spin 1s linear infinite;
      margin: 20px auto;
	  bottom:50%;
	  top:50%;
	  left:50%;
	  right:50%;
	  z-index:1000;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    #result {
      margin-top: 20px;
      font-family: Arial, sans-serif;
    }
.container{
	border : 1px ;
	border-radius:10px;
	margin-top:30px;
	padding-top:10px;
	padding-bottom:80vh;
	display:flex;
	flex-direction:column;
	font-size:2.5vh;
	font-family:verdana;
gap:50px;
width:600px;
height:630px;


}
</style>
</head>
<body><section class="container">
<h1>Please Fill the entries to get a Birth Certificate</h1>


<form action="" name="BirthC" onsubmit="return Val_Birth()"  enctype="multipart/form-data" method="post">

<div id="block_1">

<label for="regions">
Choose your Region 
<select name="region" id="region" required="required">
<option value="NORTH">NORTH</option>
<option value="FAR_NORTH">FAR NORTH</option>
<option value="CENTRAL">CENTRAL</option>
<option value="LITTORAL">LITTORAL</option>
<option value="NORTHWEST">NORTHWEST</option>
<option value="SOUTHWEST">SOUTHWEST</option>
<option value="EAST">EAST</option>
<option value="SOUTH">SOUTH</option>
<option value="ADAMAWA">ADAMAWA</option>
<option value="WEST">WEST</option></select>
</label>
<P>

<label for ="Division"> Division
<input type="text" name="division" value="" 
id = "_div" required="required" autocomplete="false"/>
</label>
<p>

<label for ="sub_division">Sub Division 
<input type="text" name="subdivision" value="" 
id = "subdivi" required="required" autocomplete="false"/>
</label>

</div>
<div id="line"></div>
<div id="block_2"><h2>Child's Information</h2>

<label for="name">
Name
<input type="text" name="ch_name" value="" 
id = "_chname" required="required" autocomplete="false"/>
</label>
<p>

<label for="dob">
Date of Birth
<input type="date" name="child_do" value="" 
id = "_dob" required="required" autocomplete="false"/>
</label>
<p>

<label for="pob">
Place of Birth
<input type="text" name="child_pob" value="" 
id = "_pob" required="require" placeholder="Town" autocomplete="false"/>
</label>
<p>
<div id="loader"></div>
<label for="sex">
Gender

<input type="radio" name="child_gender" value="Male" 
id = "_gender" required="require" autocomplete="false"/>
Male

<input type="radio" name="child_gender" value="Female"
id = "_gender" required="require" autocomplete="false"/>
Female

</label>
</div>

<div id="line"></div>

<div id="block_2">

<h2>Parent's Information</h2>

<label for="father_name">
Father's Name
<input type="text" name="father_name" value="" 
id = "_FN"  placeholder="" autocomplete="false"/>
</label>
<p>

<label for="father_dob">
Father's Date of Birth
<input type="date" name="father_dob" value="" 
id = "_Fdob"  placeholder="" autocomplete="false"/>
</label>
<p>

<label for="father_pob">
Father's Place of Birth
<input type="text" name="father_pop" value="" 
id = "_Fpob"  placeholder="" autocomplete="false"/>
</label>
<p>

<label for="father_Resident">
Father's Resident
<input type="text" name="father_red" value="" 
id = "_FRed" placeholder="" autocomplete="false"/>
</label>
<p>

<label for="father_occupation">
Father's Ocuppation
<input type="text" name="father_occ" value="" 
id = "_FOcc"  placeholder="" autocomplete="false"/>
</label>
<p>

<label for="Mother_name">
Mother's Name
<input type="text" name="Mother_name" value="" 
id = "_MN"  placeholder="" autocomplete="false"/>
</label>
<p>

<label for="Mother_dob">
Mother's Date of Birth
<input type="date" name="Mother_dob" value="" 
id = "_Mdob"  placeholder="" autocomplete="false"/>
</label>
<p>

<label for="Mother_pob">
Mother's Place of Birth
<input type="text" name="Mother_pop" value="" 
id = "_Mpop"  placeholder="" autocomplete="false"/>
</label>
<p>

<label for="Mother_Resident">
Mother's Resident
<input type="text" name="Mother_red" value="" 
id = "_MRed" placeholder="" autocomplete="false"/>
</label>
<p>

<label for="Mother_occupation">
Mother's Ocuppation
<input type="text" name="Mother_occ" value="" 
id = "_MOcc"  placeholder="" autocomplete="false"/>
</label>
</div>
<p>

<div id="block_5">
<strong> Please review the entries entered above before saving the information</strong>
 <p>
 
 <input type="checkbox" name="appr" value="" 
id = "_appr" required="require" autocomplete="false"/>
All Informations provided are accurately valid.
</div>

<input type="submit" id = "save" value="Save"/>
<p>


</form>
<div id ="foot"></div>
<script src = "Birth.js"></script>
</section></body>
</html>