<?php
  
 /*write by lxj
 2011-04-16   v0.2*/

class Asset_Models_PurchaseMapper
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
            $this->setDbTable('Asset_Models_DbTable_Purchase');
        }
        return $this->_dbTable;
    }
   
    public function save(Asset_Models_Purchase $purchase) 
    {
        $data = array(
            'purId' => $purchase->getPurId(),
            'name' => $purchase->getName(),
            'venId' => $purchase->getVenId(),
            'type' => $purchase->getType(),
            'spec' => $purchase->getSpec(),
			'invoice' => $purchase->getInvoice(),
			'unit' => $purchase->getUnit(),
			'price' => $purchase->getPrice(),
			'quantity' => $purchase->getQuantity(),	
			'amount' =>$purchase->getAmount(),
            'contactId' => $purchase->getContactId(),
			'purDate' => $purchase->getPurDate(),
			'approvId' => $purchase->getApprovId(),
			'approvDate' => $purchase->getApprovDate(),
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
		$venId = $purchase->getVenId();
		$contactId = $purchase->getContactId();
		$approvId = $purchase->getApprovId();
		$entry = $purchase->toArray();

		$vens = new General_Models_VendorMapper();
		$venName = $vens->findVenName($venId);
        $entry[] = $venName;

		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($contactId);
		$approvName = $contacts->findContactName($approvId);
		
		$entry[] = $contactName;
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
   			$entry = new Asset_Models_Purchase();
   			$entry->setPurId($row->purId)
				->setName($row->name)
				->setVenId($row->venId)
				->setType($row->type)
				->setSpec($row->spec)
				->setInvoice($row->invoice)
				->setUnit($row->unit)
				->setPrice($row->price)
				->setQuantity($row->quantity)
   				->setAmount($row->amount)
				->setContactId($row->contactId)
				->setPurDate($row->purDate)
				->setApprovId($row->approvId)
				->setApprovDate($row->approvDate)
				->setRemark($row->remark)
				->setCTime($row->cTime);

			$vens = new General_Models_VendorMapper();
			$venName = $vens->findVenName($entry->getVenId());
            $entry->setVenName($venName);
   				
			$contacts = new Employee_Models_ContactMapper();
		    $contactName = $contacts->findContactName($entry->getContactId());
			$entry->setApplicName($contactName);
		    $approvName = $contacts->findContactName($entry->getApprovId());
			$entry->setApprovName($approvName);
   			 				
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    
	public function delete($purId)
	{
		$this->getDbTable()->delete("purId = ".(int)$purId);
		}

	public function findPurchaseName($id) // check //ref from cpp
	{
		$arrayNames = $this->getDbTable()->findPurchaseName($id);
		
		$name = $arrayNames[0]->name;
		
		return $name;
		}
}
?>
