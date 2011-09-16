$(document).ready(function()
{
	$('#btClear').click(function(){
		clear();
	});

	$('#btAdd').click(function(){
		var planId = $('#add_planId').text().trim();
		var type = $('#add_type').val().trim();
		var mName = $('#add_mName').val().trim();
		var spec = $('#add_spec').val().trim();
		var amount = 0;
		var amountc = $('#add_amountc').val().trim();
		var budget = $('#add_budget').val().trim();
		var budgetTotal = $('#add_budgetTotal').val().trim();
		var unit = $('#add_unit').val().trim();
		var inDate = $('#add_inDate').val().trim();
		var remark = $('#add_remark').val().trim();
		var amountf = $('#add_amountf').val().trim();
		var cost = $('#add_cost').val().trim();
		var costTotal = $('#add_costTotal').val().trim();
		var vendorName = $('#add_vendorName').val().trim();
		
		if(validateMtr(mName,spec,amountc,amountf,budget,budgetTotal,cost,costTotal,unit,inDate))
		{
			$.ajax({
					type:"post",
					url:"/pment/material/ajaxadd/planId/"+planId+"/type/"+type+"/mName/"+mName+"/spec/"+spec+"/amountc/"+amountc+"/budget/"+budget+"/budgetTotal/"+budgetTotal+"/unit/"+unit+"/inDate/"+inDate+"/remark/"+remark+"/amountf/"+amountf+"/cost/"+cost+"/costTotal/"+costTotal+"/vendorName/"+vendorName,
					success:function(rt){
							var html = "<tr><td>"+mName+"("+type+")</td>";
							html+="<td>"+spec+"</td>";
							html+="<td>"+amountc+"</td>";
							html+="<td><input name='amountf_"+rt+"' id='amountf_"+rt+"' type='text' class='tbTextS tbMax ajax_amountf' value='"+amountf+"'/></td>";
							html+="<td><input name='cost_"+rt+"' id='cost_"+rt+"' type='text' class='tbTextS tbMax ajax_cost' value='"+cost+"'/></td>";
							html+="<td><input name='costTotal_"+rt+"' id='costTotal_"+rt+"' type='text' class='tbTextS tbMax ajax_costTotal' value='"+costTotal+"'/></td>";
							html+="<td><input name='vendorName_"+rt+"' id='vendorName_"+rt+"' type='text' class='tbText tbMax' value='"+vendorName+"'/></td></tr><tr><td colspan='11'><p class='hide mc_mtrId'>"+rt+"</p><p class='listMc ajaxButton'>+查看材料详情</p><div class='conList hide'>";
							html+="<table class='conListTable'><colgroup><col style='width:15%'></col><col style='width:15%'></col><col style='width:15%'></col><col style='width:10%'></col><col style='width:15%'></col><col style='width:30%'></col></colgroup></table></div></td></tr>";
							$('#conAddMtr').append(html);
							$.nmTop().close();
							clear();
						}
					});
			}
	});
	
	$("input[type=text]").focus(function(){
		$(this).select();
	})
	
	$('#add_amountf').keyup(function(){
			var cost = $(this).parent().parent().parent().find('#add_cost').val();
			var sumb = $(this).val()*cost;
			sumb = sumb.toFixed(2);
			$(this).parent().parent().parent().find('#add_costTotal').val(sumb);
	});
		
	$('#add_cost').keyup(function(){
		var amountf = $(this).parent().parent().parent().find('#add_amountf').val();
		var sumb = $(this).val()*amountf;
		sumb = sumb.toFixed(2);
		$(this).parent().parent().parent().find('#add_costTotal').val(sumb);
	});
	
	$('#add_amountc').keyup(function(){
			var budget = $(this).parent().parent().parent().find('#add_budget').val();
			var sumb = $(this).val()*budget;
			sumb = sumb.toFixed(2);
			$(this).parent().parent().parent().find('#add_budgetTotal').val(sumb);
	});
		
	$('#add_budget').keyup(function(){
		var amountc = $(this).parent().parent().parent().find('#add_amountc').val();
		var sumb = $(this).val()*amountc;
		sumb = sumb.toFixed(2);
		$(this).parent().parent().parent().find('#add_budgetTotal').val(sumb);
	});
	
	$('.ajax_amountf').livequery('keyup',function(){
		if(!checknumber($(this).val()))
		{
			var cost = $(this).parent().parent().find('.ajax_cost').val();
			var sumb = $(this).val()*cost;
			sumb = sumb.toFixed(2);
			$(this).parent().parent().find('.ajax_costTotal').val(sumb);
			}
			else
			{
				alert("必须输入数字");
				}
	});
		
	$('.ajax_cost').livequery('keyup',function(){
		if(!checknumber($(this).val()))
		{
			var amountf = $(this).parent().parent().find('.ajax_amountf').val();
			var sumb = $(this).val()*amountf;
			sumb = sumb.toFixed(2);
			$(this).parent().parent().find('.ajax_costTotal').val(sumb);
			}
			else
			{
				alert("必须输入数字")
				}
	});
	
	$(".listMc").livequery('click',function(){
		var table = $(this).parent().find('.conListTable');
		var html = '';
		if($(this).parent().find('.conList').is(":hidden"))
		{
			var mtrId = $(this).parent().find(".mc_mtrId").text();
			$.ajax({
					type:"post",
					url:"/pment/material/ajaxfind/mtrId/"+mtrId,
					success:function(jsonObj){
						var jsonObj = eval('('+jsonObj+')');
						html = "<tr><td>项目部报量</td><td>控制价(人民币)</td><td>控制价合价(人民币)</td><td>单位</td><td>需进场日期</td><td>备注</td></tr>";
						if(jsonObj != null)
						{
							for(var i=0;i<jsonObj.length;i++){
								html+='<tr><td>'+ jsonObj[i].amount + '</td><td>'+ jsonObj[i].budget + '</a></td><td>'+ jsonObj[i].budgetTotal + '</td><td>'+ jsonObj[i].unit + '</td><td>'+ jsonObj[i].inDate + '</td><td>'+ jsonObj[i].remark + '</td></tr>';
								}
							}
						table.append(html);
						$('.lightbox').nm();
						}
					});
			$(this).parent().find('.conList').slideDown("slow");
			}
			else 
			{
				$(this).parent().find('.conList').slideUp("slow");
				table.find('td').parent().remove();
			}
	});
});

