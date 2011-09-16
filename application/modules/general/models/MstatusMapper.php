<?php
//updated in 3rd August 2011 by Rob


class General_Models_MstatusMapper
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
			$this->setDbTable('General_Models_DbTable_Mstatus');
		}
		return $this->_dbTable;
	}
	
	public function getStatusName($id) //check
	{
		$row = $this->getDbTable()->fetchRow('statusId = '.$id);
		
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		
		$name = $row->statusName;
		
		return $name;
		}
}
?>
