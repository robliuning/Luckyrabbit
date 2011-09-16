$(document).ready(function()
{
	var modelName = $('#modelName').val();
	var module = $('#module').val();
	var controller = $('#controller').val();
	var id = $("#ajax_id").text();
	
	populateMtrtype();
	populateMtrId();
	
	$("#eqptype").change(function(){
	var typeId = $("#eqptype").val();
	$.ajax({
		type:"post",
		url:"/equipment/index/ajaxpopulatemidd/id/"+typeId,
		success:function(jsonObj){
			var jsonObj = eval('('+jsonObj+')');
			$('#eqpId').find('option').remove();
			for(var i=0;i<jsonObj.length;i++)
			{
				$('#eqpId').append('<option value="'+jsonObj[i].eqpId+'">'+jsonObj[i].name+'</option>')
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
	$.ajax({
		type:"post",
		url:"/equipment/index/ajaxpopulatemtdd/",
		success:function(jsonObj){
			var jsonObj = eval('('+jsonObj+')');
			$('#eqptype').find('option').remove();
			for(var i=0;i<jsonObj.length;i++)
			{
				$('#eqptype').append('<option value="'+jsonObj[i].typeId+'">'+jsonObj[i].name+'</option>')
				}
		}	
		});
	}
function populateMtrId()
{
	var typeId = 1;
	$.ajax({
		type:"post",
		url:"/equipment/index/ajaxpopulatemidd/id/"+typeId,
		success:function(jsonObj){
			var jsonObj = eval('('+jsonObj+')');
			$('#eqpId').find('option').remove();
			for(var i=0;i<jsonObj.length;i++)
			{
				$('#eqpId').append('<option value="'+jsonObj[i].eqpId+'">'+jsonObj[i].name+'</option>')
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