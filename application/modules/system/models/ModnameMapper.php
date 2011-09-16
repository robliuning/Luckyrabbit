<?php
//Updated on 27th June by Rob

class System_Models_ModnameMapper
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
			$this->setDbTable('System_Models_DbTable_Modname');
		}
		return $this->_dbTable;
	}
	
	public function getModId($modname)
	{
		$row = $this->getDbtable()->getModId($modname);
		
		$modId = $row->modId;
		
		return $modId;
		}
		
	public function getModNameCh($modId)
	{
		$row = $this->getDbtable()->getModNameCh($modId);
		
		$modNameCh = $row->cName;
		
		return $modNameCh;
	}
	
	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$entries = array();
		foreach ($resultSet as $row) {
			$entry = new System_Models_Modname();
			$entry->setId($row->modId)
				->setName($row->cName);
		$entries[] = $entry;
		}
		return $entries;
	}
	
	public function findModNameChs()
	{
		$arrayModNameChs = $this->fetchAll();
		
		$entries = array();
		
		$i = 0;
		
		foreach($arrayModNameChs as $modNameCh)
		{
			$entries[$i]['id'] = $modNameCh->getId();
			$entries[$i]['name'] = $modNameCh->getName();
			$i++;
			}
		return $entries;
	}
}
?>