<?php
//Updated on 27th June by Rob

class System_Models_UserMapper
{
	protected $_dbTable;
	
	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}
	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->setDbTable('System_Models_DbTable_User');
		}
		return $this->_dbTable;
	}
	
	public function getContactId($id)
	{
		$resultSet = $this->getDbTable()->find($id);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$contactId = $row->contactId;
		
		return $contactId;
	}
	
	public function save(System_Models_User $user)
	{
		$data = array(
			'id' => $user->getId(),
			'username' => $user->getUserName() ,
			'password' => $user->getPassword(),
			'salt' => $user->getSalt(),
			'groupId' => $user->getGroupId(),
			'contactId' => $user->getContactId(),
			'creatorId' =>$user->getCreatorId(),
			'cTime' => $user->getCTime()
			);
		if (null === ($id = $user->getId())) {
			unset($data['id']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('id = ?' => $user->getId()));
		}
	}
	
	public function find($userId,System_Models_User $user)
	{
		$resultSet = $this->getDbTable()->find($userId);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$user->setId($row->id)
				->setUserName($row->username)
				->setGroupId($row->groupId)
				->setPassword($row->password)
				->setSalt($row->salt)
				->setContactId($row->contactId)
				->setCreatorId($row->creatorId);
		$creatorCid = $this->getContactId($user->getCreatorId());
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($user->getContactId());
		$creatorCname = $contacts->findContactName($creatorCid);
		$user->setContactName($contactName);
		$user->setCreatorCid($creatorCid);
		$user->setCreatorCname($creatorCname);
		$ugs = new System_Models_UsergroupMapper();
		$groupName = $ugs->getGroupName($user->getGroupId());
		$user->setGroupName($groupName);
	}
	
	public function getUserId($name)
	{
		$resultSet = $this->getDbTable()->getUserId($name);
		
		$userId = $resultSet[0]->id;
		
		return $userId;
		}
	
	public function getUserIdById($contactId)
	{
		$resultSet = $this->getDbTable()->getUserIdById($contactId);
		
		$userId = $resultSet[0]->id;
		
		return $userId;
		}
	
	public function getGroupId($userId)
	{
		$row = $this->getDbtable()->fetchRow('id = '.$userId);
		
		$groupId = $row->groupId;
		
		return $groupId;
		}
	
	public function fetchAllJoin($key = null,$condition = null)
	{
		$paginator = $this->getDbTable()->fetchAllJoin($key,$condition);
		return $paginator;
		/*if($condition == null)
		{
			$resultSet = $this->getDbTable()->fetchAll();
			}
			else
			{
				$resultSet = $this->getDbTable()->search($key,$condition);
				}
				
		$entries= array();
		foreach ($resultSet as $row) {
			$entry = new System_Models_User();
			$entry ->setId($row->id)
				->setUserName($row->username)
				->setGroupId($row->groupId)
				->setContactId($row->contactId)
				->setCTime($row->cTime)
				->setCreatorId($row->creatorId);
			$creatorCid = $this->getContactId($entry->getCreatorId());
			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findContactName($entry->getContactId());
			$creatorCname = $contacts->findContactName($creatorCid);
			$entry->setContactName($contactName);
			$entry->setCreatorCid($creatorCid);
			$entry->setCreatorCname($creatorCname);
			$ugs = new System_Models_UsergroupMapper();
			$groupName = $ugs->getGroupName($entry->getGroupId());
			$entry->setGroupName($groupName);
			
			$entries[] = $entry;
		}
		return $entries;*/
	}
	
	public function delete($id)
	{
		$this->getDbTable()->delete('id = ' . (int)$id);
	}
	
	public function formValidator($form,$formType)
	{
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('username')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('contactName')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('password')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('password_repeat')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		return $form;
	}
	
	public function fetchAllIds($groupId)
	{
		$resultSet = $this->getDbTable()->fetchAllIds($groupId);
		$arrayIds = array();
		foreach($resultSet as $id)
		{
			$arrayIds[] = $id->id;
			}
		return $arrayIds;
	}
	
	public function dataValidator($formData,$formType)
	{
		$errorMsg = null;
		$trigger = 0;
		//check length of password
		$length = strlen($formData['password']);
		if($length < 6 || $length > 12)
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_system_user_length."<br/>".$errorMsg;
		}
		//check password and password_repeat
		if($formData['password'] != $formData['password_repeat'])
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_system_user_password_differ."<br/>".$errorMsg;
			}
		//check if username has been taken
		$validator = new Zend_Validate_Db_NoRecordExists(
			array(
				'table' => 'sy_users',
				'field' => 'username'
			)
		);
		if (!$validator->isValid($formData['username']))
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_system_user_username_ocuppied."<br/>".$errorMsg;
		} 
		//check if contactId is occupied 
		$validator = new Zend_Validate_Db_NoRecordExists(
			array(
				'table' => 'sy_users',
				'field' => 'contactId'
			)
		);
		if (!$validator->isValid($formData['contactId']))
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_system_user_contactId_ocuppied."<br/>".$errorMsg;
		} 
		if($formData['contactId'] == null)
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_system_user_contact_notFound."<br/>".$errorMsg;
			}

		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
	}
	
	public function formValidatorEdit($form)
	{
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('password')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('password_old')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('password_repeat')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		return $form;
	}
	
	public function checkPassword($password,$userId)
	{
		$user = new System_Models_User();
		$this->find($userId,$user);
		$pd = $user->getPassword();
		$salt = $user->getSalt();
		$password = sha1($password.$salt);
		if($password == $pd)
		{
			return true;
			}
		return false;
	}
	
	public function dataValidatorEdit($formData,$userId)
	{
		$errorMsg = null;
		$trigger = 0;
		
		if(!$this->checkPassword($formData['password_old'],$userId))
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_system_user_password_old_wrong."<br/>".$errorMsg;
			}
			else
			{
				//check length of password
				$length = strlen($formData['password']);
				if($length < 6 || $length > 12)
				{
					$trigger = 1;
					$errorMsg = General_Models_Text::$text_system_user_length."<br/>".$errorMsg;
					}
				//check password and password_repeat
				if($formData['password'] != $formData['password_repeat'])
				{
					$trigger = 1;
					$errorMsg = General_Models_Text::$text_system_user_password_differ."<br/>".$errorMsg;
					}
				}
				
		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
	}
}
?>