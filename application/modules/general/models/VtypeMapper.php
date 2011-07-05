<?php
//updated in 30th June by rob

class General_Models_VtypeMapper
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
			$this->setDbtable('General_Models_DbTable_Vtype');
		}
		return $this->_dbtable;
	}
	
	public function find($id,General_Models_Vtype $vtype)
	{
		$resultSet = $this->getDbTable()->find($id);
		if (0 == count($resultSet)) {
			return;
		}
		$row = $resultSet->current();
		$qualiftype ->setTypeId($row->typeId)
					->setName($row->name);	
	}
	
	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$entries = array();
		foreach ($resultSet as $row) {
			$entry = new General_Models_Vtype();
			$entry ->setTypeId($row->typeId)
						->setName($row->name);
			$entries[] = $entry;
		}
		return $entries;
	}

	public function findTypeName($id)
	{
		$row = $this->getDbTable()->fetchRow('typeId = '.$id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		$name = $row->name;
		return $name;
	}
	
	public function populateDd($form)
	{
		$arrayTypes = $this->fetchAll();
		foreach($arrayTypes as $type)
		{
			$form->getElement('typeId')->addMultiOption($type->getTypeId(),$type->getName());
		}
		
	}
}
?>
