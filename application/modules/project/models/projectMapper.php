<?php
  //creation date 01-4-2011
  //creating by lincoy
  //completion date 03-04-2011

class Project_Models_ProjectMapper
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
            $this->setDbTable('Project_Models_DbTable_Project');
        }
        return $this->_dbTable;
    }
    public function save(Project_Models_Project $project) //check
    {
        $data = array(
			'projectId' => $project->getProjectId(),
            'name' => $project->getName() ,
			'address' => $project->getAddress(),
			'status' => $project->getStatus(),
			'structype' => $project->getStructype(),
			'level' => $project->getLevel(),
			'amount' => $project->getAmount(),
			'purpose' => $project->getPurpose(),
			'constrArea' => $project->getConstrArea(),
			'staffNo' => $project->getStaffNo(),
			'remark' => $project->getRemark()
        );
        if (null === ($id = $project->getProjectId())) {
            unset($data['projectId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('projectId = ?' => $project->getProjectId()));
        }
    }

    public function find($projectId,$project) //check
    {
        $resultSet = $this->getDbTable()->find($projectId);

        if (0 == count($resultSet)) {

            return;
        }

        $row = $resultSet->current();

        $project  ->setProjectId($row->projectId)
                  ->setName($row->name)
			      ->setAddress($row->address)
				  ->setStatus($row->status)
				  ->setStructype($row->structype)
				  ->setLevel($row->level)
				  ->setAmount($row->amount)
				  ->setPurpose($row->purpose)
				  ->setConstrArea($row->constrArea)
				  ->setStaffNo($row->staffNo)
				  ->setRemark($row->remark)
				  ->setCTime($row->cTime);
    }

	public function fetchAllNames() //check
	{
		$resultSet = $this->getDbTable()->fetchAllNames();
		$entries = array();
		foreach($resultSet as $row){
			$entry = new Project_Models_Project();
			$entry ->setProjectId($row->projectId)
				   ->setName($row->name);

			$entries[] = $entry;
		}
		return $entries; 
	}
	
	public function findProjectName($id) //check
	{
		$arrayNames = $this->getDbTable()->findProjectName($id);
		
		$name = $arrayNames[0]->name;
		
		return $name;
		}

    /*public function fetchAllJoin() //check
    {
    	//1.get particular project info from projects
    	$resultSet = $this->getDbTable()->fetchAll();	
        $projects   = array();
        
        foreach ($resultSet as $row) 
        {
			$project = new Project_Models_Project();
        	$project ->setProjectId($row->projectId)
                   ->setName($row->name)
			       //->setAddress($row->address)
				   ->setStatus($row->status)
				   ->setStructype($row->structype)
				   /*->setLevel($row->level)
				   ->setAmount($row->amount)
				   ->setPurpose($row->purpose)
				   ->setConstrArea($row->constrArea)*/
				   /*->setStaffNo($row->staffNo);
				   /*->setRemark($row->remark)
				   ->setCTime($row->cTime);*/
				   
			/*$projectId = $project->getProjectId();
			$postId = 000001;
			//2. find postId of Project Manager
			
			$cpps = new Employee_Models_CppMapper();
			$arrayContacts = $cpps->findContact($projectId,$postId);
			if(count($arrayContacts)>0)
			{
				$project->setCId($arrayContacts[0]->contactId);
				$project->setCName($arrayContacts[0]->name);
			}
			else
			{	
				$project->setCName("未指定");
				$project->setCId(0);
				}
			
			//3. find max stage number
			/*$progresses = new Project_Models_ProgressMapper();
			$arrayProgresses = $progresses->fetchAllStages($projectId);
			if(count($arrayProgresses)>0)
			{
				$project->setStage(count($arrayProgresses));
				}
				else
				{
					$project->setStage(0);
					}
			
            $projects[] = $project;
        }
        return $projects;
	}  */
	

	public function fetchAllJoin($key = null,$condition = null) //check
    {
    	if($condition == null)
    	{
    		$resultSet = $this->getDbTable()->fetchAll();
    		}
    		else
    		{
    			$resultSet = $this->getDbTable()->search($key,$condition);
    			}
   		
   		$projects = array();
   		
   		foreach($resultSet as $row){
   			$project = new Project_Models_Project();
        	$project ->setProjectId($row->projectId)
                   ->setName($row->name)
			       //->setAddress($row->address)
				   ->setStatus($row->status)
				   ->setStructype($row->structype)
				   /*->setLevel($row->level)
				   ->setAmount($row->amount)
				   ->setPurpose($row->purpose)
				   ->setConstrArea($row->constrArea)*/
				   ->setStaffNo($row->staffNo);
				   /*->setRemark($row->remark)
				   ->setCTime($row->cTime);*/
				   
			$projectId = $project->getProjectId();
			$postId = 000001;
			//2. find postId of Project Manager
			
			$cpps = new Employee_Models_CppMapper();
			$arrayContacts = $cpps->findContact($projectId,$postId);
			if(count($arrayContacts)>0)
			{
				$project->setCId($arrayContacts[0]->contactId);
				$project->setCName($arrayContacts[0]->name);
			}
			else
			{	
				$project->setCName("未指定");
				$project->setCId(0);
				}
			
			//3. find max stage number
			$progresses = new Project_Models_ProgressMapper();
			$arrayProgresses = $progresses->fetchAllStages($projectId);
			if(count($arrayProgresses)>0)
			{
				$project->setStage(count($arrayProgresses));
				}
				else
				{
					$project->setStage(0);
					}
			
            $projects[] = $project;
   			}
    	return $projects;
    	}
	public function findArrayProject($id) //check
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('projectId = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
		}
	public function delete($id)
	{
		$this->getDbTable()->delete('projectId = ' . (int)$id);
		}
	
	public function populateDd($form)         //check
	{
		$structypes = new General_Models_StructypeMapper();
		$arrayStructypes = $structypes->fetchAll();
		foreach($arrayStructypes as $structype)
		{
			$form->getElement('structype')->addMultiOption($structype->getName(),$structype->getName());
			}
	}  
}
?>