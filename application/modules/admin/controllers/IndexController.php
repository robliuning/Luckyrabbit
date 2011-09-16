<?php
class admin_IndexController extends Zend_Controller_Action
{
	public function init()
	{
		/* Initialize action controller here */
		$this->view->module = "admin";
		$this->view->controller = "index";
	}
	public function preDispatch(){
		$this -> view ->render("_sidebar.phtml");
	}
	
	public function indexAction()
	{
		$userId = $this->getUserId();
		$editForm = new System_Forms_UserEdit();
		$users = new System_Models_UserMapper();
		$user = new System_Models_User();
		$users->find($userId,$user);
		$editForm->submit->setLabel('修改密码');
		$errorMsg = null;
		$ugs = new System_Models_UsergroupMapper();
		$editForm = $users->formValidatorEdit($editForm);
			
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$array = $users->dataValidatorEdit($formData,$userId);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$salt = md5(General_Models_GenRandomString::genRandomString(8));
					$password = sha1($formData['password'].$salt);
					$user->setPassword($password);
					$user->setSalt($salt);
					$users->save($user);
					$this->_redirect('/admin/login/logout');
					}
					else
					{
						$editForm->populate($formData);
						}
				}
				else
				{
					$editForm->populate($formData);
					}
		}
		$this->view->user = $user;
		$this->view->errorMsg = $errorMsg;
		$this->view->editForm = $editForm;
	}
	
	protected function getUserId()
	{
		$userNamespace = new Zend_Session_Namespace('userNamespace');
		return $userNamespace->userId;
		}
}
?>