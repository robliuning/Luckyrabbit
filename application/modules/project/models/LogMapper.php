<?php
  //creation date 04-04-2011
  //creating by lincoy
  //completion date 

class Project_Models_LogMapper
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
            $this->setDbTable('Project_Models_DbTable_Log');
        }
        return $this->_dbTable;
    }
    public function save(Project_Models_Log $log)
    {
        $data = array(
			'projectId' => $log->getProjectId(),
			'logDate' => $log->getLogDate(),
			'weather' => $log->getWeather(),
			'tempHi' => $log->getTempHi(),
			'tempLo' => $log->getTempLo(),
			'progress' => $log->getProgress(),
			'qualityPbl' => $log->getQualityPbl(),
			'safetyPbl' => $log->getSafetyPbl(),
			'otherPbl' => $log->getOtherPbl(),
			'relatedFile' => $log->getRelatedFile(),
			'mMinutes' => $log->getMMinutes(),
			'changeSig' => $log->getChangeSig(),
			'material' => $log->getMaterial(),
			'machine' => $log->getMachine(),
			'utility' => $log->getUtility(),
			'remark' => $progress->getRemark(),
			'cTime' => $progress->getCTime()
        );
        if (null === ($id = $log->getProjectId())) {
            unset($data['projectId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('projectId = ?' => $projectId));
        }
    }

    public function find($projectId)
    {
		$log = new Project_Models_Progress();
        $result = $this->getDbTable()->find($projectId);

        if (0 == count($result)) {

            return;
        }

        $row = $result->current();

        $log  ->setProjectId($row->projectId)
              ->setLogDate($row->logDate)
			  ->setWeather($row->weather)
			  ->setTempHi($row->tempHi)
			  ->setTempLo($row->tempLo)
			  ->setProgress($row->progress)
			  ->setQualityPbl($row->qualityPbl)
			  ->setSafetyPbl($row->safetyPbl)
			  ->setOtherPbl($row->otherPbl)
			  ->setRelatedFile($row->relatedFile)
			  ->setMMinutes($row->mMinutes)
			  ->setChangeSig($row->changeSig)
			  ->setMaterial($row->material)
			  ->setMachine($row->machine)
			  ->setUtility($row->utility)
			  ->setRemark($row->remark)
			  ->setCTmie($row->cTime);
		
		return $log;
    }
///// 以下内容需要根据controller 来改动
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

            $projects[] = $project;
        }
		//2 loop all project, search for contact id ,name and max number of stage
		foreach($projects as $pro)
		{
			$pid = $pro->getProjectId();

			//2.1 find postId of project manager
			$dbGer = new General_Models_DbTable_Post();
			$postName =  "工程总负责人";
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
			$dbProgress = new Project_Models_DbTable_Progress();
			$select = $dbProgress->select()
				->setIntegrityCheck(false)
				->from('pm_progresses','stage')
				->where('projectId = ?',$pid);
			$rows = $dbProgress->fetchAll($select);
			$pro->setStage(count($rows));
			
			}
		//3 return object
       
        return $projects;
    }  
}
?>