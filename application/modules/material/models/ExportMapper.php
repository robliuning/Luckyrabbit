<?php
  //creation date 15-04-2011
  //creating by lincoy
  //completion date 15-04-2011

class Material_Models_ExportMapper
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
            $this->setDbTable('Material_Models_DbTable_Export');
        }
        return $this->_dbTable;
    }
    
    public function save(Material_Models_Export $export) 
    {
        $data = array(

            'expId' => $export->getExpId(),
            'projectId' => $export->getProjectId(),
			'expDate' => $export->getExpDate(),
            'expType' => $export->getExpType(),
			'destId' => $export->getDestId(),
            'applicId' => $export->getApplicId(),
			'applicDate' => $export->getApplicDate(),
			'planType' => $export->getPlanType(),
			'approvId' => $export->getApprovId(),
			'approvDate' => $export->getApprovDate(),	
			'total' =>$export->getTotal(),
            'remark' => $export->getRemark()
        );
        if (null === ($id = $export->getExpId())) {
            unset($data['expId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('expId = ?' => $export->getExpId()));
        }
    }
     
    public function findArrayExport($id) //test
    {
		$id = (int)$id;
		$export = $this->getDbTable()->fetchRow('expId = '.$id);
		$projectId = $export->getProjectId();
		$destId = $export->getDestId();
		$applicId = $export->getApplicId();
		$approvId = $export->getApprovId();
		$entry = $export->toArray();

		$projects = new Project_Models_ProjectMapper();
		$projectName = $projects->findProjectName($projectId);
    $entry[] = $projectName;

		$sites = new General_Models_SiteMapper();
		$destName = $vendors->findSiteName($destId);
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
   			$entry = new Material_Models_Export();
   			$entry->setExpId($row->expId)		
				->setProjectId($row->projectId)
				->setExpDate($row->expDate)
				->setExpType($row->expType)
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
    
	public function delete($expId)
	{
		$this->getDbTable()->delete("expId = ".(int)$expId);
		}
}
?>