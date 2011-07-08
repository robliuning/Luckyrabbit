$(document).ready(function()
{
	$('.ajax_amountc').keyup(function(){
		var cost = $(this).parent().parent().find('.ajax_cost').val();
		var sumc = $(this).val()*cost;
		sumc = sumc.toFixed(2);
		$(this).parent().parent().find('.ajax_costTotal').val(sumc);
		var budget = $(this).parent().parent().find('.ajax_budget').val();
		var sumb = $(this).val()*budget;
		sumb = sumb.toFixed(2);
		$(this).parent().parent().find('.ajax_budgetTotal').val(sumb);
		
		$('#calCost').text(caculateCosts());
		$('#calBudget').text(caculateBudgets());
	});
	
	$('.ajax_cost').keyup(function(){
		var amountc = $(this).parent().parent().find('.ajax_amountc').val();
		var sumc = $(this).val()*amountc;
		sumc = sumc.toFixed(2);
		$(this).parent().parent().find('.ajax_costTotal').val(sumc);
		$('#calCost').text(caculateCosts());
	});
	
	$('.ajax_budget').keyup(function(){
		var amountc = $(this).parent().parent().find('.ajax_amountc').val();
		var sumb = $(this).val()*amountc;
		sumb = sumb.toFixed(2);
		$(this).parent().parent().find('.ajax_budgetTotal').val(sumb);
		$('#calBudget').text(caculateBudgets());
	});
});

function caculateCosts()
{
	var total = 0;
	$('.ajax_costTotal').each(function(){
		var cost = $(this).val();
		if(cost != "")
		{
			cost = parseFloat(cost);
			total += cost;
			}
	});
	total = total.toFixed(2);
	return total;
	}
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