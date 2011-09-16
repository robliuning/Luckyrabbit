<?php

class System_UlogController extends Zend_Controller_Action
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
		$this->view->controller = "ulog";
	}
	
	public function preDispatch(){
		$this->view->render("_sidebar.phtml");
	}
	
	public function indexAction()
	{
		$errorMsg = null;
		$ulogs = new System_Models_UlogMapper();
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayUlogs = array();
			$key = trim($formData['key']);
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayUlogs = $ulogs->fetchAllJoin($key,$condition);
				if(count($arrayUlogs) == 0)
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
			$arrayUlogs = $ulogs->fetchAllJoin();
			}
		$pageNumber = $this->_getParam('page');
		$arrayUlogs->setCurrentPageNumber($pageNumber);
		$arrayUlogs->setItemCountPerPage('20');
		$this->view->arrayUlogs = $arrayUlogs;
		$this->view->errorMsg = $errorMsg;
		$this->view->modelName = "在线用户历史";
	}
	
	protected function getUserId()
	{
		$userNamespace = new Zend_Session_Namespace('userNamespace');
		return $userNamespace->userId;
		}
}
?>