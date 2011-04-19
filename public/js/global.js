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
	$( "#contactName" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "/employee/index/autocomplete/key/"+ $("#contactName").val(),
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
				$("#contactId").val(ui.item.name);
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
	
	//---------end
});