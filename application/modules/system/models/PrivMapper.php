<?php
//Updated on 27th June by Rob

class System_Models_PrivMapper
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
			$this->setDbTable('System_Models_DbTable_Priv');
		}
		return $this->_dbTable;
	}
	
	public function loadMenu($groupId)
	{
		$resultSet = $this->getDbTable()->loadMenu($groupId);
		$entries = array();
		foreach ($resultSet as $row) 
		{
			$entry = new System_Models_Priv();
			$entry->setModEName($row->modEName)
				->setModCName($row->modCName);
			$entries[] = $entry;
		}
		return $entries;
	}
	
	public function loadSidebar($groupId,$modEName)
	{
		$resultSet = $this->getDbTable()->loadSidebar($groupId,$modEName);
		
		$entries = array();
		foreach ($resultSet as $row) 
		{
			$entry = new System_Models_Priv();
			$entry->setSidName($row->sidName)
				->setModEName($modEName)
				->setConName($row->conName);
			$entries[] = $entry;
		}
		return $entries;
	}
	
	public function getModCName($modEName)
	{
		$resultSet = $this->getDbTable()->getModCName($modEName);
		return $resultSet[0]->modCName;
	}
	
	public function getSidName($modEName,$conName)
	{
		$resultSet = $this->getDbTable()->getSidName($modEName,$conName);
		return $resultSet[0]->sidName;
	}
	
	public function fetchArrayFuncs($groupId,$modEName,$conName)
	{
		$resultSet = $this->getDbTable()->fetchArrayFuncs($groupId,$modEName,$conName);
		$entries = array();
		foreach($resultSet as $row)
		{
			$entries[$row->actEName] = $row->priv;
		}
		return $entries;
	}
	
	public function getActCName($actEName)
	{
		$resultSet = $this->getDbTable()->getActCName($actEName);
		return $resultSet[0]->actCName;
		}
		
	public function getPriv($groupId,$modEName,$conName,$actEName)
	{
		$resultSet = $this->getDbTable()->getPriv($groupId,$modEName,$conName,$actEName);
		return $resultSet[0]->priv;
		}}
?>