<?php

class admin_LoginController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$db = $this->_getParam('db');
    	
    	$request = $this->getRequest();
    	
    	$loginForm = new Admin_Form_Auth_Login();

		if($request->isPost())
		{    	
    	if($loginForm->isValid($request->getPost()))
    	{
    		$adapter = new Zend_Auth_Adapter_DbTable($db,'global_users','username','password');
    		$adapter->setIdentity($loginForm->getValue('username'));
    		
    		$adapter->setCredential($loginForm->getValue('password'));
    		
    		$auth = Zend_Auth::getInstance();
    		
    		$result = $auth->authenticate($adapter);
    		
    		$userSession = new zend_Session_Namespace('userSession');
    		unset($userSession->userName);

    		if($result->isValid())
    		{
    			$userSession->userName = $loginForm->getValue('username');	   	 			    			
    			return $this->_redirect('');
    			}
    			else
    			{
    			
    				}
    		}
    	}
    	$this->view->loginForm = $loginForm;
    }
    
}

?>