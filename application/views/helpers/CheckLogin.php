<?php
class Zend_View_Helper_CheckLogin extends Zend_View_Helper_Abstract 
{
	public function checkLogin ()
	{
		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity()) {
			return true;
		} 
		return false;
		}
}
?>