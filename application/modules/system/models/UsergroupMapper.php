<?php
//Updated on 13th July by Rob

class System_Models_UsergroupMapper
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
			$this->setDbTable('System_Models_DbTable_Usergroup');
		}
		return $this->_dbTable;
	}
	
	public function getGroupName($groupId)
	{
		$row = $this->getDbtable()->fetchRow('groupId = '.$groupId);
		
		$groupName = $row->groupName;
		
		return $groupName;
		}
		
	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$entries = array();
		foreach ($resultSet as $row) {
			$entry = new System_Models_Usergroup();
			$entry->setId($row->groupId)
				->setName($row->groupName);
		$entries[] = $entry;
		}
		return $entries;
	}
	
	public function populateDd($form)
	{
		$arrayUsergroups = $this->fetchAll();
		foreach($arrayUsergroups as $usergroup)
		{
			$form->getElement('groupId')->addMultiOption($usergroup->getId(),$usergroup->getName());
			}
	}
}
?>