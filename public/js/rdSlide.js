$(document).ready(function()
{
	$(".btRdSlide").click(function () {
		var conRdSlide = $(this).parent().parent().find('.conRdSlide');
		if(conRdSlide.is(":hidden")) {
		conRdSlide.slideDown("slow");
		$(this).removeClass("subMenu_switch_close");
		$(this).addClass("subMenu_switch_open");
		} else {
		conRdSlide.slideUp("slow");
		$(this).removeClass("subMenu_switch_open");
		$(this).addClass("subMenu_switch_close");
 		}
	});
	
	$(".btAllSlide").click(function(){
		var control = $(this).find('span').text();
		if(control == '关闭')
		{
			$(".conRdSlide").slideUp("slow");
			$(this).find('span').text("打开");
			$(this).removeClass("subMenu_switch_open");
			$(this).addClass("subMenu_switch_close");
			$('.btRdSlide').removeClass("subMenu_switch_open");
			$('.btRdSlide').addClass("subMenu_switch_close");
			}
			else
			{
				$(".conRdSlide").slideDown("slow");
				$(this).find('span').text("关闭");
				$(this).removeClass("subMenu_switch_close");
				$(this).addClass("subMenu_switch_open");
				$('.btRdSlide').removeClass("subMenu_switch_close");
				$('.btRdSlide').addClass("subMenu_switch_open");
				}
	});
});