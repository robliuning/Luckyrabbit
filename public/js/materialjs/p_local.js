$(document).ready(function()
{
	var modelName = $('#modelName').val();
	var module = $('#module').val();
	var controller = $('#controller').val();
	var id = $("#ajax_id").text();
	
	populateMtrtype();
	populateMtrId();
	
	$("#mtrtype").change(function(){
	var typeId = $("#mtrtype").val();
	$.ajax({
		type:"post",
		url:"/material/index/ajaxpopulatemidd/id/"+typeId,
		success:function(jsonObj){
			var jsonObj = eval('('+jsonObj+')');
			$('#mtrId').find('option').remove();
			for(var i=0;i<jsonObj.length;i++)
			{
				$('#mtrId').append('<option value="'+jsonObj[i].mtrId+'">'+jsonObj[i].name+'</option>')
				}
		}	
		});
	});
	
	$("#ajax_reset").click(function(){
		clearForm();
	});
});

function populateMtrtype()
{
	$('#mtrtype').find('option').remove();
	$.ajax({
		type:"post",
		url:"/material/index/ajaxpopulatemtdd/",
		success:function(jsonObj){
			var jsonObj = eval('('+jsonObj+')');
			for(var i=0;i<jsonObj.length;i++)
			{
				$('#mtrtype').append('<option value="'+jsonObj[i].typeId+'">'+jsonObj[i].name+'</option>')
				}
		}	
		});
	}
function populateMtrId()
{
	$('#mtrId').find('option').remove();
	var typeId = 1;
	$.ajax({
		type:"post",
		url:"/material/index/ajaxpopulatemidd/id/"+typeId,
		success:function(jsonObj){
			var jsonObj = eval('('+jsonObj+')');
			for(var i=0;i<jsonObj.length;i++)
			{
				$('#mtrId').append('<option value="'+jsonObj[i].mtrId+'">'+jsonObj[i].name+'</option>')
				}
		}	
		});
	}
function clearForm()
{
	$("#ajax_price").val("");
	$("#ajax_quantity").val("");
	populateMtrtype();
	populateMtrId();
	}