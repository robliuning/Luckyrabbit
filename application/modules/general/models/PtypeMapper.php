<?php
//updated in 30th June by rob

class General_Models_PtypeMapper
{
	protected $_dbtable;
	
	public function setDbtable($dbtable)
	{
		if (is_string($dbtable)) {
			$dbtable = new $dbtable();
		}
		if (!$dbtable instanceof Zend_Db_table_Abstract) {
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_dbtable = $dbtable;
		return $this;
	}

	public function getDbtable()
	{
		if (null === $this->_dbtable) {
			$this->setDbtable('General_Models_DbTable_Ptype');
		}
		return $this->_dbtable;
	}

	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$entries = array();
		foreach ($resultSet as $row) {
			$entry = new General_Models_Ptype();
			$entry ->setId($row->typeId)
						->setName($row->typeName);
			$entries[] = $entry;
		}
		return $entries;
	}

	public function findPtypeName($id)
	{
		$row = $this->getDbTable()->fetchRow('typeId = '.$id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		$name = $row->typeName;
		return $name;
	}
}
?>
