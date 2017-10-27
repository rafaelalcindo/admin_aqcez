$(document).ready(function(){

	let searchParams = new URLSearchParams(window.location.search);

	alert(searchParams.get("geral"));
	
});