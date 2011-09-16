<?php
//updated in 11th July by Rob

class General_Models_QualifTypeMapper
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
			$this->setDbtable('General_Models_DbTable_QualifType');
		}
		return $this->_dbtable;
	}

	public function fetchAllBySerie($serie)
	{
		$resultSet  = $this->getDbtable()->fetchAllBySerie($serie);

		$entries   = array();
		
		foreach ($resultSet as $row) {
			$entry = new General_Models_QualifType();
			$entry->setTypeId($row->typeId);
			$entry->setName($row->name);
				
			$entries[] = $entry;
		}
		return $entries;
	}
	
	public function find($id,General_Models_QualifType $qualiftype)
	{
		$resultSet = $this->getDbTable()->find($id);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$qualiftype  ->setTypeId($row->typeId)
  				->setSerie($row->serie)
			  	->setName($row->name);	
	}
	
	public function findQualifSerie($id)
	{
		$row = $this->getDbTable()->fetchRow('typeId ='. $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		$row = $row->toArray();
		$serie = $row['serie'];
		return $serie;
	}
}
?>
