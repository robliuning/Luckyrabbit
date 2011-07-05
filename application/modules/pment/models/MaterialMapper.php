<?php
//Updated in 5th July by rob

class Pment_Models_MaterialMapper
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
			$this->setDbTable('Pment_Models_DbTable_Material');
		}
		return $this->_dbTable;
	}

	public function save(Pment_Models_Material $material) 
	{
		$data = array(
			'planId' => $material->getPlanId(),
			'type' => $material->getType(),
			'mName' => $material->getMName(),
			'unit' => $material->getUnit(),
			'spec' => $material->getSpec(),
			'amount' => $material->getAmount(),
			'weight' => $material->getWeight(),
			'limitation' => $material->getLimitation(),
			'inDate' => $material->getInDate(),
			'remark' => $material->getRemark()
			);
		if (null === ($id = $material->getMtrId())) {
			unset($data['mtrId']);
			return $this->getDbTable()->insert($data);
		} else {
			return $this->getDbTable()->update($data, array('mtrId = ?' => $material->getMtrId()));
		}
	}

	public function fetchAllJoin($key = null,$condition = null) 
	{
		if($condition == null)
		{
			$resultSet = $this->getDbTable()->fetchAll();
			}
			else
			{
				$resultSet = $this->getDbTable()->search($key,$condition);
				}
		
		$entries = array();
		
		foreach($resultSet as $row){
			$entry = new Pment_Models_Material();
			$entry->setMtrId($row->mtrId)
				->setPlanId($row->planId)
				->setType($row->type)
				->setMName($row->mName)
				->setUnit($row->unit)
				->setSpec($row->spec)
				->setAmount($row->amount)
				->setWeight($row->weight)
				->setLimitation($row->limitation)
				->setInDate($row->inDate)
				->setRemark($row->remark);
			$entries[] = $entry;
			}
		return $entries;
		}
	
	public function delete($id)
	{
		$this->getDbTable()->delete("mtrId = ".(int)$id);
	}
}
?>
