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
   			$log = new Project_Models_log();
        	$log ->setPLogId($row->pLogId)
                   ->setLogDate($row->logDate);
            $logs[] = $log;
				}
		return $logs;			
	}
}
?>