function validateMtr(mName,spec,amountc,amountf,budget,budgetTotal,cost,costTotal,unit,inDate)
{
	var validation = true;
	if(mName == "")
	{
		validation = false;
		$('#add_mName').parent().append("<span class='red add_errorMsg'> 材料名不能为空</span>");
		}
	if(spec == "")
	{
		validation = false;
		$('#add_spec').parent().append("<span class='red add_errorMsg'> 规格型号不能为空</span>");
		}
	if(amountc == "")
	{
		validation = false;
		$('#add_amountc').parent().append("<span class='red add_errorMsg'> 预算部核量不能为空</span>");
		}
		else if(checknumber(amountc))
		{
			validation = false;
			$('#add_amountc').parent().append("<span class='red add_errorMsg'> 预算部核量必须为数字</span>");
			}
	if(amountf !="")
	{
		if(checknumber(amountf))
		{
			validation = false;
			$('#add_amountf').parent().append("<span class='red add_errorMsg'> 实收数量必须为数字</span>");
			}
		}
	if(cost !="")
	{
		if(checknumber(cost))
		{
			validation = false;
			$('#add_cost').parent().append("<span class='red add_errorMsg'> 成本价必须为数字</span>");
			}
		}
	if(costTotal !="")
	{
		if(checknumber(costTotal))
		{
			validation = false;
			$('#add_costTotal').parent().append("<span class='red add_errorMsg'> 成本价合价必须为数字</span>");
			}
		}
	if(budget == "")
	{
		validation = false;
		$('#add_budget').parent().append("<span class='red add_errorMsg'> 控制价不能为空</span>");
		}
		else if(checknumber(budget))
		{
			validation = false;
			$('#add_budget').parent().append("<span class='red add_errorMsg'> 控制价必须为数字</span>");
			}
	if(budgetTotal == "")
	{
		validation = false;
		$('#add_budgetTotal').parent().append("<span class='red add_errorMsg'> 控制价合价不能为空</span>");
		}
		else if(checknumber(budgetTotal))
		{
			validation = false;
			$('#add_budgetTotal').parent().append("<span class='red add_errorMsg'> 控制价合价必须为数字</span>");
			}
	$('.add_errorMsg').fadeOut(5000, function() {
	// Animation complete.
	});
	return validation;
	}
function checknumber(String)
{
	var Letters = "1234567890.";
	var i;
	var c;
	for( i = 0; i < String.length; i ++ )
	{
		c = String.charAt( i );
		if (Letters.indexOf( c ) ==-1)
		{
			return true;
			}
		}
	return false;
}
function clear()
{
	$('#add_type').val("");
	$('#add_mName').val("").focus();
	$('#add_spec').val("");
	$('#add_amountc').val("");
	$('#add_budget').val("");
	$('#add_budgetTotal').val("");
	$('#add_unit').val("");
	$('#add_inDate').val("");
	$('#add_remark').val("");
	$('#add_cost').val("");
	$('#add_costTotal').val("");
	$('#add_vendorName').val("");
	$('#add_amountf').val("");
}