<?php
class Zend_View_Helper_ShowCalendar extends Zend_View_Helper_Abstract 
{
	public function showCalendar ()
	{
		return "<div class='wg_wrapper'><p class='sb_wg'>日历</p><div id='datepickerInline'></div></div>";
		}
}
?>