<?php
//Updated in 13th June by Rob

class Admin_Models_MessageMapper
{
	protected $_dbTable;
	
	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract){
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}

	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->setDbTable('Admin_Models_DbTable_Message');
		}
		return $this->_dbTable;
	}

	public function sendByGroup($groupId,Admin_Models_Message $message)
	{
		$users = new System_Models_UserMapper();
		$arrayUserIds = $users->fetchAllIds($groupId);
		foreach($arrayUserIds as $id)
		{
			$message->setToId($id);
			$this->save($message);
		}
	}
	
	public function sendByUserId(Admin_Models_Message $message)
	{
		$this->save($message);
	}

	public function save(Admin_Models_Message $message)
	{
		$data = array(
			'msgId' => $message->getMsgId(),
			'fromId' => $message->getFromId(),
			'toId' => $message->getToId(),
			'title' => $message->getTitle(),
			'content' => $message->getContent(),
			'sendTime' => $message->getSendTime(),
			'status' => $message->getStatus()
		);
		if (null === ($id = $message->getMsgId())){
			unset($data['msgId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('msgId = ?' => $message->getMsgId()));
		}
	}

	public function find($id,Admin_Models_Message $message) 
	{
		$resultSet = $this->getDbTable()->find($id);

		if (0 == count($resultSet)) {

			return;
		}
		$row = $resultSet->current();
		$message->setMsgId($row->msgId)
				->setFromId($row->fromId)
				->setToId($row->toId)
				->setTitle($row->title)
				->setContent($row->content)
				->setSendTime($row->sendTime)
				->setStatus($row->status);
		$users = new System_Models_UserMapper();
		$contactId = $users->getContactId($message->getFromId());
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($contactId);
		$message->setFromCname($contactName);
		$message->setFromCid($contactId);
	}
	
	public function delete($id)
	{
		$result = $this->getDbTable()->delete('msgId = ' . (int)$id);
		return $result;	
		}

	public function fetchAllJoin($key=null,$condition=null)
	{
		$paginator = $this->getDbTable()->fetchAllJoin($key,$condition);
		return $paginator;
	}
	
	public function fetchAllNews($toId)
	{
		$resultSet = $this->getDbTable()->fetchAllNews($toId);
		
		$arrayMessages = null;
		foreach($resultSet as $row)
		{
			$message = new Admin_Models_Message();
			$message->setMsgId($row->msgId)
				->setFromId($row->fromId)
				->setTitle($row->title)
				->setSendTime($row->sendTime);
			$users = new System_Models_UserMapper();
			$contactId = $users->getContactId($message->getFromId());
			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findContactName($contactId);
			$message->setFromCname($contactName);
			$message->setFromCid($contactId);
			$arrayMessages[] = $message;
			}
		return $arrayMessages;
	}
	
	public function formValidator($form)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('groupId')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('title')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('content')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		
		return $form;
	}
	
	public function dataValidator($formData)
	{
		$errorMsg = null;
		$trigger = 0;

		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
	}
}
?>
