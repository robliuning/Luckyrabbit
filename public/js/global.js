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
	
	$('.stSearch').change(function() {
  		if($('.stSearch').val() == 'date')
  		{
  			$('.tbSearch').addClass('datepicker');
  			$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true, yearRange: "-70:+10"},$.datepicker.regional[ "zh-CN" ],("option", "dateFormat","YY-MM-DD"));
  			}
		});
	
	$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true, yearRange: "-70:+10"},$.datepicker.regional[ "zh-CN" ],("option", "dateFormat","YY-MM-DD"));
	
		//Enable the auto-completing of contacts
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
	//Enable the auto-completing of workers
		$( ".ac_workerName" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "/worker/worker/autocomplete/key/"+ $(".ac_workerName").val(),
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
								label: "姓名: "+item.name +"　电话: "+item.phoneNo,
								value: item.name,
								name: item.workerId
							}
						}));
					}
				});
			},
			minLength:1,
			select: function( event, ui ) {
				$(".ac_workerId").val(ui.item.name);
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
	//--------end
	
	var modelName = $('#modelName').val();
	var module = $('#module').val();
	var controller = $('#controller').val();
		
	$('#btDel').hover(function(){
		var count = $('[name="cb"]:checked').length;
		var htmlDelete = "<div id='msgBox_delete'>";
		if(count == 0)
		{
			htmlDelete +="<div class='overall_tool'><div class='pos_center'><a ><img src='/images/icons/functions/warning_large.png'/></a></div></div>";
			htmlDelete += "<div class='overall_content'><p class='ajaxMsgBox_text'>请先选择您要删除的"+modelName+"。</p></div>";
			}
			else
			{
				htmlDelete +="<div class='overall_tool'><div class='button_group'><div><a href='#' id='ajaxDelete' class='radius'><img src='/images/icons/functions/delete.png'/><p>删除</p></a></div></div></div>";
				htmlDelete += "<div class='overall_content'><p class='ajaxMsgBox_text'>您选择了<span class='fontLarge red'>"+count+"</span>个"+modelName+"，点击<span class='red'>删除</span>后相关资料将被永久删除。</p></div>";
				}
		htmlDelete+="</div>";
		$('#msgBox').html(htmlDelete);
		
		$('#ajaxDelete').click(function(){
			$('[name="cb"]:checked').each(function(){
				var id = $(this).val();
				var result = 1;
				$.ajax({
					type:"post",
					url:"/"+module+"/"+controller+"/ajaxdelete/id/"+id,
					success:function(rt){
						if(rt == "f")
						{
							alert(modelName+" id:"+id+"未能删除，因为其在其他数据表单有关联数据");
							}
						}
					});	
			});		
			alert("删除完成");
			window.location = "/"+module+"/"+controller;	
		});
	});
});