$(document).ready(function(){
	
	$("#menu").click(function(){
		$("#popup").animate({'margin-left':'0px'},200);
		$("#welcome").animate({'margin-left':'300px'},200);
		$("#mainone").animate({'margin-left':'600px'},200);
	});

	$("#close").click(function(){
		$("#popup").animate({'margin-left':'-350px'},200);
		$("#welcome").animate({'margin-left':'60px'},200);
		$("#mainone").animate({'margin-left':'100px'},200);

	});
});