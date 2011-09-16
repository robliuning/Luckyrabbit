$(document).ready(function()
{
	$("#floatTop_content").floatdiv({right:"0px",bottom:"0px"});
	populateDd();

	$(".ajax_slide_button").click(function () {
		if($(".ajax_slide_content").is(":hidden")) {
		$("#ajax_description").val("");
		$(".ajax_slide_content").slideDown("slow");
		$(".ajax_slide_button").removeClass("subMenu_switch_close");
		$(".ajax_slide_button").addClass("subMenu_switch_open");
		} else {
		$(".ajax_slide_content").slideUp("slow");
		$(".ajax_slide_button").removeClass("subMenu_switch_open");
		$(".ajax_slide_button").addClass("subMenu_switch_close");
 		}
	});

	$('#ajax_btEr').click(function(){
		var typeId = $("#ajax_typeId").val();
		var modId = $("#ajax_modId").val();
		var description = $("#ajax_description").val();
		var priority = $("#ajax_priority").val();
		if(description != "")
		{
			$.ajax({
				type:"post",
				url:"/system/improvement/ajaxadd/typeId/"+typeId+"/modId/"+modId+"/description/"+description+"/priority/"+priority,
				success:function(rt){
					alert(rt);
					$(".ajax_slide_content").slideUp("slow");
					$(".ajax_slide_button").removeClass("subMenu_switch_open");
					$(".ajax_slide_button").addClass("subMenu_switch_close");
					}
				});
			}
			else
			{
				alert("提交失败: 问题描述不能为空.");
				}
	});
});

function populateDd()
{
	$.ajax({
		type:"post",
		url:"/system/improvement/populateimptypedd/",
		success:function(jsonObj){
			var jsonObj = eval('('+jsonObj+')');
			$('#ajax_typeId').find('option').remove();
			for(var i=0;i<jsonObj.length;i++)
			{
				$('#ajax_typeId').append('<option value="'+jsonObj[i].id+'">'+jsonObj[i].name+'</option>')
				}
		}
	});

	$.ajax({
		type:"post",
		url:"/system/improvement/populatemodnamechdd/",
		success:function(jsonObj){
			var jsonObj = eval('('+jsonObj+')');
			$('#ajax_modId').find('option').remove();
			for(var i=0;i<jsonObj.length;i++)
			{
				$('#ajax_modId').append('<option value="'+jsonObj[i].id+'">'+jsonObj[i].name+'</option>');
				$('#ajax_modId').val(30);
				}
		}
	});
}