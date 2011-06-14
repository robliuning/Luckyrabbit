<?php

class Pment_IndexController extends Zend_Controller_Action
{
	public function init()
	{
		/* Initialize action controller here */
	}
	
	public function preDispatch(){
		$this -> view ->render("_sidebar.phtml");
	}

	public function indexAction() 
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$projectId = $this->_getParam('id',0);
		if($projectId != 0)
		{
			$projectNamespace = new Zend_Session_Namespace('projectNamespace');
			$projectNamespace->projectId = $projectId;
			$this->_redirect('/pment/cpp');
			}
			else
			{
				$this->_redirect('/');
				}
		}
}
?>