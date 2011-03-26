//Missing
//Validate deletion result
$(document).ready(function()
{  
	$('#cb_sa').click(function(){
		
		if($(this).attr("checked") == true)
		{
			$("[name='cbEmp']").each(function(){
				if($(this).attr("checked") == false)
				{
					$(this).attr("checked", true);
				}
			});
		}
		else
		{
			$("[name='cbEmp']").each(function(){
				if($(this).attr("checked") == true)
				{
					$(this).attr("checked",false);
				}
			});
			}
	});
	
	$('#btDelete').hover(function(){
		var count = $('[name="cbEmp"]:checked').length;
		var htmlDelete = "<div id='msgBox_delete'>";
		if(count == 0)
		{
			htmlDelete += "请先选择您要删除的员工。";
			}
			else
			{
				htmlDelete = "您选择了"+count+"名员工，点击确认后他们的资料将被删除。<div><p id='btDeleteEmp' class='btDelete radius'>确认删除</p></div>";
				}
		htmlDelete+="</div>";
		$('#msgBox').html(htmlDelete);
		
		$('#btDeleteEmp').click(function(){
			$('[name="cbEmp"]:checked').each(function(){
				var id = $(this).val();
				var result = 1;
				$.ajax({
					type:"post",
					url:"/employee/index/delete/id/"+id,
					success:function(rt){
						if(rt == "0")
						{
							result = "0";
							}
						}
					});
					if(result == "1")
					{
						alert("删除成功！");
						window.location = "/employee";	
						}
						else
						{
						
							}	
			});		
		});
	});
});
