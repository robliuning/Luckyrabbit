<?php
  //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011

class Worker_Models_ExtraMapper
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
            $this->setDbTable('Worker_Models_DbTable_Extra');
        }
        return $this->_dbTable;
    }

    public function save(Worker_Models_Extra $extra)
    {
        $data = array(
            'extId' => $extra->getExtId(),
            'projectId' => $extra->getProjectId(),
			'workerId' => $extra->getWorkerId(),
			'startDate' => $extra->getStartDate(),
			'endDate' => $extra->getEndDate(),
			'period' => $extra->getPeriod(),
			'cost' => $extra->getCost(),
            'remark' => $extra->getRemark()
        );
        if (null === ($id = $extra->getExtId())) {
            unset($data['extId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('extId = ?' => $extra->getExtId()));
        }
    }
    
    public function find($extId,Worker_Models_Extra $extra) 
    {

        $result = $this->getDbTable()->find($extId);

        if (0 == count($result)) {
            return;
        }
        $row = $result->current();

        $extra  ->setProjectId($row->projectId)
        		->setWorkerId($row->workerId)
        		->setStartDate($row->startDate)
        		->setEndDate($row->endDate)
        		->setPeriod($row->period)
        		->setCost($row->cost)
                ->setRemark($row->remark)
                ->setCTime($row->cTime);
                
        $projects = new Project_Models_ProjectMapper();
		$projectName = $projects->findProjectName($extra->getProjectId());
		$extra->setProjectName($projectName);
                  
		$workers = new Worker_Models_WorkerMapper();
		$workerName = $workers->findWorkerName($extra->getWorkerId());
		$extra->setWorkerName($workerName);	 
    }

    public function findArrayExtra($id)
    {
		$id = (int)$id;
		$entries = $this->getDbTable()->fetchRow('extId = '.$id);
		$projectId = $entries->projectId;
		$workerId = $entries->workerId;
		$entry = $entries->toArray();

		$projects = new Project_Models_ProjectMapper();
		$projectName = $projects->findProjectName($projectId);
        $entry[] = $projectName;

		$workers = new Worker_Models_WorkerMapper();
		$workerName = $workers->findWorkerName($workerId);
		$entry[] = $workerName;

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
   			$entry = new Worker_Models_Extra();
   			$entry->setExtId($row->extId)
				->setProjectId($row->projectId)
				->setWorkerId($row->workerId)
				->setStartDate($row->startDate)
				->setEndDate($row->endDate)
				->setPeriod($row->period)
				->setCost($row->cost)
   				->setRemark($row->remark)
				->setCTime($row->cTime);

			$projects = new Project_Models_ProjectMapper();
			$projectName = $projects->findProjectName($entry->getProjectId());
            $entry->setProjectName($projectName);

			$workers = new Worker_Models_WorkerMapper();
		    $workerName = $workers->findWorkerName($entry->getWorkerId());
			$entry->setWorkerName($workerName);
   			$entries[] = $entry;
   			}
    	return $entries;
    	}

	public function delete($extId)
	{
		$this->getDbTable()->delete("extId = ".(int)$extId);
		}
		
	public function populateExtraDd($form)
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