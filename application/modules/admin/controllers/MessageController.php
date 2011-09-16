<?php
//updated in 8th June 2011 by Rob

class Admin_MessageController extends Zend_Controller_Action
{
	public function init()
	{
		/* Initialize action controller here */
		$this->view->module = "admin";
	}
	
	public function preDispatch()
	{
		$this->view->render("_sidebar2.phtml");
	}

	public function indexAction()
	{
		$errorMsg = null;
		$messages = new Admin_Models_MessageMapper();
		$condition[0] = $this->getUserId();
		$condition[1] = null;
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayMessages = array();
			$key = trim($formData['key']);
			if($key != null)
			{
				$condition[1] = $formData['condition'];
				$arrayMessages = $messages->fetchAllJoin($key,$condition);
				if(count($arrayMessages) == 0)
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
			$arrayMessages = $messages->fetchAllJoin(null,$condition);
			}
		if(count($arrayMessages) != 0)
		{
			$pageNumber = $this->_getParam('page');
			$arrayMessages->setCurrentPageNumber($pageNumber);
			$arrayMessages->setItemCountPerPage('20');
		}
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayMessages = $arrayMessages;
		$this->view->controller = "message";
		$this->view->errorMsg = $errorMsg;
		$this->view->modelName = "站内消息";
	}
	
	public function addAction()
	{
		$errorMsg = null;
		$messages = new Admin_Models_MessageMapper();
		$usergroups = new System_Models_UsergroupMapper();
		$addForm = new Admin_Form_MessageSave();
		$addForm->getElement('groupId')->addMultiOption('0','所有用户');
		$addForm->submit->setLabel("发送信息");
		$usergroups->populateDd($addForm);
		$addForm = $messages->formValidator($addForm);
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $messages->dataValidator($formData);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$sendTime = date('Y-m-d,H:m');
					$groupId = $addForm->getValue('groupId');
					$message = new Admin_Models_Message();
					$message->setFromId($this->getUserId());
					$message->setTitle($addForm->getValue('title'));
					$message->setContent($addForm->getValue('content'));
					$message->setSendTime($sendTime);
					$message->setStatus(0);
					$messages->sendByGroup($groupId,$message);
					$this->_helper->flashMessenger->addMessage('信息: '.$message->getTitle().'发送成功。');
					$this->_redirect('/admin/message');
					}
					else
					{
						$addForm->populate($formData);
						}
				}
				else
				{
					$addForm->populate($formData);
					}
			}
		$this->view->controller = "add";
		$this->view->errorMsg = $errorMsg;
		$this->view->addForm = $addForm;
	}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$msgId = $this->_getParam('id',0);
		if($msgId >0)
		{
			$messages = new Admin_Models_MessageMapper();
			try{
				$messages->delete($msgId);
				echo "s";
				}
				catch(Exception $e)
				{
					echo "f";
					}
			}
			else
			{
				$this->_redirect('/admin/message');
				}
	}
	
	public function displayAction()
	{
		$messages = new Admin_Models_MessageMapper();
		$msgId = $this->_getParam('id',0);
		if($msgId > 0)
		{
			$message = new Admin_Models_Message();
			$messages->find($msgId,$message);
			$message->setStatus(1);
			$messages->save($message);
			$this ->view->message = $message;
			}
			else
			{
				$this->_redirect('/admin/message');
				}
	}
	
	protected function getUserId()
	{
		$userNamespace = new Zend_Session_Namespace('userNamespace');
		return $userNamespace->userId;
		}
}
?>