<?php
  //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011

class Worker_Models_WorkerMapper
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
            $this->setDbTable('Worker_Models_DbTable_Worker');
        }
        return $this->_dbTable;
    }
    
    public function save(Worker_Models_Worker $worker) 
    {
        $data = array(
            'workerId' => $worker->getWorkerId(),
            'name' => $worker->getName(),
            'teamId' => $worker->getTeamId(),
			'phoneNo' => $worker->getPhoneNo(), 
			'address' => $worker->getAddress(), 
			'skill' => $worker->getSkill(), 
			'cert' => $worker->getCert(),
            'remark' => $worker->getRemark()
        );
        if (null === ($id = $worker->getWorkerId())) {
            unset($data['workerId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('workerId = ?' => $worker->getWorkerId()));
        }
    }
    
    public function find($workerId,Worker_Models_Worker $worker) //check
    {

        $result = $this->getDbTable()->find($workerId);

        if (0 == count($result)) {
            return;
        }
        $row = $result->current();

        $worker  ->setName($row->name)
                  ->setTeamId($row->teamId)
                  ->setPhoneNo($row->phoneNo)
                  ->setAddress($row->address)
                  ->setSkill($row->skill)
                  ->setCert($row->cert)
                  ->setRemark($row->remark)
                  ->setCTime($row->cTime);
                  
		$teams = new Worker_Models_TeamMapper();
		$teamName = $teams->findTeamName($worker->getTeamId());
		$worker->setTeamName($teamName);	 
    }
    
    public function findArrayWorker($id) 
    {
		$id = (int)$id;
		$entries = $this->getDbTable()->findArrayWorker($id);
		$entry = $entries[0]->toArray();
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
   			$entry = new Worker_Models_Worker();
   			$entry->setWorkerId($row->workerId)		
				->setName($row->name)
				->setTeamId($row->teamId)
				->setPhoneNo($row->phoneNo)
				->setAddress($row->address)
				->setSkill($row->skill)
				->setCert($row->cert)
   				->setRemark($row->remark)
				->setCTime($row->cTime);

			$teams = new Worker_Models_TeamMapper();
		    $teamName = $teams->findTeamName($entry->getTeamId());
			$entry->setTeamName($teamName);	 				
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    
	public function delete($workerId)
	{
		$this->getDbTable()->delete("workerId = ".(int)$workerId);
		}

	public function findWorkerName($id)
	{
		$arrayNames = $this->getDbTable()->findWorkerName($id);
		$name = $arrayNames[0]->name;

		return $name;
	}
	
	public function findWorkerNames($key)
	{
		$arrayNames = $this->getDbTable()->findWorkerNames($key);
		
		$entries = array();
		
		$i = 0;
		
		foreach($arrayNames as $name)
		{
			$entries[$i]['name'] = $name->name;

			$entries[$i]['workerId'] = $name->workerId;
			$entries[$i]['phoneNo'] = $name->phoneNo;
			$entries[$i]['cert'] = $name->cert;
			$i++;
			if($i == 12)
			{
				break;
				}
			}
		
		return $entries;
	}
	
	public function populateWorkerDd($form)
	{
		$teams = new Worker_Models_TeamMapper();
		$arrayTeams = $teams->fetchAllNames(); 

		foreach($arrayTeams as $team)
		{
			$form->getElement('teamId')->addMultiOption($team->getTeamId(),$team->getName());
			}
		}
}
?>