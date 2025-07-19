document.addEventListener("DOMContentLoaded",function(){
	document.getElementById('save').addEventListener('submit',Val_Marr);
});

//importing a function from sign.js

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
function pob_func (p) {
		
		if (!p)
		{
			document.getElementById('_pob').style.border = "2px solid green";
			
					document.getElementById('foot').style.display="none";
					document.getElementById("foot").style.justifyContent="center";
					document.getElementById("foot").textContent  = "Please enter place of Birth";
										document.getElementById('_pob').addEventListener("input",function(){
						
						if (document.getElementById('_pob').value){
							
								document.getElementById('_pob').style.border = "2px solid green";
								document.getElementById('foot').style.display="None";
								}
				
					});
					
			return false;
	
		}
		
		
		else {
			
					document.getElementById('_pob').style.border = "2px solid green";
					
					document.getElementById('foot').style.display="none";
		return true;}
	}

//----------------------------------------------------------------------------------------------------


const function_namee = (fname,x)=>{
		if (fname.length >= 5){//lenght validation
			//if true
			
			if (containsOnlyLetter(fname)){//checks iff first and last name contains letters only
               document.getElementById(x).style.border = "2px solid green";
				
					return true;//returns true and function ends....
					}
					
				
			else { 
			
			
					//--------------------------------------------------/
				
					document.getElementById(x).style.border = "2px solid red";
					
					
					//Incase the users tries to remove the non-letter or digit as the form was not submitted earlier
					//we can capture this new entry through the event 'input' which will monitor the firstname ELEMENT
					//for any change and try to check again if it contains only letters and if it does 
					//the border respond back to color green (siginifying valid entry)
					document.getElementById(x).addEventListener("input",function(){
						
						if (containsOnlyLetter(document.getElementById(x).value)){
							
								document.getElementById(x).style.border = "2px solid green";
								document.getElementById('foot').style.display="None";
								}
					
					else {
							document.getElementById('foot').style.display="flex";//appears if the during an attempt
							//of removing the non-letter or digit or rewrting the first name makes s mistakes
							//and a non-letter or digit is still found then this erro message animated flex box appears
							//pointing out the error commited byt the user and also the border of that entry turns red
							document.getElementById("foot").style.justifyContent="center";
							document.getElementById("foot").textContent  = "Name should contain only letters";
							document.getElementById(x).style.border = "2px solid red";
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
			
			
			
			
			
			
					
		}//if the lenght of name was less than 5
		
			else{
			
				document.getElementById('foot').style.display="flex";
					document.getElementById("foot").style.justifyContent="center";
					document.getElementById("foot").textContent  = " is too small";
				return  false;
			}
}

//----------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------


function for_date(d,x){
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
	if (current_date.getFullYear() == dob.getFullYear() && current_date.getMonth() == dob.getMonth() && current_date.getDate() == dob.getDate())
	{
		document.getElementById(x).style.border = "2px solid red";
		document.getElementById('foot').style.display="flex";
		document.getElementById("foot").style.justifyContent="center";
		document.getElementById("foot").textContent  = "Date cannot be the same as today";
		return false;
	}
	if(dob>current_date){
		
		document.getElementById(x).style.border = "2px solid red";
		document.getElementById('foot').style.display="flex";
		document.getElementById("foot").style.justifyContent="center";
		document.getElementById("foot").textContent  = "Date cannot be above today";
		return false;
	}
	else
	{
		if ((current_date.getFullYear() - dob.getFullYear() )>= 18)// make sure your date of birth was 22 years ago
		{
			document.getElementById(x).style.border = "2px solid green";
					
			return true;
		}
		
		
		else
		
		{
			document.getElementById(x).style.border = "2px solid red";
		document.getElementById('foot').style.display="flex";
		document.getElementById("foot").style.justifyContent="center";
		document.getElementById("foot").textContent  = "Date not  Accepted. You must be above 18years";
			return false;
}
}


}


function for_datee(d){
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
if (dob>current_date)
	{
		document.getElementById('_dom').style.border = "2px solid red";
			
		document.getElementById('foot').style.display="flex";
		document.getElementById("foot").style.justifyContent="center";
		document.getElementById("foot").textContent  = "Date cannpt be above today";
		return false;
	}
		else
		
		{
			
					document.getElementById('foot').style.display="none";
					document.getElementById("foot").style.justifyContent="center";
					
			return true;
}
}









const idn_fun = (idn,x)=>{
	if (idn.length == 17)
	{
	if (!containsDigit(idn)){//if it doesnot contain only digits
		
		document.getElementById(x).style.border = "2px solid red";
		document.getElementById('foot').style.display="flex";
		document.getElementById("foot").style.justifyContent="center";
		document.getElementById("foot").textContent  = "Identification Number Must contain digits only";
					
					document.getElementById(x).addEventListener("input",function(){
						if (containsDigit(document.getElementById(x).value)){	
						document.getElementById(x).style.border = "2px solid green";
					document.getElementById('foot').style.display="none";
					}}); 
					return false;
	}
		
	
	else
	{
		document.getElementById(x).style.border = "2px solid green";
		document.getElementById('foot').style.display="none";
						document.getElementById(x).addEventListener("input",function(){
						if (!containsDigit(document.getElementById(x).value)){
					document.getElementById(x).style.border = "2px solid red";
					document.getElementById('foot').style.display="flex";
							document.getElementById("foot").style.justifyContent="center";
		document.getElementById("foot").textContent  = "Identification Number Must contain digits only";
					}});
				return true;
	
}
	}
	else {
		document.getElementById(x).style.border = "2px solid red";
					
		document.getElementById('foot').style.display="flex";
		document.getElementById("foot").style.justifyContent="center";
		document.getElementById("foot").textContent  = "Unique Identification number must be 17 digits";
		
		document.getElementById(x).addEventListener("input",function(){
				if ((document.getElementById(x).value)==17){
					document.getElementById(x).style.border = "2px solid green";
					document.getElementById('foot').style.display="none";
					
		}});
		
		
		
		
		
//--------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------



}}



function Val_Marr(){
	
	
	
	
	
	const hus_name = document.getElementById('_hName').value;
	state = function_namee(hus_name,'_hName');
	
	const Wife_name = document.getElementById('_wName').value;
	state_1 = function_namee(Wife_name,'_wName');
	
	const dateofmarr = document.getElementById('_dom').value;
	state_2 = for_datee(dateofmarr);
	
	final_state = (state&&state_1&&state_2)?true:false;
	if(!(final_state))
		return false;
	
	//;;;;;; Mr
	
	
	state_8_1 = true;
	state_8_2 = true;
	state_8_3 = true;
	state_8_4 = true;
	
	
	const confirming_hus_name = document.getElementById('_confirmhName').value;//checks if the valid husband name is the same as this
	state_3 = function_namee(confirming_hus_name,'_confirmhName');
	
	const hus_pob = document.getElementById('_hpop').value;

	
	const hus_dob = document.getElementById('_hdob').value;
	state_5 = for_date(hus_dob,'_hdob');
	
	const hus_resident = document.getElementById('_hRed').value;
	
	const hus_nationality = document.getElementById('_hNa').value;
	
	const hus_idnumber = document.getElementById('_hRef').value;
	state_6 = idn_fun(hus_idnumber,'_hRef');
	
	const hus_occupation = document.getElementById('_hOcc').value;
	
	const hus_father_name = document.getElementById('_fhName').value;
				if (!(hus_father_name =='')){
		state_8_1 = function_namee(hus_father_name,'_fhName');}
	
	
	const hus_mother_name = document.getElementById('_mhName').value;
				if (!(hus_mother_name =='')){
		state_8_2 = function_namee(hus_mother_name,'_mhName');}
	
	
	final_state_1 = (state_3&&state_5&&state_6)?true:false;
			if(!(final_state_1))
		return false;
		
		const confirming_wife_name = document.getElementById('_confirmwName').value;
		//checks if the valid husband name is the same as this
		state_9 = function_namee(confirming_wife_name,'_confirmwName');
	
	const wife_pob = document.getElementById('_wpop').value;
	
	
	const wife_dob = document.getElementById('_wdob').value;
	state_11 = for_date(wife_dob,'_wdob');
	
	
	const wife_resident = document.getElementById('_wRed').value;
	
	const wife_nationality = document.getElementById('_wNa').value;
	
	const wife_idnumber = document.getElementById('_wRef').value;
	state_12 = idn_fun(wife_idnumber,'_wRef');
	
	
	const wife_occupation = document.getElementById('_wOcc').value;
	
	const wife_father_name = document.getElementById('_fwname').value;
			if (!(wife_father_name =='')){
		state_8_3 = function_namee(wife_father_name,'_fwname');}
	
	
	const wife_mother_name = document.getElementById('_mwname').value;
			if (!(wife_mother_name =='')){
		state_8_4 = function_namee(wife_mother_name,'_mwname');}
	
	
	final_state_2 = (state_9&&state_11&&state_12)?true:false;
		if(!(final_state_2))
		return false;
	
	//;;;; matrimonial regime
	
	//any option can be chosen except the first option
	const mat_regime  = document.getElementById('marr_type');
	if ( mat_regime.value == mat_regime.options[0].value){
		mat_regime.style.border = "2px solid red";
					 state_15 = false;
					document.getElementById('foot').style.display="flex";
					document.getElementById("foot").style.justifyContent="center";
					document.getElementById("foot").textContent  = "Choose an option";
					
document.getElementById('mat_regime').addEventListener('change', function(){
					if (!(document.getElementById('mat_regime').value==marr_type.options[0].value)){
									state_15 = true;
	 selected_Value_mat = mat_regime.value;
								document.getElementById('foot').style.display="none";
	}
	else {
		document.getElementById('foot').style.display='none';
		mat_regime.style.border = '2px solid green';
	}
	
	
	});
}

	else {
	state_15 = true;
	 selected_Value_mat = mat_regime.value;
	}
		
	
					
		
	//stores all options of the select element that has name="Matrimonal" in an Array
	
	const marr_type = document.getElementById('mat_reg');
	if ( marr_type.value == marr_type.options[0].value){
		document.getElementById('mat_reg').style.border = "2px solid red";
					state_16 = false;
					document.getElementById('foot').style.display="flex";
					document.getElementById("foot").style.justifyContent="center";
					document.getElementById("foot").textContent  = 'Choose an option cannot be chosen';
					
						document.getElementById('mat_reg').addEventListener('change', function(){
					if (!(	document.getElementById('mat_reg').value==marr_type.options[0].value)){
								state_16 = true;
	selected_Value_mar = marr_type.value;
		
								document.getElementById('foot').style.display="none";
	}
	else {
		document.getElementById('foot').style.display='none';
		document.getElementById('mat_reg').style.border = '2px solid green';
	}});

}

	else {
	state_16 = true;
	selected_Value_mar = marr_type.value;
							
	}
final_state_3 = (state_15&&state_16)?true:false;
	if(!(final_state_3))
			return false;


	//stores all options of the select whose name ="marriage_type" in an array
	
	
	const couple_img = document.getElementById('img_couple');
/*	couple_img.addEventListener('change',(event)=>{
		const image_ = event.target.files[0];
		const reader = new FileReader();
		reader.onload = () => {
			const imgdataurl = reader.result;
		console.log(imagedataurl);};
	reader.readAsDataUrl(image_);});
	
*/


			const loader = document.getElementById('loader');
			loader.style.display = 'block';
			
			
			const formaData = new FormData();
			
			formaData.append('husband_name',hus_name);
			formaData.append('wife_name',Wife_name);
			formaData.append('spouse_dom',dateofmarr);
			
			
			formaData.append('h_pop',hus_pob);
			formaData.append('hus_dob',hus_dob);
			formaData.append('h_red',hus_resident);
			formaData.append('h_ref',hus_idnumber);
			formaData.append('h_nation',hus_nationality);
			formaData.append('h_occ',hus_occupation);
			if(!(hus_father_name =='')){formaData.append('hus_fath_name',hus_father_name);}
			if(!(hus_mother_name =='')){formaData.append('hus_moth_name',hus_mother_name);}
			
			
			
			formaData.append('w_pop',wife_pob);
			formaData.append('wus_dob',wife_dob);
			formaData.append('w_red',wife_resident);
			formaData.append('w_ref',wife_idnumber);
			formaData.append('w_nation',wife_nationality);
			formaData.append('w_occ',wife_occupation);
			if(!(wife_father_name =='')){formaData.append('wif_fath_name',wife_father_name);}
			if(!(wife_mother_name =='')){formaData.append('wif_moth_name',wife_mother_name);}
			
			formaData.append('Matrimonal', selected_Value_mat);
			formaData.append('Marriage_type', selected_Value_mar);
			
				
fetch('Marriage.php', {
		method : 'POST',
		body: formaData
		
	})
		.then (response => response.text ())
		.then (data => {
			console.log(data);
		
		loader.style.display="none";
		window.location.href  = 'SuccessSign2.htm';
			})
		.catch(error => {
			loader.style.display="none";
			alert(error);
			console.error(error);
		});
		return false;
	
		
	
	
	
	
}