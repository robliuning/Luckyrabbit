//Missing
//Validate deletion result
$(document).ready(function()
{  	
	$('#btDel').hover(function(){
		var count = $('[name="cb"]:checked').length;
		var htmlDelete = "<div id='msgBox_delete'>";
		if(count == 0)
		{
			htmlDelete += "请先选择您要删除的岗位信息。";
			}
			else
			{
				htmlDelete = "您选择了"+count+"个岗位信息员工，点击确认后相关资料将被永久删除。<div><p id='btConfirm' class='btDelete radius'>确认删除</p></div>";
				}
		htmlDelete+="</div>";
		$('#msgBox').html(htmlDelete);
		
		$('#btConfirm').click(function(){
			$('[name="cb"]:checked').each(function(){
				var id = $(this).val();
				var result = 1;
				$.ajax({
					type:"post",
					url:"/employee/cpp/ajaxdelete/id/"+id,
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
						alert("岗位信息id="+id+"未能删除");
						}		
			});		
			alert("删除完成");
			window.location = "/employee/cpp";	
		});
	});
});
