$(document).ready(function(){

	$("#backb").click(function(){
		var Backlen=history.length;
		history.go(-Backlen); 
  		window.location.href="home.php";
	});

});