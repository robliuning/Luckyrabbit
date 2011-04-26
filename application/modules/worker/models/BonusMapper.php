<?php
  //creation date 22-04-2011
  //creating by lincoy
  //completion date 22-04-2011

class Worker_Models_BonusMapper
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
            $this->setDbTable('Worker_Models_DbTable_Bonus');
        }
        return $this->_dbTable;
    }

    public function save(Worker_Models_Bonus $bonus)
    {
        $data = array(
        	'bonId' => $bonus->getBonId(),
        	'projectId' => $bonus->getProjectId(),
        	'workerId' => $bonus->getWorkerId(),
			'bonDate' => $bonus->getBonDate(),
			'typeId' => $bonus->getTypeId(),
			'detail' => $bonus->getDetail(),
			'amount' => $bonus->getAmount(),
        	'remark' => $bonus->getRemark()
        );
        if (null === ($id = $bonus->getBonId())) {
            unset($data['bonId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('bonId = ?' => $bonus->getBonId()));
        }
    }

    public function findArrayBonus($id)
    {
		$id = (int)$id;
		$entries = $this->getDbTable()->fetchRow('bonId = '.$id);
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
	
	public function find($bonId,Worker_Models_Bonus $bonus) 
    {

        $result = $this->getDbTable()->find($bonId);

        if (0 == count($result)) {
            return;
        }
        $row = $result->current();

        $bonus  ->setProjectId($row->projectId)
        		->setWorkerId($row->workerId)
        		->setBonDate($row->bonDate)
        		->setTypeId($row->typeId)
        		->setDetail($row->detail)
                ->setAmount($row->amount)
                ->setRemark($row->remark)
                ->setCTime($row->cTime);
                
        $projects = new Project_Models_ProjectMapper();
		$projectName = $projects->findProjectName($bonus->getProjectId());
		$bonus->setProjectName($projectName);
                  
		$workers = new Worker_Models_WorkerMapper();
		$workerName = $workers->findWorkerName($bonus->getWorkerId());
		$bonus->setWorkerName($workerName);	 
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
   			$entry = new Worker_Models_Bonus();
   			$entry->setBonId($row->bonId)
				->setProjectId($row->projectId)
				->setWorkerId($row->workerId)
				->setBonDate($row->bonDate)
				->setTypeId($row->typeId)
				->setDetail($row->detail)
				->setAmount($row->amount)
   				->setRemark($row->remark)
				->setCTime($row->cTime);

		$projects = new Project_Models_ProjectMapper();
		$projectName = $projects->findProjectName($entry->getProjectId());
        $entry->setProjectName($projectName);
		$workers = new Worker_Models_WorkerMapper();
		$workerName = $workers->findWorkerName($entry->getWorkerId());
		$entry->setWorkerName($workerName);
		$bontypes = new General_Models_BontypeMapper();
		$bonName = $bontypes->findBontypeName($entry->getTypeId());
		$entry->setTypeName($bonName);

   		$entries[] = $entry;
   		}
    	return $entries;
    	}

	public function delete($bonId)
	{
		$this->getDbTable()->delete("bonId = ".(int)$bonId);
		}
		
	public function populateBonusDd($form)
	{
		$projects = new Project_Models_ProjectMapper();
		$arrayProjects = $projects->fetchAllNames(); 
		
		$bontypes = new General_Models_BontypeMapper();
		$arrayBontypes = $bontypes->fetchAllNames();
		
		foreach($arrayProjects as $project)
		{
			$form->getElement('projectId')->addMultiOption($project->getProjectId(),$project->getName());
			}
		foreach($arrayBontypes as $bontype)
		{
			$form->getElement('typeId')->addMultiOption($bontype->getTypeId(),$bontype->getName());
			}
		
		}
		
}
?>