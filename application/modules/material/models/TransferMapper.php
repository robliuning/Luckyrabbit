<?php
  //creation date 16-04-2011
  //creating by lincoy
  //completion date 16-04-2011

class Material_Models_TransferMapper
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
            $this->setDbTable('Material_Models_DbTable_Transfer');
        }
        return $this->_dbTable;
    }
    
    public function save(Material_Models_Transfer $transfer) 
    {
        $data = array(
            'trsId' => $transfer->getTrsId(),
            'projectId' => $transfer->getProjectId(),
			'trsDate' => $transfer->getTrsDate(),
            'origId' => $transfer->getOrigId(),
			'destId' => $transfer->getDestId(),
            'applicId' => $transfer->getApplicId(),
			'applicDate' => $transfer->getApplicDate(),
			'planType' => $transfer->getPlanType(),
			'approvId' => $transfer->getApprovId(),
			'approvDate' => $transfer->getApprovDate(),
			'total' => $transfer->getTotal(),
            'remark' => $transfer->getRemark()
        );
        if (null === ($id = $transfer->getTrsId())) {
            unset($data['trsId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('trsId = ?' => $transfer->getTrsId()));
        }
    }
     
    public function findArrayTransfer($id) 
    {
		$id = (int)$id;
		$transfer = $this->getDbTable()->fetchRow('trsId = '.$id);
		$projectId = $transfer->getProjectId();
		$origId = $transfer->getOrigId();
		$destId = $transfer->getDestId();
		$applicId = $transfer->getApplicId();
		$approvId = $transfer->getApprovId();
		$entry = $transfer->toArray();

		$projects = new Project_Models_ProjectMapper();
		$projectName = $projects->findProjectName($projectId);
        $entry[] = $projectName;

		$sites = new General_Models_SiteMapper();
		$origName = $sites->findSiteName($origId);
		$destName = $sites->findSiteName($destId);
	    $entry[] = $origName;
	    $entry[] = $destName;

		$contacts = new Employee_Models_ContactMapper();
		$applicName = $contacts->findContactName($applicId);
		$approvName = $contacts->findContactName($approvId);	
		$entry[] = $applicName;
		$entry[] = $approName;
		
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
   			$entry = new Material_Models_Transfer();
   			$entry->setTrsId($row->trsId)		
				->setProjectId($row->projectId)
				->setTrsDate($row->trsDate)
				->setOrigId($row->origId)
                ->setDestId($row->destId)
				->setApplicId($row->applicId)
				->setApplicDate($row->applicDate)
				->setPlanType($row->planType)
				->setApprovId($row->approvId)
				->setApprovDate($row->approvDate)
				->setTotal($row->total)
   				->setRemark($row->remark)
				->setCTime($row->cTime);

			$projects = new Project_Models_ProjectMapper();
			$projectName = $projects->findProjectName($entry->getProjectId());
            $entry->setProjectName($projectName);

   			$sites = new General_Models_SiteMapper();
			$origName = $sites->findSiteName($entry->getOrigId());
			$entry->setOrigName($origName);
			$destName = $sites->findSiteName($entry->getDestId());
			$entry->setDestName($destName);

			$contacts = new Employee_Models_ContactMapper();
		    $applicName = $contacts->findContactName($entry->getApplicId());
			$entry->setApplicName($applicName);
		    $approvName = $contacts->findContactName($entry->getApprovId());
			$entry->setApprovName($approvName);
   			 				
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    
	public function delete($trsId)
	{
		$this->getDbTable()->delete("trsId = ".(int)$trsId);
		}
}
?>