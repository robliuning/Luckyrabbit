<?php
  //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011

class Worker_Models_WageMapper
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
            $this->setDbTable('Worker_Models_DbTable_Wage');
        }
        return $this->_dbTable;
    }
    
    public function save(Worker_Models_Wage $wage) 
    {
        $data = array(
            'wagId' => $wage->getWagId(),
            'amount' => $wage->getAmount(),
			'startDate' => $wage->getStartDate(),
			'endDate' =>$wage->getEndDate(),
			'workerId' =>$wage->getWorkerId(),
            'remark' => $wage->getRemark()
        );
        if (null === ($id = $wage->getWagId())) {
            unset($data['wagId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('wagId = ?' => $wage->getWagId()));
        }
    }
    
    public function find($wagId,Worker_Models_Wage $wage) 
    {

        $result = $this->getDbTable()->find($wagId);

        if (0 == count($result)) {
            return;
        }
        $row = $result->current();

        $wage  ->setAmount($row->amount)
               ->setStartDate($row->startDate)
               ->setEndDate($row->endDate)
               ->setWorkerId($row->workerId)
               ->setRemark($row->remark);
                  
		$workers = new Worker_Models_WorkerMapper();
		$workerName = $workers->findWorkerName($wage->getWorkerId());
		$wage->setWorkerName($workerName);	 
    }
     
    public function findArrayWage($id) 
    {
		$id = (int)$id;
		$entries = $this->getDbTable()->findArrayWage($id);
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
   			$entry = new Worker_Models_Wage();
   			$entry->setWagId($row->wagId)		
				->setAmount($row->amount)
				->setStartDate($row->startDate)
				->setEndDate($row->endDate)
				->setWorkerId($row->workerId);

			$workers = new Worker_Models_WorkerMapper();
		    $workerName = $workers->findWorkerName($entry->getWorkerId());
			$entry->setWorkerName($workerName);	 				
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    
	public function delete($wagId)
	{
		$this->getDbTable()->delete("wagId = ".(int)$wagId);
		}
}
?>