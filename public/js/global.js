$(document).ready(function()
{  
	$('.lightbox').nm();
	
		$('#cb_sa').click(function(){
		
		if($(this).attr("checked") == true)
		{
			$("[name='cb']").each(function(){
				if($(this).attr("checked") == false)
				{
					$(this).attr("checked", true);
				}
			});
		}
		else
		{
			$("[name='cb']").each(function(){
				if($(this).attr("checked") == true)
				{
					$(this).attr("checked",false);
				}
			});
			}
	});
	
	$("#reset").click(function() {   
  		$("form").each(function() {   
   		this.reset();  
		})
	});
	
	$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true, yearRange: "-70:+10"},$.datepicker.regional[ "zh-CN" ],("option", "dateFormat","YY-MM-DD"));
	
		//Enable the auto-completing
	$( ".ac_contactName" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "/employee/index/autocomplete/key/"+ $(".ac_contactName").val(),
					//dataType: "jsonp",
					data: {
						featureClass: "P",
						style: "full",
						maxRows: 12,
					},
					success: function(data) {
							var jsonObj = eval('('+data+')');
							response( $.map(jsonObj, function(item) {
							return {
								label: "姓名: "+item.name +"　电话: "+item.phoneNo+"　职称: "+item.titleName,
								value: item.name,
								name: item.contactId
							}
						}));
					}
				});
			},
			minLength:1,
			select: function( event, ui ) {
				$(".ac_contactId").val(ui.item.name);
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
	
	//---------end
	var modelName = $('#modelName').val();
	var module = $('#module').val();
	var controller = $('#controller').val();
		
	$('#btDel').hover(function(){
		var count = $('[name="cb"]:checked').length;
		var htmlDelete = "<div id='msgBox_delete'>";
		if(count == 0)
		{
			htmlDelete += "请先选择您要删除的"+modelName+"。";
			}
			else
			{
				htmlDelete = "您选择了"+count+"个"+modelName+"，点击确认后相关资料将被永久删除。<div><p class='ajaxDelete btDelete radius'>确认删除</p></div>";
				}
		htmlDelete+="</div>";
		$('#msgBox').html(htmlDelete);
		
		$('.ajaxDelete').click(function(){
			$('[name="cb"]:checked').each(function(){
				var id = $(this).val();
				var result = 1;
				$.ajax({
					type:"post",
					url:"/"+module+"/"+controller+"/ajaxdelete/id/"+id,
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
						alert(modelName+" id:"+id+"未能删除");
						}		
			});		
			alert("删除完成");
			window.location = "/"+module+"/"+controller;	
		});
	});
	
});