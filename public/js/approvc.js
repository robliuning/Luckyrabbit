$(document).ready(function()
{
	$("input[type=text]").focus(function(){
		$(this).select();
	})
	
	$('#calBudget').text(caculateBudgets());

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
		var amountf = 0;
		var cost = 0;
		var costTotal = 0;
		var vendorName = "";
		
		if(validateMtr(mName,spec,amountc,budget,budgetTotal,unit,inDate))
		{
			$.ajax({
					type:"post",
					url:"/pment/material/ajaxadd/planId/"+planId+"/type/"+type+"/mName/"+mName+"/spec/"+spec+"/amountc/"+amountc+"/budget/"+budget+"/budgetTotal/"+budgetTotal+"/unit/"+unit+"/inDate/"+inDate+"/remark/"+remark+"/amountf/"+amountf+"/cost/"+cost+"/costTotal/"+costTotal+"/vendorName/"+vendorName,
					success:function(rt){
							var html = "<tr><td>"+mName+"("+type+")</td>";
							html+="<td><input name='spec_"+rt+"' id='spec_"+rt+"' type='text' class='tbText tbMax' value='"+spec+"'/></td>";
							html+="<td>"+amount+"</td>";
							html+="<td><input name='amountc_"+rt+"' id='amountc_"+rt+"' type='text' class='tbTextS tbMax ajax_amountc' value='"+amountc+"'/></td>";
							html+="<td><input name='budget_"+rt+"' id='budget_"+rt+"' type='text' class='tbTextS tbMax ajax_budget' value='"+budget+"'/></td>";
							html+="<td><input name='budgetTotal_"+rt+"' id='budgetTotal_"+rt+"' type='text' class='tbTextS tbMax ajax_budgetTotal' value='"+budgetTotal+"'/></td>";
							html+="<td>"+unit+"</td>";
							html+="<td>"+inDate+"</td>";
							html+="<td><textarea name='remark_"+rt+"' id='remark_"+rt+"' class='tbText' cols='20%' rows='1'>"+remark+"</textarea></td></tr>";
							$('#conAddMtr').append(html);
							$.nmTop().close();
							$('#calBudget').text(caculateBudgets());
							clear();
						}
					});
			}
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
		$(this).parent().parent().find('#add_budgetTotal').val(sumb);
	});
	
	$('.ajax_amountc').livequery('keyup',function(){
		if(!checknumber($(this).val()))
		{
			var budget = $(this).parent().parent().find('.ajax_budget').val();
			var sumb = $(this).val()*budget;
			sumb = sumb.toFixed(2);
			$(this).parent().parent().find('.ajax_budgetTotal').val(sumb);
		
			$('#calBudget').text(caculateBudgets());
			}
			else
			{
				alert("必须输入数字");
				}
	});
		
	$('.ajax_budget').livequery('keyup',function(){
		if(!checknumber($(this).val()))
		{
			var amountc = $(this).parent().parent().find('.ajax_amountc').val();
			var sumb = $(this).val()*amountc;
			sumb = sumb.toFixed(2);
			$(this).parent().parent().find('.ajax_budgetTotal').val(sumb);
			$('#calBudget').text(caculateBudgets());
			}
			else
			{
				alert("必须输入数字")
				}
	});
	
	$('#btAp').click(function(){
		var planId = $('#add_planId').text();
		var contactId = $('.ac_registerId').val();
		var contactName = $('.ac_registerName').val();
		if(contactId == "")
		{
			alert("请选择核验人!")
			}
			else
			{
				$.ajax({
					type:"post",
					url:"/pment/reviewer/ajaxadd/planId/"+planId+"/contactId/"+contactId,
					success:function(rt){
						if(rt != "f")
						{
							alert("保存成功!");
							var html = "<tr><td><a class='lightbox' href='/employee/index/ajaxdisplay/id/"+contactId+"'>"+contactName+"</a></td><td><p class='delAp btConfirmVar radius'><span class='hide'>"+rt+"</span>删除核验人</p></td><td></td></tr>";
							$('#tableAp').append(html);
							$('.lightbox').nm();
							$('#tbAp').val("").focus();
							}
							else
							{
								alert("输入用户已存在!");
								}
						}
					});
				}
	});
	
	$('.delAp').livequery('click',function(){
		var reId = $(this).find('span').text();
		$.ajax({
				type:"post",
				url:"/pment/reviewer/ajaxdelete/reId/"+reId,
				success:function(rt){
				if(rt == "s")
				{
					alert("删除成功!");
					}
				}
			});
		$(this).parent().parent().remove();
	});
	
	$(".listMc").livequery('click',function(){
		var table = $(this).parent().find('.conListTable');
		var html = '';
		if($(this).parent().find('.conList').is(":hidden"))
		{
			var mtrId = $(this).parent().find(".mc_mtrId").text();
			$.ajax({
					type:"post",
					url:"/pment/comment/ajaxfetchall/mtrId/"+mtrId,
					success:function(jsonObj){
						var jsonObj = eval('('+jsonObj+')');
						html += "<tr><td><b>添加时间</b></td><td><b>添加人</b></td><td><b>材料审批意见</b></td></tr>";
						if(jsonObj != null)
						{
							for(var i=0;i<jsonObj.length;i++){
								html+='<tr><td>'+ jsonObj[i].addDate + '</td><td><a class="lightbox" href="/employee/index/ajaxdisplay/id/'+jsonObj[i].contactId+'">'+ jsonObj[i].contactName + '</a></td><td>'+ jsonObj[i].comment + '</td></tr>';
								}
							}
							else
							{
								html+='<tr><td colspan="4">暂无内容</td></tr>';
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

function caculateBudgets()
{
	var total = 0;
	$('.ajax_budgetTotal').each(function(){
		var budget = $(this).val();
		if(budget != "")
		{
			budget = parseFloat(budget);
			total += budget;
			}
	});
	total = total.toFixed(2);
	return total;
	}
	
function validateMtr(mName,spec,amountc,budget,budgetTotal,unit,inDate)
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
	$('#add_limitation').val("");
	$('#add_amountc').val("");
	$('#add_budget').val("");
	$('#add_budgetTotal').val("");
	$('#add_weight').val("");
	$('#add_unit').val("");
	$('#add_inDate').val("");
	$('#add_remark').val("");
}