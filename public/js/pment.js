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
	
	$(".btMonAll").click(function(){
		var con = $(this).parent().parent().find("div.conMonAll");
		if (con.is(":hidden")) {
			con.slideDown("slow");
			$(this).removeClass("subMenu_switch_close");
			$(this).addClass("subMenu_switch_open");
			}else{
				con.slideUp("slow");
				$(this).removeClass("subMenu_switch_open");
				$(this).addClass("subMenu_switch_close");
				}
		});
	
	$("#btImgUpload").click(function () {
		if($("#conUpload").is(":hidden")) {
		$("#conUpload").slideDown("slow");
		$("#btImgUpload").removeClass("subMenu_switch_close");
		$("#btImgUpload").addClass("subMenu_switch_open");
		} else {
		$("#conUpload").slideUp("slow");
		$("#btImgUpload").removeClass("subMenu_switch_open");
		$("#btImgUpload").addClass("subMenu_switch_close");
 		}
	});
	
		$("#btImgShow").click(function () {
		if($("#conImage").is(":hidden")) {
		$("#conImage").slideDown("slow");
		$("#btImgShow").removeClass("subMenu_switch_close");
		$("#btImgShow").addClass("subMenu_switch_open");
		} else {
		$("#conImage").slideUp("slow");
		$("#btImgShow").removeClass("subMenu_switch_open");
		$("#btImgShow").addClass("subMenu_switch_close");
 		}
	});

});