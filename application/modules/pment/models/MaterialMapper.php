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
			'mtrId' => $material->getMtrId(),
			'planId' => $material->getPlanId(),
			'type' => $material->getType(),
			'mName' => $material->getMName(),
			'unit' => $material->getUnit(),
			'spec' => $material->getSpec(),
			'amount' => $material->getAmount(),
			'amountc' => $material->getAmountc(),
			'cost' => $material->getCost(),
			'costTotal' => $material->getCostTotal(),
			'budget' => $material->getBudget(),
			'budgetTotal' => $material->getBudgetTotal(),
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

	public function find($id,Pment_Models_Material $material)
	{
		$result = $this->getDbTable()->find($id);

		if (0 == count($result)) {
			return;
		}
		$row = $result->current();
		$material->setMtrId($row->mtrId)
				->setPlanId($row->planId)
				->setType($row->type)
				->setMName($row->mName)
				->setUnit($row->unit)
				->setSpec($row->spec)
				->setAmount($row->amount)
				->setAmountc($row->amountc)
				->setCost($row->cost)
				->setCostTotal($row->costTotal)
				->setBudget($row->budget)
				->setBudgetTotal($row->budgetTotal)
				->setWeight($row->weight)
				->setLimitation($row->limitation)
				->setInDate($row->inDate)
				->setRemark($row->remark);
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
				->setAmountc($row->amountc)
				->setCost($row->cost)
				->setCostTotal($row->costTotal)
				->setBudget($row->budget)
				->setBudgetTotal($row->budgetTotal)
				->setRemark($row->remark);
			$entries[] = $entry;
			}
		return $entries;
		}
	
	public function fetchAllOrganize($key,$condition)
	{
		$resultSets = $this->fetchAllJoin($key,$condition);
		
		$arrayMaterials = null;
		foreach($resultSets as $material)
		{
			$typeName = $material->getType();
			foreach($resultSets as $mtr)
			{
				if($typeName == $mtr->getType())
				{
					$tri = 0;
					if(!isset($arrayMaterials[$typeName]))
					{
						$arrayMaterials[$typeName] = array();
						}
						foreach($arrayMaterials[$typeName] as $m)
						{
							if($material->getMtrId() == $m->getMtrId())
							{
								$tri = 1;
								}
							}
							if($tri == 0)
							{
								$arrayMaterials[$typeName][] = $material;
								}
						}
					}
			}
		return $arrayMaterials;
	}
	
	public function fetchArryMtrIds($id)
	{
		$resultSet = $this->fetchAllJoin($id,'planId');
		
		$arrayMtrIds = array();
		
		foreach($resultSet as $row){
			$mtrId = $row->mtrId;
			$arrayMtrIds[] = $mtrId;
			}
		return $arrayMtrIds;
		}
	
	public function delete($id)
	{
		$this->getDbTable()->delete("mtrId = ".(int)$id);
	}
	
	public function dataValidator($data)
	{
		$errorMsg = null;
		$trigger = 0;
		//check empty
		$mName = $data['mName'];
		$unit = $data['unit'];
		$spec = $data['spec'];
		$amount = $data['amount'];
		$inDate = $data['inDate'];
		if($mName == null)
		{
			$trigger = 1;
			$errorMsg = "材料名字".General_Models_Text::$text_notEmpty_part.'<br>'.$errorMsg;
			}
		if($unit == null)
		{
			$trigger = 1;
			$errorMsg = "单位".General_Models_Text::$text_notEmpty_part.'<br>'.$errorMsg;
			}
		if($spec == null)
		{
			$trigger = 1;
			$errorMsg = "规格型号".General_Models_Text::$text_notEmpty_part.'<br>'.$errorMsg;
			}
		if($amount == null)
		{
			$trigger = 1;
			$errorMsg = "项目部核量".General_Models_Text::$text_notEmpty_part.'<br>'.$errorMsg;
			}
			else
			{
				if(!is_numeric($amount))
				{
					$trigger = 1;
					$errorMsg = "项目部核量".General_Models_Text::$text_numeric_part.'<br>'.$errorMsg;
					}
				}
		if($inDate == null)
		{
			$trigger = 1;
			$errorMsg = "需进场时间".General_Models_Text::$text_notEmpty_part.'<br>'.$errorMsg;
			}
		//check numeric
		$weight = $data['weight'];
		if($weight != null)
		{
			if(!is_numeric($weight))
			{
				$trigger = 1;
				$errorMsg = "重量".General_Models_Text::$text_numeric_part.'<br>'.$errorMsg;
				}
			}
		$limitation = $data['limitation'];
		if($limitation != null)
		{
			if(!is_numeric($limitation))
			{
				$trigger = 1;
				$errorMsg = "限额值".General_Models_Text::$text_numeric_part.'<br>'.$errorMsg;
				}
			}
		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
		}

	public function approvcValidator($data)
	{
		$errorMsg = null;
		$trigger = 0;
		
		foreach($data as $key => $value)
		{
			if($key != "approvcRemark")
			{
				if($value == "")
				{
					$trigger = 1;
					$errorMsg = General_Models_Text::$text_empty_all;
					}
				if(!is_numeric($value))
				{
					$trigger = 1;
					$errorMsg = General_Models_Text::$text_numeric_all;
					}
				}
		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
		}
}
?>
