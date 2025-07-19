document.addEventListener("DOMContentLoaded",function(){

	document.getElementById('save').addEventListener('submit',Val_Birth);
});




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


//--------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------
const function_name_id = (fname,x)=>{
		if (fname.length >= 5){//lenght validation
			//if true
			
			if (containsOnlyLetter(fname)){//checks iff first and last name contains letters only
               document.getElementById(x).style.border = "2px solid green";
				
					return true;//returns true and function ends....
					}
					
				
			else { 
			
			
					//--------------------------------------------------/
				
					document.getElementById(x).style.border = "2px solid red";
					
				
					document.getElementById(x).addEventListener("input",function(){
						
						if (containsOnlyLetter(document.getElementById(x).value)){
							
								document.getElementById(x).style.border = "2px solid green";
								document.getElementById('foot').style.display="None";
								}
					
					else {
							document.getElementById('foot').style.display="flex";
							document.getElementById("foot").style.justifyContent="center";
							document.getElementById("foot").textContent  = "Name should contain only letters";
							document.getElementById(x).style.border = "2px solid red";
						}
					});
					

					document.getElementById('foot').style.display="flex";
					document.getElementById("foot").style.justifyContent="center";
					document.getElementById("foot").textContent  = "Name should contain only letters";
						
						return false;
				}
			
			
			
			
			
			
					
		}//if the lenght of name was less than 5
		
			else{document.getElementById(x).style.border = "2px solid red";
			
				document.getElementById('foot').style.display="flex";
					document.getElementById("foot").style.justifyContent="center";
					document.getElementById("foot").textContent  = "name is too small";
				return  false;
			}
}

//----------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------
//-----------------------------------------------------------------------------------------------

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
					document.getElementById("foot").textContent  = "Date Cannot be accepted! You must be 18years and above";
			return false;
}
}


}
//-----------------------------------------
//---------------------------------------------------------------------


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
		document.getElementById('_dob').style.border = "2px solid red";
					
					document.getElementById('foot').style.display="flex";
					document.getElementById("foot").style.justifyContent="center";
					document.getElementById("foot").textContent  = "Invalid Date";
		return false;
	}
		else
		
		{
			document.getElementById('_dob').style.border = "2px solid green";
					
					document.getElementById('foot').style.display="none";
					document.getElementById("foot").style.justifyContent="center";
					
			return true;
}
}




//-------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------

function Val_Birth(){
	const region  = document.getElementById('region').value;
	
	/*
		region.value ----> value of the selected Element
		region.options --->a collection of option elements
		region.selectedIndex ------> index of the selected option
		*/
		
	
	const division = document.getElementById('_div').value;
	
	// function that make use of an api to collect all division
	//for the selected region and then checks if the division provieded
	//exists in that region
	
	
	const sub_div = document.getElementById('subdivi').value;
	//function that make use of ai to collect all subdivision for the selected division
	//and checks if the subdivision provided is present in italics
	
	
	const name = document.getElementById('_chname').value;
	state_3 = function_name_id(name,'_chname');
	if(!(state_3))
		return false;
	
	
	const pob = document.getElementById('_pob').value;
	
	
	
	
	const dob = document.getElementById('_dob').value;
	state_2 = for_datee(dob);
	
		if(!(state_2))
		return false;
	
	
	state_5 = true;
	state_5_1 = true;
	state_5_2 = true;
	state_6 = true;
	state_6_1 = true;
	state_6_2 = true;
	
	
	
	const gender = document.querySelector('input[type="radio"]:checked').value;
	
	
	const Fname = document.getElementById('_FN').value;
	if (!(Fname=="")){
		state_5 = function_name_id(Fname,'_FN');
			if(!(state_5))
		return false;
	
	}
	
	const Fpob = document.getElementById('_Fpob').value;
	
	const Fdob = document.getElementById('_Fdob').value;
	if(!(Fdob=='')){
	state_5_2 = for_date(Fdob,'_Fdob');
		if(!(state_5_2))
		return false;
	
	}
	const Fresident = document.getElementById('_FRed').value;
	
	
	const Foccupation = document.getElementById('_FOcc').value;
	
	
	
	const Mname = document.getElementById('_MN').value;
	if(!(Mname=='')){	state_6 = function_name_id(Mname,'_MN');
	if(!(state_6))
		return false;
		}
		
	const Mpob = document.getElementById('_Mpop').value;
	
	const Mdob = document.getElementById('_Mdob').value;
	if(!(Mdob=='')){state_6_2 = for_date(Mdob,'_Mdob');
		if(!(state_6_2))
		return false;
	
	}
	const Mresident = document.getElementById('_MRed').value;
	
	
	const Moccupation = document.getElementById('_MOcc').value;

		const loader = document.getElementById('loader');
			loader.style.display = 'block';
			
	const formData = new FormData();
	
	formData.append('region',region);
	formData.append('division',division);
	formData.append('subdivision',sub_div);
	formData.append('ch_name',name);
	formData.append('child_pob',pob);
	formData.append('child_do',dob);
	formData.append('child_gender',gender);
	
	if(!(Fname=='')){formData.append('father_name',Fname);}
	if(!(Fpob=='')){formData.append('father_pop',Fpob);}
	if(!(Fdob =='')){formData.append('father_dob',Fdob);}
	if(!(Fresident =='')){formData.append('father_red',Fresident);}
	if(!(Foccupation =='')){formData.append('father_occ',Foccupation);}
	
	
	if(!(Mname=='')){formData.append('Mother_name',Mname);}
	if(!(Mpob=='')){formData.append('Mother_pop',Mpob);}
	if(!(Mdob =='')){formData.append('Mother_dob',Mdob);}
	if(!(Mresident =='')){formData.append('Mother_red',Mresident);}
	if(!(Moccupation =='')){formData.append('Mother_occ',Moccupation);}
	
	//sending data to php via AJAX
	

	fetch('Birth.php', {
		method : 'POST',
		body: formData,
		
	})
		.then (response => response.text ())
		.then (data => {
			console.log(data);
		loader.style.display="none";
		window.location.href  = 'SuccessSign.htm';
		})
		.catch(error => {
			loader.style.display="none";
			alert(error);
			console.error(error);
		});
		return false;
	
}

