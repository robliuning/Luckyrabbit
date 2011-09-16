$(document).ready(function()
{
	var murl = $("#murl").text();
	window.location = murl;
	setTimeout(function(){window.close()},3000);
});