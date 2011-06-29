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
					$userNamespace = new Zend_Session_Namespace('userNamespace');
					$userNamespace->userId = $userId;
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

		$authAdapter->setTableName('users')
					->setIdentityColumn('username')
					->setCredentialColumn('password')
					->setCredentialTreatment('SHA1(CONCAT(?,salt))');

		return $authAdapter;
	}

	public function logoutAction()
	{
		Zend_Auth::getInstance()->clearIdentity();
		$this->_helper->redirector('index'); // back to login page
	}
	
}

?>