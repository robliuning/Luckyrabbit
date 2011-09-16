$(document).ready(function()
{
	$("#conContractor").removeClass("hide");
	
	$(".btRdSlide").click(function () {
		if($(".conRdSlide").is(":hidden")) {
		$(".conRdSlide").slideDown("slow");
		$(".btRdSlide").removeClass("subMenu_switch_close");
		$(".btRdSlide").addClass("subMenu_switch_open");
		} else {
		$(".conRdSlide").slideUp("slow");
		$(".btRdSlide").removeClass("subMenu_switch_open");
		$(".btRdSlide").addClass("subMenu_switch_close");
 		}
	});
	
	$(".btRdSlide2").click(function () {
		if($(".conRdSlide2").is(":hidden")) {
		$(".conRdSlide2").slideDown("slow");
		$(".btRdSlide2").removeClass("subMenu_switch_close");
		$(".btRdSlide2").addClass("subMenu_switch_open");
		} else {
		$(".conRdSlide2").slideUp("slow");
		$(".btRdSlide2").removeClass("subMenu_switch_open");
		$(".btRdSlide2").addClass("subMenu_switch_close");
 		}
	});
});