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
    
    public function find($id,Equipment_Models_Plan $plan)
    {
    	$result = $this->getDbTable()->find($id);

        if (0 == count($result)) {

            return;

        }

        $row = $result->current();

        $plan  ->setPlanId($row->planId)
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
		$projectName = $projects->findProjectName($plan->getProjectId());
        $plan->setProjectName($projectName);

		$contacts = new Employee_Models_ContactMapper();
		$applicName = $contacts->findContactName($plan->getApplicId());
		if($plan->getApprovId()!= null)
		{
			$approvName = $contacts->findContactName($plan->getApprovId());
			$plan->setApprovName($approvName);
			}
        $plan->setApplicName($applicName);
    }
     
    public function findArrayPlan($id) 
    {
		$id = (int)$id;
		$plan = $this->getDbTable()->fetchRow('planId = '.$id);
		$entry = $plan->toArray();
		$projectId = $entry['projectId'];
		$applicId = $entry['applicId'];
		$approvId = $entry['approvId'];

		$projects = new Project_Models_ProjectMapper();
		$projectName = $projects->findProjectName($projectId);
        $entry['projectName'] = $projectName;

		$contacts = new Employee_Models_ContactMapper();
		$applicName = $contacts->findContactName($applicId);
		if($approvId != null)
		{
			$approvName = $contacts->findContactName($approvId);
			$entry['approvName'] = $approvName;
		}
		$entry['applicName'] = $applicName;
		
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
   		$i = 341;
   		foreach($resultSet as $row){
   			$i = $i + 177;
   			$entry = new Equipment_Models_Plan();
   			$entry->setPlanId($row->planId)
				->setPlanType($row->planType)
				->setProjectId($row->projectId)
				->setDueDate($row->dueDate)
				->setApplicId($row->applicId)
				->setApplicDate($row->applicDate)
				->setTotal($i);//secret

			$projects = new Project_Models_ProjectMapper();
			$projectName = $projects->findProjectName($entry->getProjectId());
            $entry->setProjectName($projectName);
   				
			$contacts = new Employee_Models_ContactMapper();
		    $applicName = $contacts->findContactName($entry->getApplicId());
			$entry->setApplicName($applicName);
   			 				
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    
	public function delete($planId)
	{
		$this->getDbTable()->delete("planId = ".(int)$planId);
		}
	public function populatePlanDd($form)
	{
		$projects = new Project_Models_ProjectMapper();
		$arrayProjects = $projects->fetchAllNames();
		foreach($arrayProjects as $project)
		{
			$form->getElement('projectId')->addMultiOption($project->getProjectId(),$project->getName());
			}
	}

}
?>
