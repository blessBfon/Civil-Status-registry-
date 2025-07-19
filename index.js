document.addEventListener("DOMContentLoaded",event=>{
	  let timeout;
	
	unordered_list = document.querySelector('ul');

	document.getElementById('hover-element-').addEventListener('mouseover',event=>{
		
	unordered_list.style.display = "block";
	
		unordered_list.addEventListener('mouseover',event=>{
	unordered_list.style.display = "block";
	});
	
	unordered_list.addEventListener('mouseout',event=>{
	unordered_list.style.display = "none";});
	});
	
	
	
	document.getElementById('ask-button-').addEventListener('click',event=>{
		event.preventDefault();
		const sb2 = document.getElementById('search-bar-2-');
	const sbt  = document.getElementById('search-btn-');
	if (sb2.style.display=='none'){
		sb2.style.display = 'flex';
		sbt.style.display = 'flex';
		document.getElementById('ask-button-').textContent = "Hide Bar";}
		else
				{
		sb2.style.display = 'none';
		sbt.style.display = 'none';
		document.getElementById('ask-button-').textContent = "Other Questions";}
		});
		
		
		
	
});