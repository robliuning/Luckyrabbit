<?php

class Contract_Models_ContrqualifMapper
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
            $this->setDbTable('Contract_Models_DbTable_Contrqualif');
        }
        return $this->_dbTable;
    }

    public function save(Contract_Models_Contrqualif $contrqualif) //check
    {
        $data = array(
            'cqId' => $contrqualif->getCqId(),
            'ContractorId' => $contrqualif->getContractorId(),
            'qualifSerie' => $contrqualif->getQualifSerie(),
            'qualifType' => $contrqualif->getQualifType(),
			'qualifGrade' => $contrqualif->getQualifGrade()
        );
        if (null === ($id = $contrqualif->getCqId())) {
            unset($data['cqId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('cqId = ?' => $cqId));
        }
    }

    public function find($cqId, Contract_Models_Contrqualif $contrqualif)
    {
        $result = $this->getDbTable()->find($cqId);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();

        $contrqualif->setCqId($row->cqId)
        		  ->setContractorId($row->ContractorId)
                  ->setQualifSerie($row->qualifSerie)
                  ->setQualifType($row->qualifType)
				  ->setQualifGrade($row->qualifGrade);
    }
 
    public function fetchAllQualifTypes($key)
    {
		$qualiftypes = new General_Models_QualifTypeMapper();

		$arrayQualifTypes = $qualiftypes->fetchAll($key);

		return $arrayQualifTypes;
    }
    
    public function findArrayEmployee($id) //check
    {
		$id = (int)$id;
		$entries = $this->getDbTable()->findArrayEmployee($id);
		$entry = $entries[0]->toArray();
		return $entry;
	}
    
    public function fetchAllJoin() //check
    {
   		$resultSet = $this->getDbTable()->fetchAllJoin();
   		
   		$entries = array();
   		
   		foreach($resultSet as $row){
   			$entry = new Employee_Models_Employee();
   			
   			$entry->setEmpId($row->empId)
   				->setEmpName($row->name)
   				->setDeptName($row->deptName)
   				->setDutyName($row->dutyName)
   				->setTitleName($row->titleName)
   				->setPhoneNo($row->phoneNo)
   				->setStatus($row->status);
   				
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    
    public function populateEmployeeDd($form) //check
  	{
  		$depts = new General_Models_DeptMapper();
		$arrayDepts = $depts->fetchAll(); 
		$duties = new General_Models_DutyMapper();
		$arrayDuties = $duties->fetchAll();

		foreach($arrayDepts as $dept)
		{
			$form->getElement('deptName')->addMultiOption($dept->getName(),$dept->getName());
			}
		foreach($arrayDuties as $duty)
		{
			$form->getElement('dutyName')->addMultiOption($duty->getName(),$duty->getName());
			}
  	}

}
?>
