$(document).ready(function()
{  	
	//Enable the date picker
	$( "#birth" ).datepicker({changeMonth: true,changeYear: true, yearRange: "-70:+10"},$.datepicker.regional[ "zh-CN" ],("option", "dateFormat","YY-MM-DD"));

		
	$('#btDel').hover(function(){
		var count = $('[name="cb"]:checked').length;
		var htmlDelete = "<div id='msgBox_delete'>";
		if(count == 0)
		{
			htmlDelete += "请先选择您要删除的通讯录。";
			}
			else
			{
				htmlDelete += "您选择了"+count+"个通讯录，点击确认后相关资料会被永久删除。<div><p id='btMulti' class='btDelete radius'>确认删除</p></div>";
				}
				
		htmlDelete+="</div>";
		
		$('#msgBox').html(htmlDelete);
		
		$('#btMulti').click(function(){
			$('[name="cb"]:checked').each(function(){
				var id = $(this).val();
				var result = 1;
				$.ajax({
					type:"post",
					url:"/employee/index/ajaxdelete/id/"+id,
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
						alert("通讯录id:"+id+"未能删除");
						}		
			});		
			alert("删除完成");
			window.location = "/employee";			
		});
	});
	
	
});
