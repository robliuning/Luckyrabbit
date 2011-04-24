$(document).ready(function()
{  	
	//Enable the date picker
	$( "#logDate" ).datepicker({changeMonth: true,changeYear: true, yearRange: "-70:+10"},$.datepicker.regional[ "zh-CN" ],("option", "dateFormat","YY-MM-DD"));	
	
});
