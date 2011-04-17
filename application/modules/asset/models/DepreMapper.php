<?php
  
 /*write by lxj
 2011-04-16   v0.2*/

class Asset_Models_DepreMapper
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
            $this->setDbTable('Asset_Models_DbTable_Depre');
        }
        return $this->_dbTable;
    }
   
    public function save(Asset_Models_Depre $depre) 
    {
        $data = array(
            'depId' => $depre->getDepId(),
            'purId' => $depre->getPurId(),
            'projectId' => $depre->getProjectId(),
            'quantity' => $depre->getQuantity(),
            'inDate' => $depre->getInDate(),
			'outDate' => $depre->getOutDate(),
			'depre' => $depre->getDepre(),
			'depreAmt' => $depre->getDepreAmt(),	
            'remark' => $depre->getRemark()
        );
        if (null === ($id = $depre->getPepId())) {
            unset($data['depreId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('depId = ?' => $depre->getDepId()));
        }
    }
     
    public function findArrayPlan($id) 
    {
		$id = (int)$id;
		$depre = $this->getDbTable()->fetchRow('depId = '.$id);
		$projectId = $depre->getProjectId();
		$purId = $depre->getPurId();
		$entry = $depre->toArray();

		$projects = new Project_Models_ProjectMapper();
		$projectName = $projects->findProjectName($projectId);
        $entry[] = $projectName;

		$purchases = new Asset_Models_PurchaseMapper();
		$purName = $contacts->findPurchaseName($purId);
		$entry[] = $purName;
		
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
   			$entry = new Asset_Models_Depre();
   			$entry->setDepId($row->depId)
				->setPurId($row->purId)
				->setProjectId($row->projectId)
				->setQuantity($row->quantity)
				->setInDate($row->inDate)
				->setOutDate($row->outDate)
				->setDepre($row->depre)
				->setDepreDate($row->depreDate)
   				->setRemark($row->remark)
				->setCTime($row->cTime);

			$projects = new Project_Models_ProjectMapper();
			$projectName = $projects->findProjectName($entry->getProjectId());
            $entry->setProjectName($projectName);
   				
			$purs = new Asset_Models_PurchaseMapper();
		    $purName = $purs->findContactName($entry->getApplicId());
			$entry->setPurName($purName);
   			 				
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    
	public function delete($depId)
	{
		$this->getDbTable()->delete("depId = ".(int)$depId);
		}
}
?>
