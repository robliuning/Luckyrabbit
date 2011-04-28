<?php
  //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011

class Worker_Models_RegularMapper
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
            $this->setDbTable('Worker_Models_DbTable_Regular');
        }
        return $this->_dbTable;
    }
    
    public function save(Worker_Models_Regular $regular) 
    {
    	$profit = null;
    	if($regular->getBudget()!=null && $regular->getCost()!=null)
    	{
    		$profit = $regular->getCost() - $regular->getBudget();
    		}
    		else
    		{
    			$profit = 0;
    			}
        $data = array(
            'regId' => $regular->getRegId(),
            'projectId' => $regular->getProjectId(),
			'item' => $regular->getItem(),
			'number' => $regular->getNumber(), 
			'startDate' => $regular->getStartDate(), 
			'endDate' => $regular->getEndDate(), 
			'budget' => $regular->getBudget(), 
			'cost' => $regular->getCost(), 
			'profit' => $profit, 
            'remark' => $regular->getRemark()
        );
        if (null === ($id = $regular->getRegId())) {
            unset($data['regId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('regId = ?' => $regular->getRegId()));
        }
    }
    
    public function find($regId,Worker_Models_Regular $regular) 
    {

        $result = $this->getDbTable()->find($regId);

        if (0 == count($result)) {
            return;
        }
        $row = $result->current();

        $regular  ->setProjectId($row->projectId)
        		  ->setItem($row->item)
        		  ->setNumber($row->number)
                  ->setStartDate($row->startDate)
                  ->setEndDate($row->endDate)
				  ->setBudget($row->budget)
				  ->setCost($row->cost)
				  ->setPeriod($row->period)
				  ->setProfit($row->profit)
                  ->setRemark($row->remark)
                  ->setCTime($row->cTime);
                  
		$projects = new Project_Models_ProjectMapper();
		$projectName = $projects->findProjectName($regular->getProjectId());
		$regular->setProjectName($projectName);	 
    }
     
    public function findArrayRegular($id) 
    {
		$id = (int)$id;
		$entries = $this->getDbTable()->findArrayRegular($id);
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
   			$entry = new Worker_Models_Regular();
   			$entry->setRegId($row->regId)	
				->setProjectId($row->projectId)
				->setItem($row->item)
				->setNumber($row->number)
				->setStartDate($row->startDate)
				->setEndDate($row->endDate)
				->setPeriod($row->period)
				->setBudget($row->budget)
				->setCost($row->cost)
				->setProfit($row->profit)
   				->setRemark($row->remark)
				->setCTime($row->cTime);

			$projects = new Project_Models_ProjectMapper();
			$projectName = $projects->findProjectName($entry->getProjectId());
            $entry->setProjectName($projectName);	 				
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    
	public function delete($regId)
	{
		$this->getDbTable()->delete("regId = ".(int)$regId);
		}
		
	public function populateRegularDd($form)
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