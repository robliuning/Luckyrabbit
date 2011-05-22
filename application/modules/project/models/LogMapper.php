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
        			'pLogId' => $log->getPLogId(),
					'projectId' => $log->getProjectId(),
					'logDate' => $log->getLogDate(),
					'weather' => $log->getWeather(),
					'tempHi' => $log->getTempLo(),
					'tempLo' => $log->getTempHi(),
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
					'remark' => $log->getRemark()
        );
        if (null === ($id = $log->getPLogId())) {
            unset($data['pLogId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('pLogId = ?' => $log->getPLogId()));
        }
    }
    
	public function find($id,Project_Models_Log $log)
    {
        $result = $this->getDbTable()->find($id);

        if (0 == count($result)) {

            return;
        }

        $row = $result->current();

        $log->setPLogId($row->pLogId)
			->setProjectId($row->projectId)
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
			->setCTime($row->cTime);
		    }
  
    public function findArrayLog($id)
    {
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('pLogId = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
    	}

	public function populateLogDd($form)         //填充projectId and projectName
	{
		$projects = new Project_Models_ProjectMapper();
		$arrayProjects = $projects->fetchAllNames();
		foreach($arrayProjects as $project)
		{
			$form->getElement('projectId')->addMultiOption($project->getProjectId(),$project->getName());
			}
	} 

	public function fetchAllDates($startDate,$endDate,$projectId)   //根据projectId, start date, end date获得 projectLogId  //and logDate
	{
		return $this->getDbTable()->fetchAllDates($startDate,$endDate,$projectId);
	}
	
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
   		
   		$logs = array();
   		
   		foreach($resultSet as $row){
   			$log = new Project_Models_Log();
        	$log ->setPLogId($row->pLogId)
                   ->setLogDate($row->logDate);
            $logs[] = $log;
				}
		return $logs;			
	}
}
?>