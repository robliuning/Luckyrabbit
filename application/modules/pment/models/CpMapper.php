<?php
//Updated in 14th June by Rob

class Pment_Models_CpMapper
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
			$this->setDbTable('Pment_Models_DbTable_Cp');
		}
		return $this->_dbTable;
	}

	public function save(Pment_Models_Cp $cp)
	{
		$data = array(
			'cpId' => $cp->getCpId(),
			'contractorId' => $cp->getContractorId(),
			'projectId' => $cp->getProjectId()
		);
		if (null === ($id = $cp->getCpId())) {
			unset($data['cpId']);
			return $this->getDbTable()->insert($data);
		} else {
			return $this->getDbTable()->update($data, array('cpId = ?' => $cp->getCpId()));
		}
	}

	public function delete($id)
	{
		$result = $this->getDbTable()->delete('cpId = ' . (int)$id);
		return $result;
		}

	public function fetchAllJoin($key = null,$condition = null)
	{
		
		$paginator = $this->getDbTable()->fetchAllJoin($key, $condition);
		return $paginator;
		/*if($condition == null)
		{
			$resultSet = $this->getDbTable()->fetchAll();
			}
			else
			{
				$resultSet = $this->getDbTable()->search($key,$condition);
				}
		
		$entries = array();
		$contractors = new Contract_Models_ContractorMapper();
		
		foreach ($resultSet as $row) 
		{
			$entry = new Contract_Models_Contractor();
			$contractorId = $row->contractorId;
			$entry = $contractors->findById($contractorId);
			$entry->setCpId($row->cpId);
			$entries[] = $entry;
			}
			return $entries;*/
	}

	public function dataValidator($formData,$projectId)
	{
		$errorMsg = null;
		$trigger = 0;
		$contractorId = $formData['contractorId'];
		$checkRe = $this->getDbtable()->checkRe($projectId,$contractorId);
		if($checkRe == true)
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_recordExists."<br/>".$errorMsg;
			}

		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
	}
	
	public function fetchAllContractorIds($projectId)
	{
		$resultSet = $this->getDbTable()->fetchAllContractorIds($projectId);
		$entries = array();
		foreach ($resultSet as $row) {
			$entry = new Pment_Models_Cp();

			 $entry ->setContractorId($row->contractorId)
					->setProjectId($row->projectId)
					->setContractorName($row->name);
					$entries[] = $entry;
		}
		return $entries;
		}
}
?>