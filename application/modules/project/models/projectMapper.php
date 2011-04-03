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
			'level' => $project->getLevel)(),
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

    public function getAllInfo()
    {
		//fetch all projects and contact id and name whos post id is 000001 in relevant project. also progress stage

		//1 fetch all project add in to project object

		$dbPro = new Project_Models_DbTable_Project();
        $select = $dbPro->select()
			->setIntegrityCheck(false)
			->from('pm_projects')
			->order('cTime DESC');
		$resultSet = $this->getDbTable()->fetchAll($select);

        $projects   = array();

        foreach ($resultSet as $row) {
		$project = new Project_Models_Project(); 
        $project ->setProjectId($row->projectId)
                   ->setEname($row->name)
			       //->setAddress($row->address)
				   ->setStatus($row->status)
				   ->setStructType($row->structType);
				   /*->setLevel($row->level)
				   ->setAmount($row->amount)
				   ->setPurpose($row->purpose)
				   ->setConstrArea($row->constrArea)
				   ->setStaffNo($row->staffNo)
				   ->setRemark($row->remark)
				   ->setCTime($row->cTime);*/

            $projects[] = $project;
        }
		//2 loop all project, search for contact id ,name and max number of stage
		foreach($projects as $pro)
		{
			$pid = $pro->getProjectId();

			//2.1 find postId of project manager
			$dbGer = new General_Models_DbTable_Posts();
			$postName =  "工程总负责人";
			$select = $dbGer->select()
				->setIntegrityCheck(false)
				->from('ge_posts',array('postId'))
				->where('name = ?',$postName);  
			$result = $dbGer->fetchAll($select);
			$postId = $result[0];

			//2.2 search for contact id and name 
			$dbCpp = new Employee_Models_DbTable_Contact();
			$select = $dbCpp->select()
				->setIntegrityCheck(false)
				->from(array('e'=>'em_cpp'),array('contactId'))
				->join(array('c'=>'em_contacts'),'e.contact = c.contactId')
				->where('e.projectId = ?',$pid)
				->where('e.postId = ?',$postId);
			$result = $dbCpp->fetchAll($select);
			$pro->setCId($result[0]->contactId);
			$pro->setCName($result[0]->Name);
		
			//2.3 search for max stage number
			$dbProgress = new Project_Models_Progress();
			$select = $dbCpp->select()
				->setIntegrityCheck(false)
				->from('pm_progress',MAX('stage'))
				->where('projectId = ?',$pid);
			$result = $dbProgress->fetchAll($select);
			$pro->setStage($result[0]->stage);
			}
		//3 return object
       
        return $projects;
    }  */
}
?>