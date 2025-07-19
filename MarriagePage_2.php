<?php
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

?>






<!DOCTYPEhtml>
<html lang="en-Us">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Apply for Birth Certificate online</title>
<link rel = "Icon" type = "image/x-icon"  href ="Marriage.png"/>
<link rel = "stylesheet" text = "type/css" href = "BirthPage.css"/>
<style>
body{
	
	  border: 1px white;
  position: relative;
  display: flex;
margin:0;
padding:0;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  min-height:100vh;
  flex-wrap:wrap;
      word-wrap: break-word;
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
	border : 1px solid;
	border-radius:10px;
	margin-top:30px;
	padding-top:10px;
	padding-bottom:1vh;
	display:flex;
	flex-direction:column;
	font-size:clamp (2.5vh,4vh,5vh);
	font-family:verdana;
	align-items:center;
	justify-content:center;
	width:70vw;
	height:250vh;
	
	max-width:1400px;
	overflow:hidden;
	
}

#foot{


}
</style>
</head>
<body><section class="container">
<h1>Please Fill the entries to get a Marriage Certificate</h1>


<form action="" name="MarrC" onsubmit =  "return Val_Marr()" enctype="multipart/form-data" method="post">

<div id="block_1">

<label for="husband_name">
Marriage of
<input type="text" name="husband_name" placeholder="Husband's Name"
required="required" id="_hName" autocomplete="false"/>
</label>
<P>

<label for="wife_name">
And of 
<input type="text" name="wife_name" placeholder="Wife's Name"
required="required" autocomplete="false" id="_wName"/>
</label>
<p>

<label for="dob">
Date of Marriage
<input type="date" name="spouse_dom" value="" 
id = "_dom" required="required" autocomplete="false"/>
</label>
</div>
<div id="line"></div>

<h1> Before us appear Publicly</h2>

<div id="block_2">

<label for="husband_name">
Mr
<input type="text" name="husband_name" placeholder="Husband's Name"
required="required" required="required" id="_confirmhName" autocomplete="false"/>
</label>
<p>

<label for="husband_dob">
Date of Birth
<input type="date" name="hus_dob" value="" 
id = "_hdob"  placeholder="" required="required" autocomplete="false"/>
</label>
<p>

<label for="husband_pob">
Place of Birth
<input type="text" name="h_pop" value="" 
id = "_hpop" required="required" placeholder="Town or  Village" autocomplete="false"/>
</label>
<p>

<label for="husband_occupation">
Ocuppation
<input type="text" name="h_occ" value="" 
id = "_hOcc"  placeholder="" required="required" autocomplete="false"/>
</label>
<p>

<label for="husband_national">
Nationality
<input type="text" name="h_nation" value="" 
id = "_hNa"  placeholder="" autocomplete="false"/>
</label>
<p>

<label for="husband_referenceDoc">
Reference Document
<input type="num" name="h_ref" value="" 
id = "_hRef" required="required" placeholder="Id card Number" autocomplete="false"/>
</label>
<p>
<div id="loader"></div>
<label for="husband_Resident">
Resident
<input type="text" name="h_red" value="" 
id = "_hRed" placeholder="" autocomplete="false"/>
</label>
<p>

<label for="hf_name">
Son of 
<input type="text" name="hus_fath_name" placeholder="Husband Father's Name"
id="_fhName" autocomplete="false"/>
</label>
<p>

<label for="hm_name">
and of
<input type="text" name="hus_moth_name" placeholder="Husband Mother's Name"
  id="_mhName" autocomplete="false"/>
</label>
</div>

<div id="block_2">

<label for="Wife_name">
Mrs
<input type="text" name="Wife_name" placeholder="Wife's Name"
required="required" required="required" id="_confirmwName" autocomplete="false"/>
</label>
<p>

<label for="Wife_dob">
Date of Birth
<input type="date" name="wus_dob" value="" 
id = "_wdob"  placeholder="" required="required" autocomplete="false"/>
</label>
<p>

<label for="Wife_pob">
Place of Birth
<input type="text" name="w_pop" value="" 
id = "_wpop" required="required" placeholder="Town or  Village" autocomplete="false"/>
</label>
<p>

<label for="Wife_occupation">
Ocuppation
<input type="text" name="w_occ" value="" 
id = "_wOcc"  placeholder="" required="required" autocomplete="false"/>
</label>
<p>

<label for="Wife_national">
Nationality
<input type="text" name="w_nation" value="" 
id = "_wNa"  placeholder="" autocomplete="false"/>
</label>
<p>

<label for="Wife_referenceDoc">
Reference Document
<input type="num" name="w_ref" value="" 
id = "_wRef" required="required" placeholder="Id card Number" autocomplete="false"/>
</label>
<p>

<label for="Wife_Resident">
Resident
<input type="text" name="w_red" value="" 
id = "_wRed" placeholder="" autocomplete="false"/>
</label>
<p>

<label for="wf_name">
Daughter of 
<input type="text" name="wif_fath_name" placeholder="Wife Father's Name"
 id="_fwname" autocomplete="false"/>
</label>
<p>

<label for="wm_name">
and of
<input type="text" name="wif_moth_name" placeholder="Wife Mother's Name"
  id="_mwname" autocomplete="false"/>
</label>
</div>
<div id="line"></div>

<h2>Matrimonal Consentment</h2>



<div id="block_5">

<label for="mat">
Matrimonal Regime
<select name="Matrimonal" id = "mat_reg" class="matri" required="required">
<option value="null">Choose an option</option>
<option value="joint">Joint Property</option>
<option value="separate"> Separate Property</option>
</select>
</label>
<p>

<label for="type_Marriage">
Type of Marriage
<select name="Marriage_type" id = "marr_type" class="marr_type" required="required">
<option value="null">Choose an option</option>
<option value="mono">Monogamy</option>
<option value="poly">Polygamy</option>
</select>
</label>
<p>

<label for="pic">
4X4 Image of Married Couples
<input type="file" accept="image/jpeg" required="required"
id="img_couple"/>
</label>
</div>

<strong> Please review the entries entered above before saving the information</strong>
<p>
 
 <input type="checkbox" name="appr" value="appr" 
id = "_appr" required="require" autocomplete="false"/>
All Informations provided are accurately valid.
</div>

<P>
<input type="submit" value="Save" id="save"/>

</form>
<div id ="foot"></div>
<script src = "Marriage.js"></script>
</section></body>
</html>