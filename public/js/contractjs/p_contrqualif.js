$(document).ready(function()
{  
	$("#qualifSerie").change(function(){
	var serie = $(this).val();
	$.ajax({
		type:"post",
		url:"/contract/contrqualif/populatedd/id/"+serie,
		success:function(jsonObj){
			var jsonObj = eval('('+jsonObj+')');
			$('#qualifTypeId').find('option').remove();
			for(var i=0;i<jsonObj.length;i++)
			{
				$('#qualifTypeId').append('<option value="'+jsonObj[i].typeId+'">'+jsonObj[i].name+'</option>')
				}
		}	
		});
	});
});