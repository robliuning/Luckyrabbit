<?php
/*
	author lxj
  	date 2011.3.28
  	review rob
  	date 2011/4.7
*/
class Contract_Models_SubcontractMapper
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
            $this->setDbTable('Contract_Models_DbTable_Subcontract');
        }
        return $this->_dbTable;
    }
    
    public function save(Contract_Models_Subcontract $subcontract) //check
    {
        $data = array(
        	'scontrId' => $subcontract->getScontrId(),
            'projectId' => $subcontract->getProjectId(),
            'scontrType' => $subcontract->getScontrType(),
            'contractorId' => $subcontract->getContractorId(),
            'scontrDetail' => $subcontract->getScontrDetail(),
			'quality' => $subcontract->getQuality(),
			'startDateExp' => $subcontract->getStartDateExp(),

			'endDateExp' => $subcontract->getEndDateExp(),
            'startDateAct' => $subcontract->getStartDateAct(),
            'endDateAct' => $subcontract->getEndDateAct(),
			'brConContr' => $subcontract->getBrConContr(),
			'brResContr' => $subcontract->getBrResContr(),

			'brConSContr' => $subcontract->getBrConSContr(),
            'brResSContr' => $subcontract->getBrResSContr(),
            'warranty' => $subcontract->getWarranty(),
            'contrAmt' => $subcontract->getContrAmt(),
            'consMargin' => $subcontract->getConsMargin(),
			'prjMargin' => $subcontract->getPrjMargin(),
			'prjWarr' => $subcontract->getPrjWarr(),
			'remark' => $subcontract->getRemark()
        );
        
        if (null === ($id = $subcontract->getScontrId())) {
            unset($data['scontrId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('scontrId = ?' => $subcontract->getScontrId()));
        }
    }
    
    public function find($id,Contract_Models_Subcontract $subcontract)
    {
    	$resultSet = $this->getDbTable()->find($id);

        if (0 == count($resultSet)) {

            return;
        }

        $row = $resultSet->current();
        $subcontract->setScontrId($row->scontrId)
			      ->setProjectId($row->projectId)
			      ->setScontrType($row->scontrType)
			      ->setContractorId($row->contractorId)
			      ->setScontrDetail($row->scontrDetail)
			      ->setQuality($row->quality)
			      ->setStartDateExp($row->startDateExp)
			      ->setEndDateExp($row->endDateExp)
			      ->setPeriodExp($row->periodExp)
				  ->setStartDateAct($row->startDateAct)
			      ->setEndDateAct($row->endDateAct)
			      ->setPeriodAct($row->periodAct)
			      ->setBrConContr($row->brConContr)
			      ->setBrResContr($row->brResContr)
				  ->setBrConSContr($row->brConSContr)
			      ->setBrResSContr($row->brResSContr)
			      ->setWarranty($row->warranty)
			      ->setContrAmt($row->contrAmt)
			      ->setPrjMargin($row->prjMargin)
				  ->setPrjWarr($row->prjWarr)
			      ->setRemark($row->remark)			      			      				  
			      ->setCTime($row->cTime);
			      
		$contractors = new Contract_Models_ContractorMapper();
		$contractorName = $contractors->findContractorName($subcontract->getContractorId());
		$projects = new Project_Models_ProjectMapper();
		$projectName = $projects->findProjectName($subcontract->getProjectId());
            
		$subcontract->setContractorName($contractorName);
		$subcontract->setProjectName($projectName);
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
        foreach ($resultSet as $row) {
            $entry = new Contract_Models_Subcontract();

			 $entry ->setScontrId($row->scontrId)
        				 ->setProjectId($row->projectId)
						 ->setScontrType($row->scontrType)
						 ->setContractorId($row->contractorId)
				         ->setPeriodExp($row->periodExp)
						 ->setPeriodAct($row->periodAct)
						 ->setContrAmt($row->contrAmt);
            $contractors = new Contract_Models_ContractorMapper();
            $contractorName = $contractors->findContractorName($entry->getContractorId());
            $projects = new Project_Models_ProjectMapper();
            $projectName = $projects->findProjectName($entry->getProjectId());
            
            $entry->setContractorName($contractorName);
            $entry->setProjectName($projectName);
            
            $entries[] = $entry;
        }
        return $entries;
    }
	
	public function findArraySubcontract($scontrId)
	{
		$resultSet = $this->getDbtable()->findArraySubcontract($scontrId);
		return $resultSet;
	}
    
    public function delete($id) 
    {
    	$result = $this->getDbTable()->delete('scontrId = ' . (int)$id);
    	return $result;	
    	}
    
    public function populateSubcontractDd($form) //done
    {
  		$contractors = new Contract_Models_ContractorMapper();
		$arrayContractors = $contractors->fetchAllJoin();  //contractor name and id
			
		foreach($arrayContractors as $contr)
		{
			$form->getElement('contractorId')->addMultiOption($contr->getContractorId(),$contr->getName());
			}
		
		$projects = new Project_Models_ProjectMapper();
		$arrayProjects = $projects->fetchAllNames();

		foreach($arrayProjects as $project)
		{
			$form->getElement('projectId')->addMultiOption($project->getProjectId(),$project->getName());
			}
    }
}
?>
