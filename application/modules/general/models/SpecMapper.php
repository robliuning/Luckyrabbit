<?php
//updated on 24th May by Rob

class General_Models_SpecMapper
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
				$this->setDbTable('General_Models_DbTable_Spec');
		}
		return $this->_dbTable;
	}

	public function fetchAll() //check
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$entries	= array();
		foreach ($resultSet as $row) {
				$entry = new General_Models_Spec();
			$entry->setSpecId($row->specId)
				->setName($row->name);

		$entries[] = $entry;
		}
		return $entries;
	}
	
	public function findSpec($specId,General_Models_Spec $spec) 
	{
		$row = $this->getDbTable()->fetchRow('specId = '.$specId);

		if (0 == count($row)) {

			return;
		}
		$spec->setSpecId($row->specId)
				->setName($row->name);
	}
}
?>
