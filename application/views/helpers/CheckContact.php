<?php
class Zend_View_Helper_CheckContact extends Zend_View_Helper_Abstract 
{
	public function checkContact ()
	{
		return "<div class='wg_wrapper'><p class='sb_wg'>查询通讯录</p><div class='wg_form'><input type='text' value='..请输入名字' class='tb_sc tbText tbMediumst ac_contactName' /><input type='text' class='ac_contactId hide' /><p><a href='' class='wg_bt' id='wg_sc'>查看</a></p></div></div>";
		}
}
?>