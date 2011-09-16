$(document).ready(function()
{
	$(".addMc").livequery('click',function(){
		if($(this).parent().find('.conAdd').is(":hidden")) {
		$(this).parent().find('.conAdd').slideDown("slow");
		$(this).parent().find('.taMc').focus().val("");
		} else {
		$(this).parent().find('.conAdd').slideUp("slow");
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
					url:"/pment/comment/ajaxfetchall/mtrId/"+mtrId,
					success:function(jsonObj){
						var jsonObj = eval('('+jsonObj+')');
						html += "<tr><td><b>添加时间</b></td><td><b>添加人</b></td><td><b>材料审批意见</b></td><td></td></tr>";
						if(jsonObj != null)
						{
							for(var i=0;i<jsonObj.length;i++){
								html+='<tr><td>'+ jsonObj[i].addDate + '</td><td><a class="lightbox" href="/employee/index/ajaxdisplay/id/'+jsonObj[i].contactId+'">'+ jsonObj[i].contactName + '</a></td><td>'+ jsonObj[i].comment + '</td><td><p class="btDelMc btConfirmVar radius">删除<span class="hide">'+jsonObj[i].cId+'</span></p></td></tr>';
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
	
	$('.btDelMc').livequery('click',function(){
		var cId = $(this).find('span.hide').text().trim();
		$.ajax({
				type:"post",
				url:"/pment/comment/ajaxdelete/cId/"+cId,
				success:function(rt){
				if(rt == "s")
				{
					alert("删除成功!");
					}
				}
			});
		$(this).parent().parent().remove();
	});
	
	$('.btAddMc').livequery('click',function(){
		var mtrId = $(this).find('span.hide').text().trim();
		var comment = $(this).parent().parent().find('.taMc').val().trim();
		var table = $(this).parent().parent().parent().parent().parent().parent().find('.conListTable');
		var conList = $(this).parent().parent().parent().parent().parent().parent().find('.conList');
		var conAdd = $(this).parent().parent().parent().parent().parent().parent().find('.conAdd');
		if(comment != "")
		{
			$.ajax({
					type:"post",
					url:"/pment/comment/ajaxadd/mtrId/"+mtrId+"/comment/"+comment,
					success:function(rt){
						if(rt != "f")
						{
							alert("保存成功!");
							if(!conList.is(":hidden"))
							{
								var jsonObj = eval('('+rt+')');
								var html = '<tr><td>'+ jsonObj.addDate + '</td><td><a class="lightbox" href="/employee/index/ajaxdisplay/id/'+jsonObj.contactId+'">'+ jsonObj.contactName + '</a></td><td>'+ comment + '</td><td><p class="btDelMc btConfirmVar radius">删除<span class="hide">'+jsonObj.cId+'</span></p></td></tr>';
								table.append(html);
								$('.lightbox').nm();
								}
							conAdd.slideUp("slow");
							}
							else
							{
								alert("保存失败,请稍后再试!");
								}
						}
					});
			}
			else
			{
				alert('请填写审批意见!');
				}
		
	});

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
							html+="<td>"+spec+"</td>";
							html+="<td>"+amount+"</td>";
							html+="<td>"+amountc+"</td>";
							html+="<td>"+budget+"</td>";
							html+="<td>"+budgetTotal+"</td>";
							html+="<td>"+unit+"</td>";
							html+="<td>"+inDate+"</td>";
							html+="<td>"+remark+"</td></tr>";
							html+="<tr><td colspan='9'><p class='hide mc_mtrId'>"+rt+"</p><p class='listMc ajaxButton'>+查看材料审批意见</p><div class='conList hide'><table class='conListTable'><colgroup><col style='width:8%'></col><col style='width:7%'></col><col style='width:75%'></col><col style='width:10%'></col></colgroup></table></div><p class='addMc ajaxButton'>+添加材料审批意见</p><div class='conAdd hide'><table><colgroup><col style='width:30%'></col><col style='width:15%'></col><col style='width:55%'></col></colgroup><tr><td><textarea class='taMc tbText' cols='60' rows='4'></textarea></td><td><p class='btAddMc btConfirmVar radius'>添加<span class='hide'>"+rt+"</span></p></td><td></td></tr></table></div></td></tr>";
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
	
	
});

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
	$('#add_amountc').val("");
	$('#add_budget').val("");
	$('#add_budgetTotal').val("");
	$('#add_unit').val("");
	$('#add_inDate').val("");
	$('#add_remark').val("");
}