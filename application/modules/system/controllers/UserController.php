<?php

class System_UserController extends Zend_Controller_Action
{
	public function init()
	{
		$userId = $this->getUserId();
		$modName = 'system_user';
		$authorities = new System_Models_AuthorityMapper();
		if(!$authorities->checkAuth($userId,$modName))
		{
			$this->_redirect('/system/emsg/authfailed');
			}
		$this->view->module = "system";
		$this->view->controller = "user";
	}
	
	public function preDispatch(){
		$this -> view ->render("_sidebar.phtml");
	}
	
	public function indexAction()
	{
		$errorMsg = null;
		$users = new System_Models_UserMapper();
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayUsers = array();
			$key = trim($formData['key']);
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayUsers = $users->fetchAllJoin($key,$condition);
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
			$arrayUsers = $users->fetchAllJoin();
			}
		if(count($arrayUsers) != 0)
		{
			$pageNumber = $this->_getParam('page');
			$arrayUsers->setCurrentPageNumber($pageNumber);
			$arrayUsers->setItemCountPerPage('20');
		}
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayUsers = $arrayUsers;
		$this->view->errorMsg = $errorMsg;
		$this->view->modelName = "用户信息";
	}
	
	public function addAction()
	{
		$addForm = new System_Forms_UserSave();
		$users = new System_Models_UserMapper();
		$addForm->submit->setLabel('创建建用户');
		$errorMsg = null;
		$ugs = new System_Models_UsergroupMapper();
		$ugs->populateDd($addForm);
		$addForm = $users->formValidator($addForm,0);
			
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $users->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$cTime = date("Y-m-d,H:m");
					$creatorId = $this->getUserId();
					$creatorCid = $users->getContactId($creatorId);
					$user = new System_Models_User();
					$salt = md5(General_Models_GenRandomString::genRandomString(8));
					$password = sha1($formData['password'].$salt);
					$user->setUserName($addForm->getValue('username'));
					$user->setPassword($password);
					$user->setSalt($salt);
					$user->setGroupId($addForm->getValue('groupId'));
					$user->setContactId($addForm->getValue('contactId'));
					$user->setCreatorId($creatorCid);
					$user->setCTime($cTime);
					$users->save($user);
					$this->_helper->flashMessenger->addMessage('添加用户成功。');
					$this->_redirect('/system/user');
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
		$this->view->errorMsg = $errorMsg;
		$this->view->addForm = $addForm;
	}
	
	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$id = $this->_getParam('id',0);
		if($id > 0)
		{
			$users = new System_Models_UserMapper();
			try{
				$users->delete($id);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/system/user');
		}
	}

	protected function getUserId()
	{
		$userNamespace = new Zend_Session_Namespace('userNamespace');
		return $userNamespace->userId;
		}
}
?>