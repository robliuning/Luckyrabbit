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
	
	public function getUserId($name)
	{
		$resultSet = $this->getDbTable()->getUserId($name);
		
		$userId = $resultSet[0]->id;
		
		return $userId;
		}
}
?>