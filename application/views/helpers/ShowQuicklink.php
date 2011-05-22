<?php
class Zend_View_Helper_ShowQuicklink extends Zend_View_Helper_Abstract 
{
	public function showQuicklink ()
	{
		return "<div class='wg_wrapper'><p class='sb_wg'>快速创建</p><select id = 'quicklink'><option value='select'>...快速创建</option><option value='contact'>新建通讯录</option><option value='project'>新建项目</option></select></div>";
		}
}
?>