<?php
  //creation date 15-04-2011
  //creating by lincoy
  //completion date 15-04-2011

class Material_Models_PurchaseMapper
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
            $this->setDbTable('Material_Models_DbTable_Purchase');
        }
        return $this->_dbTable;
    }
    
    public function save(Material_Models_Purchase $purchase) 
    {
        $data = array(
            'purId' => $purchase->getPurId(),
			'projectId' => $purchase->getProjectId(),
			'venId' => $purchase->getVenId(),
			'buyerId' => $purchase->getBuyerId(),
			'purDate' => $purchase->getPurDate(),
			'planType' => $purchase->getPlanType(),
			'approvId' => $purchase->getApprovId(),
			'approvDate' => $purchase->getApprovDate(),
			'destId' => $purchase->getDestId(),
			'freight' => $purchase->getFreight(),
			'invoice' => $purchase->getInvoice(),
			'total' =>$purchase->getTotal(),
            'remark' => $purchase->getRemark()
        );
        if (null === ($id = $purchase->getPurId())) {
            unset($data['purId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('purId = ?' => $purchase->getPurId()));
        }
    }
     
    public function findArrayPurchase($id) 
    {
		$id = (int)$id;
		$purchase = $this->getDbTable()->fetchRow('purId = '.$id);
		$projectId = $purchase->getProjectId();
		$venId = $purchase->getVenId();
		$buyerId = $purchase->getBuyerId();
      	$approvId = $purchase->getApprovId();
		$destId = $purchase->getDestId();
		$entry = $plan->toArray();

		$projects = new Project_Models_ProjectMapper();
		$projectName = $projects->findProjectName($projectId);
		$entry[] = $projectName;

		$vendors = new General_Models_VendorMapper();
		$venName = $vendors->findVenName($venId);
		$entry[] = $venName;

		$contacts = new Employee_Models_ContactMapper();
		$buyerName = $contacts->findContactName($buyerId);
		$approvName = $contacts->findContactName($approvId);	
		$entry[] = $buyerName;
		$entry[] = $approName;

		$sites = new General_Models_siteMapper();
		$destName = $sites->findSiteName($destId);
		$entry[] = $destName;
		
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
   			$entry = new Material_Models_Purchase();
   			$entry->setPurId($row->purId)
				->setProjectId($row->projectId)
				->setVenId($row->venId)
				->setBuyerId($row->buyerId)
				->setPurDate($row->purDate)
				->setPlanType($row->planType)
				->setApprovId($row->approvId)
				->setApprovDate($row->approvDate)
				->setDestId($row->destId)
				->setFreight($row->freight)
				->setInvoice($row->invoice)
				->setTotal($row->total)
   				->setRemark($row->remark)
				->setCTime($row->cTime);

			$projects = new Project_Models_ProjectMapper();
			$projectName = $projects->findProjectName($entry->getProjectId());
            $entry->setProjectName($projectName);

			$vendors = new General_Models_VendorMapper();
		    $venName = $vendors->findVenName($entry->getVenId());
			$entry->setVenName($venName);
   				
			$contacts = new Employee_Models_ContactMapper();
		    $buyerName = $contacts->findContactName($entry->getBuyerId());
			$entry->setBuyerName($buyerName);
		    $approvName = $contacts->findContactName($entry->getApprovId());
			$entry->setApprovName($approvName);

			$sites = new General_Models_SiteMapper();
			$destName = $sites->findSiteName($entry->getDestId());
			$entry->setDestName($destName);
   			 				
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    
	public function delete($purId)
	{
		$this->getDbTable()->delete("purId = ".(int)$purId);
		}
}
?>