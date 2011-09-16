<?php
//updated in 18th July by luoxinji
//functions
//save(): 
//将timenow转换为unix time后存储
//check输入的userid是否存在,如是为update,不是为insert.
//delete($id)
//updateOnlineUser():
//提取所有数据,比对timer和当前时间,如超过30min,则删除该记录.
//fetchAll()

class System_Models_OnlineMapper
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
			$this->setDbTable('System_Models_DbTable_Online');
		}
		return $this->_dbTable;
	}

	public function save($userId)
	{
		//convert time
		//创建一个date now
		//convert date now to unix timestamp
		//check userId if it is exist
		//使用mapper里面的find 方法找数据
		$id = $this->checkExist($userId);
		$data = array(
			'id' => $id,
			'userId' => $userId,
			'timer' => time(),
			'loginTime' =>date('Y-m-d,H:i')
			);
		if (null === $id) {
			unset($data['id']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
	}
	
	public function checkExist($userId)
	{
		$id = null;
		$row = $this->getDbTable()->fetchRow('userId = '.$userId);
		if ($row) {
			$id = $row->id;
		}
		return $id;
	}
	
	public function find($id,System_Models_Online $online)
	{
		$resultSet = $this->getDbTable()->find($id);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$online->setId($row->id)
				->setUserId($row->userId)
				->setContactId($row->contactId)
				->setTimer($row->timer)
				->setLoginTime($row->loginTime);
		$online = new System_Models_OnlineMapper();
		$contactId = $online->getContactId($online->getContactId());
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($contactId);
		$online->setContactName($contactName);
	}
	
	public function deleteUser($userId)
	{
		$row = $this->getDbTable()->fetchRow('userId = '.$userId);
		$id = $row->id;
		$this->delete($id);
		}
	
	public function delete($id)
	{
		$this->getDbTable()->delete('id = ' . (int)$id);
	}
	
	public function updateOnlineUsers()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		if(0 == count($resultSet))
		{
			return;
		}
		
		foreach ($resultSet as $row)
		{
			$dis = time() - $row->timer;
			if($dis > 1800)
			{
				$userId = $row->userId;
				$ulogs = new System_Models_UlogMapper();
				$ulogs->save($userId,'登出');
				$this->delete($row->id);
				}
		}
	}
	
	public function fetchAllJoin($key = null,$condition = null)
	{
		$paginator = $this->getDbTable()->fetchAllJoin($key, $condition);
		return $paginator;
	}
}

?>