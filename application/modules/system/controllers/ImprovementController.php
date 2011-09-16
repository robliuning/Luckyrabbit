<?php

class System_ImprovementController extends Zend_Controller_Action
{
	public function init()
	{
		$this->view->module = "system";
		$this->view->controller = "improvement";
	}
	
	public function preDispatch(){
		$this -> view ->render("_sidebar.phtml");
	}
	
	public function indexAction()
	{
		$this->checkAuth();
		$errorMsg = null;
		$improvements = new System_Models_ImprovementMapper();
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayImprovements = array();
			$key = trim($formData['key']);
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayImprovements = $improvements->fetchAllJoin($key,$condition);
				if(count($arrayImprovements) == 0)
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
			$arrayImprovements = $improvements->fetchAllJoin();
			}
		if(count($arrayImprovements) != 0)
		{
			$pageNumber = $this->_getParam('page');
			$arrayImprovements->setCurrentPageNumber($pageNumber);
			$arrayImprovements->setItemCountPerPage('20');
		}
		$this->view->arrayImprovements = $arrayImprovements;
		$this->view->errorMsg = $errorMsg;

		$this->view->modelName = "系统问题反馈";
	}
	
	public function ajaxdeleteAction()
	{
		$this->checkAuth();
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$id = $this->_getParam('id',0);
		if($id > 0)
		{
			$improvements = new System_Models_ImprovementMapper();
			try{
				$improvements->delete($id);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/system/improvement');
		}
	}
	
	public function ajaxaddAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$description = $this->_getParam('description');
		$typeId = $this->_getParam('typeId');
		$modId = $this->_getParam('modId');
		$priority = $this->_getParam('priority');
		$userId = $this->getUserId();
		$iTime = date("Y-m-d,H:i");
		$status = 0;
		$improvements = new System_Models_ImprovementMapper();
		$improvement = new System_Models_Improvement();
		$improvement->setTypeId($typeId);
		$improvement->setModId($modId);
		$improvement->setPriority($priority);
		$improvement->setUserId($userId);
		$improvement->setDescription($description);
		$improvement->setITime($iTime);
		$improvement->setStatus($status);
		try
		{
			$improvements->save($improvement);
			echo "系统问题提交成功.";
			}
			catch(Exception $e)
			{
				echo "系统问题提交失败,请稍后再试.";
			}	
	}
	
	public function ajaxdisplayAction()
	{
		$this->checkAuth();
		$this->_helper->layout()->disableLayout();
		$improvements = new System_Models_ImprovementMapper();
		$id = $this->_getParam('id',0);
		if($id >0)
		{
			$improvement = new System_Models_Improvement();
			$improvements->find($id,$improvement);
			$this ->view->improvement = $improvement;
			}
			else
			{
				$this->_redirect('/system/improvement');
				}
		}
		
	public function ajaxchangestatusAction()
	{
		$this->checkAuth();
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$id = $this->_getParam('id');
		$status = $this->_getParam('status');
		$sendMsg = $this->_getParam('sendMsg');
		$improvements = new System_Models_ImprovementMapper();
		$improvement = new System_Models_Improvement();
		$improvements->find($id,$improvement);
		$improvement->setStatus($status);
		try
		{
			$improvements->save($improvement);
			if($sendMsg == 1)
			{
				$message = new Admin_Models_Message();
				$message->setTitle("系统消息: 您提交的系统问题的状态已被更改为: ".$improvement->getStatusCh());
				$message->setContent("您于".$improvement->getITime()."提交的关于".$improvement->getModNameCh()."模块的问题 : ".$improvement->getDescription()."已被处理, 当前状态为: ".$improvement->getStatusCh());
				$message->setFromId(1);
				$message->setToId($improvement->getUserId());
				$message->setSendTime(date('Y-m-d,H:i'));
				$message->setStatus(0);
				$messages = new Admin_Models_MessageMapper();
				$messages->sendByUserId($message);
				}
			echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
				}
	}

	public function populatemodnamechddAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$modnames = new System_Models_ModnameMapper();
		$arrayModNameChs = $modnames->findModNameChs();
		$json = Zend_Json::encode($arrayModNameChs);
		
		echo $json;
	}
	
	public function populateimptypeddAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$imptypes = new System_Models_ImptypeMapper();
		$arrayImptypes = $imptypes->findImptypes();
		$json = Zend_Json::encode($arrayImptypes);
		
		echo $json;
	}

	protected function getUserId()
	{
		$userNamespace = new Zend_Session_Namespace('userNamespace');
		return $userNamespace->userId;
		}
		
	protected function checkAuth()
	{
		$userId = $this->getUserId();
		$modName = 'system_improvement';
		$authorities = new System_Models_AuthorityMapper();
		if(!$authorities->checkAuth($userId,$modName))
		{
			$this->_redirect('/system/emsg/authfailed');
			}
	}
}
?>