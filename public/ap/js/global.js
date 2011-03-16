$(document).ready(function()
{  
	$('.lightbox').nm();
	
	var pid = $('#p_id').text();
	var sid = $('#s_id').text();

	if(pid == "nav_login")
	{
		$('#nav_main').addClass('hide');
		$('#nav_sub').addClass('hide');
		$('#panel_uinfo').addClass('hide');
		}
	$('a').each(function(){
   		if($(this).find('span').text() == pid)
   		{
   			$(this).attr('id', 'nav_main_selected');
   			}
   		   	if($(this).find('span').text() == sid)
   			{
   			$(this).attr('id', 'sidebar_selected');
   				}
   });
});