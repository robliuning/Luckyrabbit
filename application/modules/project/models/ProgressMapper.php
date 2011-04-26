<?php
  //creation date 03-4-2011
  //creating by lincoy
  //completion date 04-04-2011

class Project_Models_ProgressMapper
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
            $this->setDbTable('Project_Models_DbTable_Progress');
        }
        return $this->_dbTable;
    }
    public function save(Project_Models_Progress $progress)
    {
    	$periodExp = $progress->getEndDateExp() - $progress->getStartDate() + 1; 
    	$periodAct = null;
    	if($progress->getEndDateAct() != null)
    	{
    		$periodAct = $progress->getEndDateAct() - $progress->getStartDate() + 1;
    		}
        $data = array(
			'projectId' => $progress->getProjectId(),
            'stage' => $progress->getStage() ,
			'task' => $progress->getTask(),
			'startDate' => $progress->getStartDate(),
			'endDateExp' => $progress->getEndDateExp(),
			'periodExp' => $periodExp,
			'endDateAct' => $progress->getEndDateAct(),
			'periodAct' => $periodAct,
			'quality' => $progress->getQuality(),
			'remark' => $progress->getRemark()
        );
        if (null === ($id = $progress->getProjectId())) {
            unset($data['progressId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('progressId = ?' => $progress->getProjectId()));
        }
    }

    public function find($projectId)
    {
		$progress = new Project_Models_Progress();
        $result = $this->getDbTable()->find($projectId);

        if (0 == count($result)) {

            return;
        }

        $row = $result->current();

        $progress  ->setProjectId($row->projectId)
                  ->setStage($row->stage)
			      ->setTask($row->task)
				  ->setStartDate($row->startDate)
			      ->setEndDateExp($row->endDateExp)
			      ->setPeriodExp($row->periodExp)
			      ->setEndDateAct($row->endDateAct)
			      ->setPeriodAct($row->PeriodAct)
                  ->setQuality($row->quality)
				  ->setRemark($row->remark)
				  ->setCTime($row->cTime);
		return $progress;
    }

	public function fetchInfo($projectId)  //获得progress 中的stage, task, endDateAct, quality
	{
		$select = $this->getDbTable()->select();
		$select->where('projectId = ?',$projectId);
		$resultSet = $this->getDbTable()->fetchAll($select);
		$entries = array();
		foreach($resultSet as $row){
			$entry = new Project_Models_Progress();
			$entry ->setStage($row->stage)
				   ->setTask($row->task)
				   ->setEndDateAct($row->endDateAct)
				   ->setQuality($row->quality);

			$entries[] = $entry;
		}
		return $entries;
	}
	
	public function getProgressInfo($progressId)
	{
		$select = $this->getDbTable()->select();
		$select->where('progressId = ?',$progressId);
		$resultSet = $this->getDbTable()->fetchAll($select);
		$entries = array();
		foreach($resultSet as $row){
			$entry = new Project_Models_Progress();
			$entry ->setStage($row->stage)
				   ->setTask($row->task)
				   ->setEndDateExp($row->endDateExp)   
				   ->setPeriodExp($row->periodExp)
				   ->setEndDateAct($row->endDateAct)
				   ->setPeriodAct($row->periodAct)
				   ->setQuality($row->quality)
				   ->setRemark($row->remark)
				   ->setCTime($row->cTime);

			$entries[] = $entry;
		}
		return $entries;
	}
	
	public function fetchAllStages($projectId) //check
	{
		$entries = $this->getDbTable()->fetchAllStages($projectId);
		return $entries;
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
   		
   		$progresses = array();
   		
   		foreach($resultSet as $row){
   			$progress = new Project_Models_Progress();
        	$progress ->setProgressId($row->progressId)
        				->setProjectId($row->projectId)
                   		->setStage($row->stage)
						->setStartDate($row->startDate)
				   		->setEndDateExp($row->endDateExp)
						->setEndDateAct($row->endDateAct)
						->setQuality($row->quality);
				
            $progresses[] = $progress;
   			}
    	return $progresses;
    	}
    
    public function populateProgressDd($form)
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