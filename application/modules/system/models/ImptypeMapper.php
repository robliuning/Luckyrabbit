<?php
//Updated on 134th July by Rob

class System_Models_ImptypeMapper
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
			$this->setDbTable('System_Models_DbTable_Imptype');
		}
		return $this->_dbTable;
	}

	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$entries = array();
		foreach ($resultSet as $row) {
			$entry = new System_Models_Imptype();
			$entry->setId($row->id)
				->setName($row->impName);
		$entries[] = $entry;
		}
		return $entries;
	}
	
	public function findImptypes()
	{
		$arrayImptypes = $this->fetchAll();
		
		$entries = array();
		
		$i = 0;
		
		foreach($arrayImptypes as $imptype)
		{
			$entries[$i]['id'] = $imptype->getId();
			$entries[$i]['name'] = $imptype->getName();
			$i++;
			}
		return $entries;
	}
	
	public function getTypeName($typeId)
	{
		$row = $this->getDbtable()->fetchRow('id = '.$typeId);
		
		$typeName = $row->impName;
		
		return $typeName;
		}
}
?>