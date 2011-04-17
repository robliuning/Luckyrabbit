<?php
  //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011

class Worker_Models_TeamMapper
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
            $this->setDbTable('Worker_Models_DbTable_Team');
        }
        return $this->_dbTable;
    }
    
    public function save(Worker_Models_Team $team) 
    {
        $data = array(
            'teamId' => $team->getTeamId(),
            'name' => $team->getName(),
			'contactId' => $team->getContactId(), 
            'remark' => $team->getRemark()
        );
        if (null === ($id = $team->getTeamId())) {
            unset($data['teamId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('teamId = ?' => $team->getTeamId()));
        }
    }
     
    public function findArrayTeam($id) 
    {
		$id = (int)$id;
		$entries = $this->getDbTable()->findArraymaterial($id);
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
   			$entry = new Worker_Models_Team();
   			$entry->setTeamId($row->teamId)		
				->setName($row->name)
				->setContactId($row->contactId)
   				->setRemark($row->remark)
				->setCTime($row->cTime);

			$contacts = new Employee_Models_ContactMapper();
		    $contactName = $contacts->findContactName($entry->getContactId());
			$entry->setContactName($contactName);	 				
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    
	public function delete($teamId)
	{
		$this->getDbTable()->delete("teamId = ".(int)$teamId);
		}
}
?>