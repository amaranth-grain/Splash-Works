
$(document).ready(function() {
var number = 1;	
function halp() {
	switch(number) {	
	case 1: 
		$("#arrow-left").css('visibility','hidden');
		$("#world1").css('background-color', 'rgba(255, 255, 255, 0.9)');
		$("#world2").css('background-color', 'rgba(187, 187, 187, 0.7)');	
		$("#world3").css('background-color', 'rgba(187, 187, 187, 0.7)');		
		break;	
	case 2:
	  $("#arrow-left").css('visibility','visible');
		$("#arrow-right").css('visibility','visible');
		$("#world1").css('background-color', 'rgba(187, 187, 187, 0.7)');	
		$("#world2").css('background-color', 'rgba(255, 255, 255, 0.9)');	
		$("#world3").css('background-color', 'rgba(187, 187, 187, 0.7)');		
	  break;
	case 3:
	  $("#arrow-right").css('visibility','hidden');
		$("#world1").css('background-color', 'rgba(187, 187, 187, 0.7)');
		$("#world2").css('background-color', 'rgba(187, 187, 187, 0.7)');	
		$("#world3").css('background-color', 'rgba(255, 255, 255, 0.9)');	
	  break;
	}
}
	
$("#arrow-left").click(function() {
	number = number - 1;
	halp();
	$("body").css("background", "url(../images/bg" + number + 
								".png), #eee url(https://subtlepatterns.com/patterns/extra_clean_paper.png)");
	$("audio").attr("src", "./music/level" + number + ".wav");
});
$("#arrow-right").click(function() {
	number= number + 1;
	halp();
	$("body").css("background", "url(../images/bg" + number + 
								".png), #eee url(https://subtlepatterns.com/patterns/extra_clean_paper.png)");
	$("audio").attr("src", "./music/level" + number + ".wav");
});
	$("#arrow-left").on("mouseover", function() {
  $("#arrow-left").css("border-right", "4.166666666666667vw solid yellow"); 
});
	
	$("#arrow-left").on("mouseleave", function() {
  $("#arrow-left").css("border-right", "4.166666666666667vw solid rgba(255,255,255, 0.7)"); 
});
	
	$("#arrow-right").on("mouseover", function() {
  $("#arrow-right").css("border-left", "4.166666666666667vw solid yellow"); 
});
	
	$("#arrow-right").on("mouseleave", function() {
  $("#arrow-right").css("border-left", "4.166666666666667vw solid rgba(255,255,255, 0.7)"); 
});	
$("#logo").click(function() {
	$("audio").attr("src", "./music/rickroll.mp3");
});
$("#l1").click(function() {
document.location.href= '../games/splashworks/world0' + number + '/lvl01';	
});
$("#l2").click(function() {
document.location.href= '../games/splashworks/world0' + number + '/lvl02';	
});	
$("#l3").click(function() {
document.location.href= '../games/splashworks/world0' + number + '/lvl03';
});		
});