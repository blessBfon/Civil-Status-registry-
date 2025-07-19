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
{header("Location:login.html");}


if(isset($_POST['logout']))
{
	session_unset();
	session_destroy();
	//if the logout btn which has post method is set or clicked 
	//destory the sessoin and go back to login page
	header("Location:Civil.html");
	exit;
}
?>

<!DOCTYPEhtml><html lang="en-Us"><head><meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Apply for Birth Certificate online</title>
<link rel = "Icon" type = "image/x-icon"  href ="Birth.png"/>

<style>
body{
	
	  border: 1px white;
  position: relative;
  display: flex;
  margin:0;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  min-height:1vh;
  flex-wrap:wrap;
      word-wrap: break-word;
}

.container{
	border : 1px ;
	border-radius:20px;
	position:relative;
	
	display:in-block;
	
padding:10px;
width:1200px;
height:430px;
top:100px;

}

#Cred{
	border:3px solid white;
	box-shadow:0px 0px 10px rgb(0,0,0,0.2);
	display:flex;
	justify-content:center;
	align-items:center;
	flex-direction:column;
	gap:10px;
	font-size:2vh;
	font-family:Verdana;
	height:400px;
	width:250px;
}

#proceed{
	border:3px ;
	display:flex
	justify-content:center;
	flex-direction:column;
	font-size:2vh;
	gap:20px;
	flex-wrap:wrap;
	height:50vh;
	width:50vw;
	font-family:Verdana;
	position:relative;
	bottom:700px;
	left:500px;
	}

p{ border:2px line black;}


button{
	border: 2px solid #fdd017;
	border-radius:5px;
	color:#fdd017;
	width:200px;
	height:35px;
	text-align:center;
	font-size:3vh;
	background-color:transparent;
	
}


#logout-btn-{	
border: 2px solid #fdd017;
	border-radius:5px;
	color:#fdd017;
	width:200px;
	height:35px;
	text-align:center;
	font-size:3vh;
	background-color:transparent;}
	
#logout-btn-:hover{cursor:pointer;
	outline-color:#fdd017;
	color:#FFFFFF;
	background-color:#fdd017;}
	
	
	
p{
	position:relative;
	top:200px;
	}
	
	
button:hover{	
	cursor:pointer;
	outline-color:#fdd017;
	color:#FFFFFF;
	background-color:#fdd017;
	}
	
	
#line{
	border:1px solid;
	width:0vw;
	height:50vh;
	position:relative;
	bottom:400px;
	left:300px;
	}

img{
	content: url('User_logo.png');
	width:35%;
	height:25%;
}
</style>


</head>
<body>
<section class="half_screen">
<section class ="container">
<section id = "Cred">
<img/>
 Username<b><?=$_SESSION['username']?></b>
 Email<b><?=$_SESSION['user_email']?></b>
 identifier<b><?= htmlspecialchars($_SESSION['user_ident']) ?><p></b>
 
<form action="" method="post">
 <input type ="submit" value= "Log-out" id = "logout-btn-" name="logout"/>
 </form>
 </section>
 
<div id="line">
</div>
<section id="proceed">
Welcome <b><?= $_SESSION['username'] ?></b>, your now loggged in. To Proceed to apply for Marriage
Certificate Online Click on 
<a href="http://localhost/CIVIL%20STATUS%20REGISTRY/MarriagePage_2.php"> 
<button>Apply</button>
</a>

<p>
To get Certificate click on
<a href="MarriageCertification.php" target="_new">Get Marriage Certificate</a>
</section>

</section>
</section>
</body>
</html>