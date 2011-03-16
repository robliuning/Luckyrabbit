<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		$userSession = new Zend_Session_Namespace('userSession');
	
		if(!isset($userSession->userName))
		{
			return $this->_redirect('admin/login');
		}
	}


}

?>