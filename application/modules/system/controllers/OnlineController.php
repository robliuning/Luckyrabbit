<?php

class System_OnlineController extends Zend_Controller_Action
{
	public function init()
	{
		/*$userId = $this->getUserId();
		$modName = 'system_online';
		$authorities = new System_Models_AuthorityMapper();
		if(!$authorities->checkAuth($userId,$modName))
		{
			$this->_redirect('/system/emsg/authfailed');
			}*/
		$this->view->module = "system";
		$this->view->controller = "online";
	}
	
	public function preDispatch(){
		$this->view->render("_sidebar.phtml");
	}
	
	public function indexAction()
	{
		$errorMsg = null;
		$onlines = new System_Models_OnlineMapper();
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayOnlines = array();
			$key = trim($formData['key']);
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayOnlines = $onlines->fetchAllJoin($key,$condition);
				if(count($arrayUsers) == 0)
				{
					$errorMsg = General_Models_Text::$text_searchErrorNr;
					}
				}
				else
				{
					$errorMsg = General_Models_Text::$text_searchErrorNi;
					}
		}
		else
		{
			$arrayOnlines = $onlines->fetchAllJoin();
			}
		$pageNumber = $this->_getParam('page');
		$arrayOnlines->setCurrentPageNumber($pageNumber);
		$arrayOnlines->setItemCountPerPage('20');
		$this->view->arrayOnlines = $arrayOnlines;
		$this->view->errorMsg = $errorMsg;
		$this->view->modelName = "在线用户";
	}
	
	protected function getUserId()
	{
		$userNamespace = new Zend_Session_Namespace('userNamespace');
		return $userNamespace->userId;
		}
}
?>