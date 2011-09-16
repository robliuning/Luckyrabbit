$(document).ready(function()
{
	var expand = $('#expand').text();
	if(expand == 1)
	{
		$(".conMonAll").slideDown("slow");
		$(".btMonAll").removeClass("subMenu_switch_close");
		$(".btMonAll").addClass("subMenu_switch_open");
		}
	
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
});