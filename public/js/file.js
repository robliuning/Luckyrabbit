$(document).ready(function()
{
	$('.fPreview').click(function(){
		$('.conRdSlide2').html("");
		var type = $(this).find('span.hide_b').text();
		if( type == 'ppt' || type == 'xls' || type == 'dwg' || type == 'rar')
		{
			alert('暂不支持该文件类型的预览');
			}
			else
			{
				var doc = $(this).find('span.hide_a').text();
				var link = '<div class="sub_tool"><div class="button_group"><div><a class="cPreview" href="#"><img src="/images/icons/functions/pre.png"/><p>关闭预览</p></a></div><div><a href="http://docs.google.com/viewer?url=http://robliuning.com/docs/1.doc&embedded=true" target="_blank"><img src="/images/icons/functions/einfo.png"/><p>在新窗口打开</p></a></div></div></div>';
				link += '<iframe class="iframe" style="border-style: none;" src="http://docs.google.com/viewer?url=http://robliuning.com/docs/1.doc&embedded=true"></iframe>';
				$('.conRdSlide2').append(link);
				$(".conRdSlide").slideUp("slow");
				$(".btRdSlide").removeClass("subMenu_switch_open");
				$(".btRdSlide").addClass("subMenu_switch_close");
				$(".conRdSlide2").slideDown("slow");
				$(".btRdSlide2").removeClass("subMenu_switch_close");
				$(".btRdSlide2").addClass("subMenu_switch_open");
				$('.p_msg').fadeOut();
				$('.overall_tool').fadeOut();
				$('.cPreview').click(function(){
					$('.conRdSlide2').html("");
					$(".conRdSlide").slideDown("slow");
					$(".btRdSlide").removeClass("subMenu_switch_close");
					$(".btRdSlide").addClass("subMenu_switch_open");
					$(".conRdSlide2").slideUp("slow");
					$(".btRdSlide2").removeClass("subMenu_switch_open");
					$(".btRdSlide2").addClass("subMenu_switch_close");
					$('.p_msg').fadeIn();
					$('.overall_tool').fadeIn();
				});
			}
		});
	});