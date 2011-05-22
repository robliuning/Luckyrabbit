$(document).ready(function()
{
	$('.pfocus').focus();
	
	$("#reset").click(function() {
		$("form").each(function() {
		this.reset();
		$('.pfocus').focus();
		})
	});
//form element login
	if($('#p_id').text() == 'admin')
	{
		$('#nav_main').addClass('hide');
		$('#nav_sub').addClass('hide');
		}
//form element vehicle repair
	if($('#insFlag').val() == '1')
	{
		$('#indem').removeAttr('disabled');
		}

	$('#insFlag').change(function(){
		if($('#insFlag').val() == '0')
		{
			$('#indem').val('选择出险时填写').attr('disabled','disabled');
			}
			else
			{
				$('#indem').val('').removeAttr('disabled').focus();
				}
		});
//form element vehicle verecord
	if($('#prjFlag').val() == '1')
	{
		$('#projectId').removeAttr('disabled');
		}

	$('#prjFlag').change(function(){
		if($('#prjFlag').val() == '0')
		{
			$('#projectId').val(0).attr('disabled','disabled');
			}
			else
			{
				$('#projectId').removeAttr('disabled').focus();
				}
		});
});