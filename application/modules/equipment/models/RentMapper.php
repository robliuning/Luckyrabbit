<?php
  
/*write by lxj
  2011-04-16 v0.2*/

class Equipment_Models_RentMapper
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
            $this->setDbTable('Equipment_Models_DbTable_Rent');
        }
        return $this->_dbTable;
    }
    
    public function save(Equipment_Models_Rent $rent) 
    {
        $data = array(
            'renId' => $rent->getRenId(),
            'projectId' => $rent->getProjectId(),
			'venId' => $rent->getVenId(),
            'renRes' => $rent->getRenRes(),
			'personId' => $rent->getPersonId(),
            'startDate' => $rent->getStartDate(),
			'endDate' => $rent->getEndDate(),
			'planType' => $rent->getPlanType()
			'approvId' => $rent->getApprovId(),
			'approvDate' => $rent->getApprovDate(),	
			'freight' => $rent->getFreight(),
			'invoice' => $rent->getInvoice(),
			'total' =>$rent->getTotal(),
            'remark' => $rent->getRemark()
        );
        if (null === ($id = $rent->getExpId())) {
            unset($data['renId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('renId = ?' => $rent->getRenId()));
        }
    }
     
    public function findArrayPlan($id) 
    {
		$id = (int)$id;
		$rent = $this->getDbTable()->fetchRow('renId = '.$id);
		$projectId = $rent->getProjectId();
		$venId = $rent->getVenId();
		$personId = $rent->getPersonId();
		$approvId = $rent->getApprovId();
		$entry = $rent->toArray();

		$projects = new Project_Models_ProjectMapper();
		$projectName = $projects->findProjectName($projectId);
        $entry[] = $projectName;

		$vendors = new General_Models_VendorMapper();
		$venName = $vendors->findVenName($venId);
	    $entry[] = $venName;

		$contacts = new Employee_Models_ContactMapper();
		$personName = $contacts->findContactName($personId);
		$approvName = $contacts->findContactName($approvId);
		$entry[] = $personName;
		$entry[] = $approvName;
		
		return $entry;
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
   			$entry = new Material_Models_Rent();
   			$entry->setRenId($row->renId)		
				->setProjectId($row->projectId)
				->setVenId($row->venId)
				->setRenRes($row->renRes)
                ->setPersonId($row->personId)
				->setStartDate($row->startDate)
				->setEndDate($row->applicDate)
				->setPlanType($row->planType)
				->setApprovId($row->approvId)
				->setApprovDate($row->approvDate)
				->setFreight($row->freight)
				->setInvoice($row->invoice)
				->setTotal($row->total)
   				->setRemark($row->remark)
				->setCTime($row->cTime);

			$projects = new Project_Models_ProjectMapper();
			$projectName = $projects->findProjectName($entry->getProjectId());
            $entry->setProjectName($projectName);

   			$vendors = new General_Models_VendorMapper();
			$venName = $vendors->findVemName($entry->getVenId());
			$entry->setVenName($venName);

			$contacts = new Employee_Models_ContactMapper();
		    $personName = $contacts->findContactName($entry->getPersonId());
			$entry->setPersonName($personName);
		    $approvName = $contacts->findContactName($entry->getApprovId());
			$entry->setApprovName($approvName);
   			 				
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    
	public function delete($renId)
	{
		$this->getDbTable()->delete("renId = ".(int)$renId);
		}
}
?>