<?php
//Updated on 13th July by Rob

class System_Models_AuthorityMapper
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
			$this->setDbTable('System_Models_DbTable_Authority');
		}
		return $this->_dbTable;
	}
	
	public function checkAuth($userId,$modName)
	{
		$users = new System_Models_UserMapper();
		$groupId = $users->getGroupId($userId);
		$mns = new System_Models_ModnameMapper();
		$modId = $mns->getModId($modName);
		
		$result = $this->getDbtable()->checkAuth($groupId,$modId);
		
		$auth = $result['modPriv'];
		return $auth;
	}
}
?>