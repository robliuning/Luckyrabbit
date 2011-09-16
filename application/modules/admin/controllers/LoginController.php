<?php

class admin_LoginController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		$errorMsg = null;
		$loginForm = new Admin_Form_Login();
		$logins = new Admin_Models_LoginMapper();
		$loginForm = $logins->formValidator($loginForm);
		$request = $this->getRequest();
		if ($request->isPost()) {
			if ($loginForm->isValid($request->getPost())) {
				if ($this->_process($loginForm->getValues())) {
					// We're authenticated! Redirect to the home page
					$value = $loginForm->getValues();
					$userName = $value['username'];
					$users = new System_Models_UserMapper();
					$userId = $users->getUserId($userName);
					$userNamespace = new Zend_Session_Namespace('userNamespace');
					$userNamespace->userId = $userId;
					// add user to online list
					$onlines = new System_Models_OnlineMapper();
					$onlines->save($userId);
					$onlines->updateOnlineUsers();
					// add user to ulog list
					$ulogs = new System_Models_UlogMapper();
					$ulogs->save($userId,'登陆');
					$this->_redirect('/');
				}
				else
				{
					$errorMsg = General_Models_Text::$text_loginFailed;
					}
			}
		}
		$this->view->errorMsg = $errorMsg;
		$this->view->loginForm = $loginForm;
	}

	protected function _process($values)
	{
		// Get our authentication adapter and check credentials
		$adapter = $this->_getAuthAdapter();
		$adapter->setIdentity($values['username']);
		$adapter->setCredential($values['password']);

		$auth = Zend_Auth::getInstance();
		$result = $auth->authenticate($adapter);
		if ($result->isValid()) {
			$user = $adapter->getResultRowObject();
			$auth->getStorage()->write($user);
			return true;
		}
		return false;
	}

	protected function _getAuthAdapter()
	{
		$dbAdapter = Zend_Db_Table::getDefaultAdapter();
		$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

		$authAdapter->setTableName('sy_users')
					->setIdentityColumn('username')
					->setCredentialColumn('password')
					->setCredentialTreatment('SHA1(CONCAT(?,salt))');

		return $authAdapter;
	}

	public function logoutAction()
	{
		$userId = $this->getUserId();
		$onlines = new System_Models_OnlineMapper();
		$onlines->deleteUser($userId);
		$ulogs = new System_Models_UlogMapper();
		$ulogs->save($userId,'登出');
		Zend_Auth::getInstance()->clearIdentity();
		$this->_helper->redirector('index'); // back to login page
	}
	
	protected function getUserId()
	{
		$userNamespace = new Zend_Session_Namespace('userNamespace');
		return $userNamespace->userId;
		}
}

?>