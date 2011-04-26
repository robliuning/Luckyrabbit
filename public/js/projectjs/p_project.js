//Missing
//Validate deletion result
$(document).ready(function()
{  
	$('#btDelete').hover(function(){
		var count = $('[name="cbEmp"]:checked').length;
		var htmlDelete = "<div id='msgBox_delete'>";
		if(count == 0)
		{
			htmlDelete += "请先选择您要删除的项目。";
			}
			else
			{
				htmlDelete = "您选择了"+count+"个项目，点击确认后他们的资料将被删除。<div><p id='btDeleteEmp' class='btDelete radius'>确认删除</p></div>";
				}
		htmlDelete+="</div>";
		$('#msgBox').html(htmlDelete);
		
		$('#btDeleteEmp').click(function(){
			$('[name="cbEmp"]:checked').each(function(){
				var id = $(this).val();
				var result = 1;
				$.ajax({
					type:"post",
					url:"/project/index/ajaxdelete/id/"+id,
					success:function(rt){
						if(rt == "0")
						{
							result = "0";
							}
						}
					});
				if(result == "1")
				{
				
					}
					else
					{
						alert("项目编号"+id+"删除不成功！");				
						}		
			});
			alert("删除完成！");
			window.location = "/project";	
		});
	});
});
