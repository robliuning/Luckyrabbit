$(document).ready(function()
{
	$('.ajax_changeStatus').change(function(){
		var id = $(this).parent().find('span').text().trim();
		var sendMsg = $(this).parent().parent().find('select.ajax_sendMsg').val();
		var status = $(this).val();
		var src = '/images/status/'+status+'.png';
		$(this).parent().parent().find('img').attr('src',src);
		$.ajax({
				type:"post",
				url:"/system/improvement/ajaxchangestatus/id/"+id+"/status/"+status+"/sendMsg/"+sendMsg,
				success:function(rt){
					if(rt == "s")
					{
						alert("状态更改成功.");
						}
						else
						{
							alert("数据库录入有误,请稍后再试.");
							}
					}
				});
	});
});