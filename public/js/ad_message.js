$(document).ready(function()
{
	$('td.ad_message_td').click(function(){
		var msgId = $(this).parent().find(':checkbox').val();
		window.location.replace("http://localhost:8888/admin/message/display/id/"+msgId);

	});
});