<?php
  
 /*write by lxj
 2011-04-16   v0.2*/

class Equipment_Models_PlanMapper
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
            $this->setDbTable('Equipment_Models_DbTable_Plan');
        }
        return $this->_dbTable;
    }
   
    public function save(Equipment_Models_Plan $plan) 
    {
        $data = array(
            'planId' => $plan->getPlanId(),
            'planType' => $plan->getPlanType(),
            'projectId' => $plan->getProjectId(),
            'dueDate' => $plan->getDueDate(),
            'applicId' => $plan->getApplicId(),
			'applicDate' => $plan->getApplicDate(),
			'approvId' => $plan->getApprovId(),
			'approvDate' => $plan->getApprovDate(),	
			'total' =>$plan->getTotal(),
            'remark' => $plan->getRemark()
        );
        if (null === ($id = $plan->getPlanId())) {
            unset($data['planId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('planId = ?' => $plan->getPlanId()));
        }
    }
     
    public function findArrayPlan($id) 
    {
		$id = (int)$id;
		$plan = $this->getDbTable()->fetchRow('planId = '.$id);
		$projectId = $plan->getProjectId();
		$applicId = $plan->getApplicId();
		$approvId = $plan->getApprovId();
		$entry = $plan->toArray();

		$projects = new Project_Models_ProjectMapper();
		$projectName = $projects->findProjectName($projectId);
        $entry[] = $projectName;

		$contacts = new Employee_Models_ContactMapper();
		$applicName = $contacts->findContactName($applicId);
		$approvName = $contacts->findContactName($approvId);
		
		$entry[] = $applicName;
		$entry[] = $approName;
		
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
   			$entry = new Equipment_Models_Plan();
   			$entry->setPlanId($row->planId)
				->setPlanType($row->planType)
				->setProjectId($row->projectId)
				->setDueDate($row->dueDate)
				->setApplicId($row->applicId)
				->setApplicDate($row->applicDate)
				->setApprovId($row->approvId)
				->setApprovDate($row->approvDate)
				->setTotal($row->total)
   				->setRemark($row->remark)
				->setCTime($row->cTime);

			$projects = new Project_Models_ProjectMapper();
			$projectName = $projects->findProjectName($entry->getProjectId());
            $entry->setProjectName($projectName);
   				
			$contacts = new Employee_Models_ContactMapper();
		    $applicName = $contacts->findContactName($entry->getApplicId());
			$entry->setApplicName($applicName);
		    $approvName = $contacts->findContactName($entry->getApprovId());
			$entry->setApprovName($approvName);
   			 				
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    
	public function delete($planId)
	{
		$this->getDbTable()->delete("planId = ".(int)$planId);
		}
}
?>
