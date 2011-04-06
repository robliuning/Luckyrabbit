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
    public function save(Project_Models_Project $project)
    {
        $data = array(
			'projectId' => $project->getProjectId(),
            'name' => $project->getName() ,
			'address' => $project->getAddress(),
			'status' => $project->getStatus(),
			'structType' => $project->getStructType(),
			'level' => $project->getLevel(),
			'amount' => $project->getAmount(),
			'purpose' => $project->getPurpose(),
			'constrArea' => $project->getConstrArea(),
			'staffNo' => $project->getStaffNo(),
			'remark' => $project->getRemark(),
			'cTime' => $project->getCTime()
        );
        if (null === ($id = $project->getProjectId())) {
            unset($data['projectId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('projectId = ?' => $projectId));
        }
    }

    public function find($projectId)
    {
		$project = new Project_Models_Project();
        $result = $this->getDbTable()->find($projectId);

        if (0 == count($result)) {

            return;
        }

        $row = $result->current();

        $project  ->setProjectId($row->projectId)
                  ->setName($row->name)
			      ->setAddress($row->address)
				  ->setStatus($row->status)
				  ->setStructType($row->structType)
				  ->setLevel($row->level)
				  ->setAmount($row->amount)
				  ->setPurpose($row->purpose)
				  ->setConstrArea($row->constrArea)
				  ->setStaffNo($row->staffNo)
				  ->setRemark($row->remark)
				  ->setCTime($row->cTime);
		return $project;
    }

	/*public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$entries = array();
		foreach($resultSet as $row){
			$entry = new Project_Models_Project();
			$entry ->setProjectId($row->projectId)
				   ->setName($row->name);

			$entries[] = $entry;
		} 
	}*/

    public function fetchAllJoin()
    {
    	//1.get particular project info from projects
    	$resultSet = $this->getDbTable()->fetchAllJoin();	
        $projects   = array();
        
        foreach ($resultSet as $row) 
        {
			$project = new Project_Models_Project(); 
        	$project ->setProjectId($row->projectId)
                   ->setName($row->name)
			       //->setAddress($row->address)
				   ->setStatus($row->status)
				   ->setStructType($row->structType)
				   /*->setLevel($row->level)
				   ->setAmount($row->amount)
				   ->setPurpose($row->purpose)
				   ->setConstrArea($row->constrArea)*/
				   ->setStaffNo($row->staffNo);
				   /*->setRemark($row->remark)
				   ->setCTime($row->cTime);*/
				   
			$projectId = $project->getProjectId();
			
			//2. find postId of Project Manager
			$posts = new General_Models_PostMapper();
			$postName = "工程总负责人";
			$arrayPost = $posts->findPostByName($postName);
			$postId = $arrayPost->postId;
			
			$cpps = new Employee_Models_CppMapper();
			$arrayContacts = $cpps->findContact($projectId,$postId);
			$project->setCId($arrayContacts[0]->contactId);
			$project->setCName($arrayContacts[0]->name);
			
			//3. find max stage number
			$progresses = new Project_Models_ProgressMapper();
			$arrayProgresses = $progresses->fetchAllStages($projectId);
			$project->setStage(count($arrayProgresses));
			
			/*$dbProgress = new Project_Models_DbTable_Progress();
			$select = $dbProgress->select()
				->setIntegrityCheck(false)
				->from('pm_progresses','stage')
				->where('projectId = ?',$pid);
			$rows = $dbProgress->fetchAll($select);
			$pro->setStage(count($rows));*/	
            $projects[] = $project;
        }
        
        return $projects;
	}  
		//2 loop all project, search for contact id ,name and max number of stage
	/*	foreach($projects as $project)
		{

			//2.1 find postId of project manager
			$posts = new General_Models_PostMapper();
			$postName =  "工程总负责人";
			$arrayPost = $posts->findPostByName($postName);
			$select = $dbGer->select()
				->setIntegrityCheck(false)
				->from('ge_posts',array('postId'))
				->where('name = ?',$postName);  
			$result = $dbGer->fetchAll($select);
			$postId = $result[0]->postId;

			//2.2 search for contact id and name 
			$dbCpp = new Employee_Models_DbTable_Cpp();
			$select = $dbCpp->select()
				->setIntegrityCheck(false)
				->from(array('e'=>'em_cpp'),array('contactId'))
				->join(array('c'=>'em_contacts'),'e.contactId = c.contactId')
				->where('e.projectId = ?',$pid)
				->where('e.postId = ?',$postId);
			$result = $dbCpp->fetchAll($select);
			$pro->setCId($result[0]->contactId);
			$pro->setCName($result[0]->name);
		
			//2.3 search for max stage number
						
			}*/
		//3 return object
       

}
?>