<?php
  //creation date 22-04-2011
  //creating by lincoy
  //completion date 22-04-2011

class Worker_Models_BonuseMapper
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
            $this->setDbTable('Worker_Models_DbTable_Bonuse');
        }
        return $this->_dbTable;
    }

    public function save(Worker_Models_Bonuse $bonuse)
    {
        $data = array(
        'bonId' => $bonuse->getBonId(),
        'projectId' => $bonuse->getProjectId(),
        'workerId' => $bonuse->getWorkerId(),
			  'bonDate' => $bonuse->BonDate(),
			  'typeId' => $bonuse->getTypeId(),
			  'detail' => $bonuse->getDetail(),
			  'amount' => $bonuse->getAmount(),
        'remark' => $bonuse->getRemark()
        );
        if (null === ($id = $bonuse->getBonId())) {
            unset($data['bonId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('bonId = ?' => $bonuse->getBonId()));
        }
    }

    public function findArrayBonuse($id)
    {
		$id = (int)$id;
		$entries = $this->getDbTable()->fetchRow('bonId = '.$id);
		$projectId = $entries->getProjectId();
		$workerId = $entries->getWorkerId();
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
   			$entry = new Worker_Models_Bonuse();
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
   			$entries[] = $entry;
   			}
    	return $entries;
    	}

	public function delete($bonId)
	{
		$this->getDbTable()->delete("bonId = ".(int)$bonId);
		}
}
?>