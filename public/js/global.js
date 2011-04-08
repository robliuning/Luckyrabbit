$(document).ready(function()
{  
	$('.lightbox').nm();
	
		$('#cb_sa').click(function(){
		
		if($(this).attr("checked") == true)
		{
			$("[name='cb']").each(function(){
				if($(this).attr("checked") == false)
				{
					$(this).attr("checked", true);
				}
			});
		}
		else
		{
			$("[name='cb']").each(function(){
				if($(this).attr("checked") == true)
				{
					$(this).attr("checked",false);
				}
			});
			}
	});
});