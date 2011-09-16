<?php	
	class Admin_Plugin_AuthCheck extends Zend_Controller_Plugin_Abstract
	{
		public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)  	
		{										
			if(!Zend_Auth::getInstance()->hasIdentity() &&
				Zend_Controller_Front::getInstance()->getRequest()->getControllerName() != 'login' && Zend_Controller_Front::getInstance()->getRequest()->getControllerName() != 'emsg')
			{
				$redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
				$redirector->gotoUrl('admin/login');		
			}
		}
	}
?>