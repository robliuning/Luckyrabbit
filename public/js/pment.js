$(document).ready(function()
{
	$("#btPrg").click(function () {
		if($("#conPrg").is(":hidden")) {
		$("#conPrg").slideDown("slow");
		} else {
		$("#conPrg").slideUp("slow");
 		}
	});
	
	$("#btSafe").click(function () {
		if($("#conSafe").is(":hidden")) {
		$("#conSafe").slideDown("slow");
		} else {
		$("#conSafe").slideUp("slow");
 		}
	});
	
	$("#btPro").click(function () {
		if($("#conPro").is(":hidden")) {
		$("#conPro").slideDown("slow");
		$("#btPro").removeClass("subMenu_switch_close");
		$("#btPro").addClass("subMenu_switch_open");
		} else {
		$("#conPro").slideUp("slow");
		$("#btPro").removeClass("subMenu_switch_open");
		$("#btPro").addClass("subMenu_switch_close");
 		}
	});
	
	$("#btMst").click(function () {
		if($("#conMst").is(":hidden")) {
		$("#conMst").slideDown("slow");
		$("#btMst").removeClass("subMenu_switch_close");
		$("#btMst").addClass("subMenu_switch_open");
		} else {
		$("#conMst").slideUp("slow");
		$("#btMst").removeClass("subMenu_switch_open");
		$("#btMst").addClass("subMenu_switch_close");
 		}
	});
});