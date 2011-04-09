//Missing
//Validate deletion result
$(document).ready(function()
{  	
	//Enable the auto-completing
	$( "#name" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "/employee/employee/autocomplete/key/"+$("#name").val(),
					//dataType: "jsonp",
					data: {
						featureClass: "P",
						style: "full",
						maxRows: 12,
						name_startsWith: request.term
					},
					success: function( data ) {
							response( $.map(data, function(item) {
							return {
								label: "123",
								value: "123",
								name:"test"
							}
						}));
					}
				});
			},
			minLength:1,
			select: function( event, ui ) {
				$("#empId").val(ui.item.name);
				alert($("#empId").val());
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
	
	//---------end	
	
	$('#btDel').hover(function(){
		var count = $('[name="cb"]:checked').length;
		var htmlDelete = "<div id='msgBox_delete'>";
		if(count == 0)
		{
			htmlDelete += "请先选择您要删除的公司员工信息。";
			}
			else
			{
				htmlDelete = "您选择了"+count+"个公司员工信息，点击确认后相关资料将被永久删除。<div><p id='btConfirm' class='btDelete radius'>确认删除</p></div>";
				}
		htmlDelete+="</div>";
		$('#msgBox').html(htmlDelete);
		
		$('#btConfirm').click(function(){
			$('[name="cb"]:checked').each(function(){
				var id = $(this).val();
				var result = 1;
				$.ajax({
					type:"post",
					url:"/employee/employee/ajaxdelete/id/"+id,
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
						alert("公司员工信息id:"+id+"未能删除");
						}		
			});		
			alert("删除完成");
			window.location = "/employee/employee";	
		});
	});
});
