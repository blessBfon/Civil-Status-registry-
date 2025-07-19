//Login Validation
document.addEventListener('DOMContentLoaded',function(event){
	const btn = document.getElementsByTagName('button');
	event.preventDefault(); 
	btn[0].addEventListener('click',Verifi_);
});
const containsULSD = (k)=>{
	let regex_1 = /[A-Z]/; //uppercase
	let regex_2 = /\d/; //digit
	let regex_3 = /[a-z]/; // lowercase
	let regex_4 = /[!@#$%^&*<>?"'\+=]/; //Symbol
	

	
	let v_1=0;
	let v_2=0,v_3=0,v_4=0;
	
	if(regex_1.test(k))
		v_1++;
	if(regex_2.test(k))
		v_2++;
	if(regex_3.test(k))
		v_3++;
	if(regex_4.test(k))
		v_4++;

		if(v_1>0 && v_2 >0 && v_3>0 && v_4>0)
			return true;
		else
			return false;
}


const pass_func = (p)=>{
	if (p.length >= 8 )
	{
	
			if(containsULSD(p)){
				document.getElementById('pwd_').style.border = "2px solid green";
				document.getElementById('foot').style.display="none";
					
			return true;
			
			}
	
	
		else{
			document.getElementById('pwd_').style.border = "2px solid red";
					
		document.getElementById('foot').style.display="flex";
		document.getElementById("foot").style.justifyContent="center";
		document.getElementById("foot").textContent  = "Password must contain an Uppercase and Lowercase letter(s) \
		, digit(s) and atleast a Special character";
		document.getElementById("foot").style.height="7vh";
		
		
							
					document.getElementById('pwd_').addEventListener("input",function(){
						if (containsULSD(document.getElementById("pwd_").value)){	
						document.getElementById('pwd_').style.border = "2px solid green";
					document.getElementById('foot').style.display="none";
					}}); 
			return false;
		}
	}
	
	
	
	else{
		document.getElementById('pwd_').style.border = "2px solid red";
					
		document.getElementById('foot').style.display="flex";
		document.getElementById("foot").style.justifyContent="center";
		document.getElementById("foot").textContent  = "Password too Small";
		
		
		
		document.getElementById('pwd_').addEventListener("input",function(){
						if ((document.getElementById("pwd_").value).length>=8){	
						document.getElementById('pwd_').style.border = "2px solid green";
					document.getElementById('foot').style.display="none";
					}}); 
		return false;
		
	}}

const ident = (k)=>{
	if(k.length == 12){
		if(/\d/.test(k)){
			document.getElementById('identifier_').style.border = "2px solid green";
				document.getElementById('foot').style.display="none";
				return true;
		}
		
		else{
			document.getElementById('identifier_').style.border = "2px solid red";
				document.getElementById('foot').style.display="flex";
				document.getElementById("foot").style.justifyContent="center";
					document.getElementById('foot').textContent="Incorrect Identifier";
							document.getElementById("foot").style.height="7vh";
		

				
				document.getElementById('identifier_').addEventListener('input',function(){
					if(/\d/.test(document.getElementById('identifier_').value)){
						document.getElementById('identifier_').style.border = "2px solid green";
				document.getElementById('foot').style.display="none";
				return true;
				}});
				
	return false;
	
	}
	
	
	}
	
	
	
	else{
			document.getElementById('identifier_').style.border = "2px solid red";
				document.getElementById('foot').style.display="flex";
				document.getElementById("foot").style.justifyContent="center";
						document.getElementById("foot").style.height="7vh";
		

				document.getElementById('foot').textContent="Identifier length is too small";
				
				
				document.getElementById('identifier_').addEventListener('input',function(){
					if((document.getElementById('identifier_').value.length == 12)){
						document.getElementById('identifier_').style.border = "2px solid green";
				document.getElementById('foot').style.display="none";
				return true;
				}});
				
				return false;
	}
	}
				
	
	
	
	
	
function Verifi_(){
	//identifier Number
	
	const identifier = document.getElementById("identifier_").value;
	// A function to check if identifer_ provided is valid or not
	state = ident(identifier);
	const password_ = document.getElementById("pwd_").value;
	//A function to check  if passsword is valid or not
	state_1 = pass_func(password_);
	//The information provided can check for authentification by fetching the dbs for identifer and corresponding Password
	if(!(state_1&&state))
		return false;
			
			//getting the type sent from homepage Civil.html to the login.html 
			//we are this type from the URL and we will set it in the form and sent to php
			const urlParams = new URLSearchParams(window.location.search);
			const  type = urlParams.get('type');
			//type collected now lets sen the type to php
			
			const loader = document.getElementById('loader');
			loader.style.display = 'block';
			
			const formData = new FormData();
		
		     formData.append('identifier_',identifier);
			 formData.append('pwd',password_);
			 formData.append('certificate_type',type);
		 				
fetch('login.php', {
		method : 'POST',
		body: formData
})
		.then (response => response.text ())
		.then (data => {
			//collects echo from php
			loader.style.display="none";
			//collecting the type from php and loading the coressponding page
			if(data=='successMarriage')
			{window.location.href = 'Marriagepage_1.php';}
		
			else if(data=='successBirth')
			{window.location.href='Birthpage_1.php';}
		
			else if(data = 'Not Success')
			{alert('Invalid Login Credentials');}
		
			else
			{alert('Please return to home page and Choose the \
			Certification type from registry');return false;}
		})
		.catch(error => {
			loader.style.display="none";
			alert(error);
			console.error(error);
		});
		return false;
	
		
	
}