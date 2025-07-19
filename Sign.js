//The only time when the submit button will be submitted is when all the entries are filled so that
//when the submit btn is submitted the entries are collected ,verified and validated before the 
//php collects it and stores it to the dbs and the page moves ahead
document.addEventListener("DOMContentLoaded",function(){
const submit_button = document.getElementById("btn")
submit_button.addEventListener("submit",Account_Verification);
});



//-----------------Utility Functions-----------------------------------------
//This function checks if string i contains lettersonly
const containsOnlyLetter = (i)=>
{	
for(k of i){
	if (k >='A' && k<='Z' || k>='a' && k<='z' || k==' ')
	{
		bool = true;
	}
	else
	 {
		return false;
}}
	return bool?true:false;
}
//This function checks if i is a num 

//all input element collected are of string type
const containsDigit = (i)=>{
let b= 0;

for ( k of i){
	if (k >= "0" && k<="9" ){
		b ++;
	}
	
	
}
if(b==17)
	return true;
else
	return false;
}




//this function validates the password criteria
//.* means matching any character except the newline
const containsULSD = (t)=>{
	let c=0;
		let s=0;
		let sp = 0;
		let n=0;
		
		//we are going to test the password provided if it meets all criteria where all the counters above will be >= 1 
		if(/[A-Z]/.test(t)){
		c++;}
		if(/[a-z]/.test(t)){
		s++;}
		if(/\d/.test(t)){
		n++;}
		if(/[!@#$%^&*<>?"'\+=]/.test(t)){//if all is >=1 it means the password provided has met it criteria
			sp++;
		}
		
					if(c>=1 && s>=1 && n>=1 && sp>=1)
						return true;
						else
							return false;
}




//-----------------------------------------------------------------------------









/*Function for name*/
//this function takes first name, last name and username then verify 
/*
1.	if lenght of first+last name is >=5
2. and if first and last name contains letters only
*/


const function_name = (fname,lname,u_name)=>{
		if (u_name.length >= 5){//lenght validation
			//if true
			
			if (containsOnlyLetter(fname) && containsOnlyLetter(lname)){//checks iff first and last name contains letters only
               document.getElementById('LN').style.border = "2px solid green";
					document.getElementById('FN').style.border = "2px solid green";
					return true;//returns true and function ends....
					}
					
				
			else { 
			
			
					//--------------------------------------------------/
				if(!containsOnlyLetter(fname)){
					//if the firstname contain a non-letter or digit then false(Form not submitted) is retruned to the Function
					//and the border of that entry will turn red to signify it as a bad entry
					document.getElementById('FN').style.border = "2px solid red";
					
					
					//Incase the users tries to remove the non-letter or digit as the form was not submitted earlier
					//we can capture this new entry through the event 'input' which will monitor the firstname ELEMENT
					//for any change and try to check again if it contains only letters and if it does 
					//the border respond back to color green (siginifying valid entry)
					document.getElementById('FN').addEventListener("input",function(){
						
						if (containsOnlyLetter(document.getElementById("FN").value)){
							
								document.getElementById('FN').style.border = "2px solid green";
								document.getElementById('foot').style.display="None";
								}
					
					else {
							document.getElementById('foot').style.display="flex";//appears if the during an attempt
							//of removing the non-letter or digit or rewrting the first name makes s mistakes
							//and a non-letter or digit is still found then this erro message animated flex box appears
							//pointing out the error commited byt the user and also the border of that entry turns red
							document.getElementById("foot").style.justifyContent="center";
							document.getElementById("foot").textContent  = "Name should contain only letters";
							document.getElementById('FN').style.border = "2px solid red";
						}
					});
					
					//This appear if the user tries to submit the Form
					//and this entry contains a non-letter char or a digit
					//this appear when the user is entering the first name for the first time
					document.getElementById('foot').style.display="flex";
					document.getElementById("foot").style.justifyContent="center";
					document.getElementById("foot").textContent  = "Name should contain only letters";
						
						return false;
				}
			
			
			
			
			
			
			
			//if false(either first,last or both names contain other character other than lettters possibly even digit 
				if(!containsOnlyLetter(lname)){
					//if the last name doesnot contains only letters
					
					document.getElementById('LN').style.border= "2px solid red";//style the border as red
					
					
					 //incase the user try to remove the non-letter (we use 'input' event to get the next input
					   //and we checkif that input also containsOnlyLetter(if its a letter)
					   //then we style the border a green as a sign of approval
                   document.getElementById('LN').addEventListener("input",function(){
						if (containsOnlyLetter(document.getElementById("LN").value)){
					document.getElementById('LN').style.border = "2px solid green";
					document.getElementById('foot').style.display="none";//hides display of error message
						}
						else{
							//incase the user still input a non-letter char or a digit the border automatically
							//responds to red to siginify that entry is bad
							document.getElementById('LN').style.border = "2px solid red";
							//we display a small animated div block to get the attention of the user to tell them
							//what their mistakes was(error message blinking flex box
							document.getElementById('foot').style.display="flex";
							document.getElementById("foot").style.justifyContent="center";
					document.getElementById("foot").textContent  = "Name should contain only letters";//error messages
						}
					
					});//end of input event listener
					
					//This appear if the user tries to submit the Form
					//and this entry contains a non-letter char or a digit
					document.getElementById('foot').style.display="flex";
					document.getElementById("foot").textContent  = "Name should contain only letters";
											
					return false;//genrally false will be return to the function as during submission the lastname 
					//contained a non-letter or digit.
				}
		
				
				
				}
					
		}//if the lenght of name was less than 5
		
			else{
			
				document.getElementById('foot').style.display="flex";
					document.getElementById("foot").style.justifyContent="center";
					document.getElementById("foot").textContent  = "Username is too small";
				return  false;
			}
}
//---------------------------//Name Verfiication and validation close-------------------------------------------//
			
			
//Function to check pob
function pob_func (p) {
	let regions = ["FAR NORTH", "NORTH","ADAMAWA","CENTRAL","LITTORAL","EAST","SOUTH","WEST","NORTHWEST","SOUTHWEST"];
	let status_ = false;
	
	for (r of regions){
		
		if (r == p.toUpperCase())
		{
			status_= true;
			break;
		}
		
		
}			
		
		
		if (status_)
		{
			document.getElementById('POB').style.border = "2px solid green";
			
					document.getElementById('foot').style.display="none";
					document.getElementById("foot").style.justifyContent="center";
					document.getElementById("foot").textContent  = "Region Not Found in Cameroon";
			return true;
	
		}
		
		
		else {
			
					document.getElementById('POB').style.border = "2px solid red";
					
					document.getElementById('foot').style.display="flex";
					document.getElementById("foot").style.justifyContent="center";
					document.getElementById("foot").textContent  = "Region Not Found in Cameroon";
					return false;
		}
	}

//-----------------------------------------------------------------------------------------




//for date

function for_date(d){
	let current_date = new Date();//
	//new Date () object returns current date and time 
	/*
	so to get current date 
	c = new Date()
	c.getFullYear() --> current year
	c.getMonth() ---> current Month (starting frim 0)
	c.getDate() ---> curent day
	*/
	
	//d is a string input so we have cast it into a Date object
	
	let dob = new Date(d);
	if (current_date.getFullYear() == dob.getFullYear() && current_date.getMonth() == dob.getMonth() &&	current_date.getDate() == dob.getDate())
	{
		document.getElementById('DOB').style.border = "2px solid red";
					
					document.getElementById('foot').style.display="flex";
					document.getElementById("foot").style.justifyContent="center";
					document.getElementById("foot").textContent  = "Invalid Date";
		return false;
	}
	else
	{
		if ((current_date.getFullYear() - dob.getFullYear() )>= 22)// make sure your date of birth was 22 years ago
		{
			document.getElementById('DOB').style.border = "2px solid green";
					
			return true;
		}
		
		
		else
		
		{
			document.getElementById('DOB').style.border = "2px solid red";
					
					document.getElementById('foot').style.display="flex";
					document.getElementById("foot").style.justifyContent="center";
					document.getElementById("foot").textContent  = "Date Cannot be accepted! You must be 22years and above";
			return false;
}
}


}


const idn_fun = (idn)=>{
	if (idn.length == 17)
	{
	if (!containsDigit(idn)){//if it doesnot contain only digits
		
		document.getElementById('IDN').style.border = "2px solid red";
		document.getElementById('foot').style.display="flex";
		document.getElementById("foot").style.justifyContent="center";
		document.getElementById("foot").textContent  = "Identification Number Must contain digits only";
					
					document.getElementById('IDN').addEventListener("input",function(){
						if (containsDigit(document.getElementById("IDN").value)){	
						document.getElementById('IDN').style.border = "2px solid green";
					document.getElementById('foot').style.display="none";
					}}); 
					return false;
	}
		
	
	else
	{
		document.getElementById('IDN').style.border = "2px solid green";
		document.getElementById('foot').style.display="none";
						document.getElementById('IDN').addEventListener("input",function(){
						if (!containsDigit(document.getElementById("IDN").value)){
					document.getElementById('IDN').style.border = "2px solid red";
					document.getElementById('foot').style.display="flex";
							document.getElementById("foot").style.justifyContent="center";
		document.getElementById("foot").textContent  = "Identification Number Must contain digits only";
					}});
				return true;
	
}
	}
	else {
		document.getElementById('IDN').style.border = "2px solid red";
					
		document.getElementById('foot').style.display="flex";
		document.getElementById("foot").style.justifyContent="center";
		document.getElementById("foot").textContent  = "Unique Identification number must be 17 digits";
		
		document.getElementById('IDN').addEventListener("input",function(){
				if ((document.getElementById("IDN").value)==17){
					document.getElementById('IDN').style.border = "2px solid green";
					document.getElementById('foot').style.display="none";
					
		}});
		
		
		
		return false;
}}





const pass_func = (p)=>{
	if (p.length >= 8 )
	{
	
			if(containsULSD(p)){
				document.getElementById('PWD').style.border = "2px solid green";
				document.getElementById('foot').style.display="none";
					
			return true;
			
			}
	
	
		else{
			document.getElementById('PWD').style.border = "2px solid red";
					
		document.getElementById('foot').style.display="flex";
		document.getElementById("foot").style.justifyContent="center";
		document.getElementById("foot").textContent  = "Password must contain an Uppercase and Lowercase letter(s) \
		, digit(s) and atleast a Special character";
		document.getElementById("foot").style.height="7vh";
		
		
							
					document.getElementById('PWD').addEventListener("input",function(){
						if (containsULSD(document.getElementById("PWD").value)){	
						document.getElementById('PWD').style.border = "2px solid green";
					document.getElementById('foot').style.display="none";
					return true;
					}}); 
			return false;
		}
	}
	
	
	
	else{
		document.getElementById('PWD').style.border = "2px solid red";
					
		document.getElementById('foot').style.display="flex";
		document.getElementById("foot").style.justifyContent="center";
		document.getElementById("foot").textContent  = "Password too Small";
		
		
		
		document.getElementById('PWD').addEventListener("input",function(){
						if ((document.getElementById("PWD").value).length>=8){	
						document.getElementById('PWD').style.border = "2px solid green";
					document.getElementById('foot').style.display="none";
					
					}}); 
		return false;
		
	}}




const equal_Password = (p,c_p)=>{
	if (pass_func(p)){
		if(p==c_p){
			document.getElementById('CPWD').style.border = "2px solid green";
			
		
		return true;}
		else{
			document.getElementById('CPWD').style.border = "2px solid red";
					
		document.getElementById('foot').style.display="flex";
		document.getElementById("foot").style.justifyContent="center";
		document.getElementById("foot").textContent  = "Please re-write the same password as above";
		
		document.getElementById('CPWD').addEventListener("input",function(){
						if ((document.getElementById("CPWD").value)==p){	
						document.getElementById('CPWD').style.border = "2px solid green";
					document.getElementById('foot').style.display="none";
					}});
			return false;
		}
	}
}


const Tel_func = (t)=>{
	let regex= /^\+[\d]{12}$/;
	let regex_1 = /^[\d]{9}$/;
	let regex_2= /^\+[\d]{3} [\d]{9}$/;
	
	
	if(regex.test(t) || regex_1.test(t)||regex_2.test(t))
	{
		document.getElementById('TEL').style.border = "2px solid green";

					return true;
					}
					
					
	else{
			document.getElementById('TEL').style.border = "2px solid red";
					
		document.getElementById('foot').style.display="flex";
		document.getElementById("foot").style.justifyContent="center";
		document.getElementById("foot").textContent  = "Invalid phone number";
		
		
				
					document.getElementById('TEL').addEventListener("input",function(){
						t_=document.getElementById("TEL").value;
						if(regex.test(t_) || regex_1.test(t_)||regex_2.test(t_)){
						
						document.getElementById('TEL').style.border = "2px solid green";
					document.getElementById('foot').style.display="none";
					}}); 
	return false;
	
	
	}
}





//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//INCASE OF ANY INVALID ENTRY THEOUTLINE OF THE INPUT BOX ELEMENT WILL BE RED AND AN APPROPRIATE ERROR MESSAGE WILL APPEAR.
function Account_Verification(){
	// Collect entries

	//Name
	const first_name = document.getElementById('FN').value;
	const  last_name = document.getElementById('LN').value;
	const username = first_name + last_name;
	state_1 = function_name(first_name,last_name,username);
	if (!state_1)
		return false;
		
	//function that verifies if username is valid  
	//Properties of valid username
	/*
		1. Length must be greater than 5
		2. Must contain only Letters
		
	*/
	
	//Place of Birth
	const pob = document.getElementById("POB").value;
	//Create a function that verifies if place of Birth entered is region
	state_2 = pob_func(pob);
		if (!state_2)
		return false;
		
		
		
		
	//Date of Birth
	const doo = document.getElementById("DOB").value;
	state_3 = for_date(doo);
	if (!state_3)
		return false;
	//Create a function that if date selected is valid
	/*
		1. date selected cannot be today
		2. Today - Date_selected should be > = 22 years
		3. Today - Date_selected should be < = 70 years
	*/
	
	//Email
	const email = document.getElementById("E_").value;
	//Create a function that checks if email exist 
	
	//Identification Number
	var Id_num = document.getElementById("IDN").value;
	state_4  = idn_fun(Id_num);
	if (!state_4)
		return false;
	
	//Function That checks if Identification Number is valid (Research on properties that id Number posses)
	/* 
		1. Must be of lenght of 20
		2. Contain letters and digits only
		3. --Research on other properties 
	*/
	
	//Password and Confirm Password
	
	
	const password_ = document.getElementById("PWD").value;
	state_5 = pass_func(password_);
	if (!state_5)
		return false;
	
	
	const confirm_password = document.getElementById("CPWD").value;
	state_6 = 	 equal_Password(password_,confirm_password);
	if (!state_6)
		return false;
	
	// Create function to check password if valid and then confirm if password and confirm_passowrd are the same
	/*
		1. Password lenght must be greater > = 8 (-- Research if length can have a limit--)
		2. Passowrd should contain 
			--> Letter (Both Uppercase and Lowercase)
			--> digits (0 to 9)
			--> Special Character or symbol or punctiation (@,#,$,!,%,^,&,*,,,.,?, etc)
	*/
	
	//Telephone
	var tel = document.getElementById("TEL").value;
	state_7 = Tel_func(tel);
	if (!state_7)
		return false;
	//Create Function to check if tel is valid
	/*
		1.	telephone Number can start with +237 or not
		2.	telephone Number itself Must be begin with a 6.
		3 	Telephone Number must be of lenght 9
	*/
	//Gender
	const gen = document.querySelector('input[type="radio"]:checked');
	
		if (gen){
			G = gen.value;
		}
	
	  const loader = document.getElementById('loader');
      
      loader.style.display = 'block';


	//sending valid data to php
	
	const formData = new FormData();
		
	formData.append('username',first_name);
	formData.append('username_2',last_name);
	formData.append('POB',pob);
	formData.append('DOB',doo);
	formData.append('email',email);
	formData.append('id_num',Id_num);
	formData.append('pwd',password_);
	formData.append('cpwd',confirm_password);
	formData.append('tel',tel);
	formData.append('gender',G);

	//sending data to php file using AJAX 
	
	fetch('Signup.php' , {
		method : 'POST',
		body: formData
		})
		
		.then ((response) => response.text ())
		.then ((data) => {
				if(data=="exist"){
					alert('Identification Number Already Exist');
				window.location.href  = 'Sign-up.html';}
		else{
		loader.style.display="none";
		window.location.href  = 'SuccessSign1.html';
		}})
		.catch((error) => {
			loader.style.display="none";
			alert(error);
			console.error(error);
		});
return false;		
}


   