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
			'remark' => $progress->getRemark()
        );
        if (null === ($id = $log->getPLogId())) {
            unset($data['pLogId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('pLogId = ?' => $log->getPLogId()));
        }
    }

    public function find($pLogId)
    {
		$pLog = new Project_Models_Log();
        $result = $this->getDbTable()->find($pLogId);
        if (0 == count($result)) {

            return;
        }
        $row = $result->current();

        $pLog  ->setPLogId($row->pLogId)
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
			  ->setCTmie($row->cTime);
		
		return $pLog;
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

}
?>