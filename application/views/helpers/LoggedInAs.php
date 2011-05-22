<?php
class Zend_View_Helper_LoggedInAs extends Zend_View_Helper_Abstract 
{
	public function loggedInAs ()
	{
		$request = Zend_Controller_Front::getInstance()->getRequest();
		$controller = $request->getControllerName();
		$action = $request->getActionName();
		if($controller == 'login') {
			return '';
			}
			
		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity()) {
			$userName = $auth->getIdentity()->username;
			$userId = $auth->getIdentity()->id;
			$logoutUrl = $this->view->url(array('module'=>'admin','controller'=>'login','action'=>'logout'), null, true);
			return '欢迎登陆: <span id="userName">'.$userName.'</span></li><li class="c_info"><a href="/system/emsg/construction">用户设置</a></li><li><a href="'.$logoutUrl.'">注销</a></li>';
		} 
		//<a href="/person/index/index/id/'.$userId.'">用户设置</a></li><li><a href="'.$logoutUrl.'">注销</a>
		
		$loginUrl = $this->view->url(array('module'=>'admin','controller'=>'login','action'=>'logout'));
		return '<a href="'.$loginUrl.'">登录</a>';
		}
}
?>