<?php
  //creation date 15-04-2011
  //creating by lincoy
  //completion date 15-04-2011

class General_Models_VendorMapper
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
            $this->setDbTable('General_Models_DbTable_Vendor');
        }
        return $this->_dbTable;
    }

	public function save(General_Models_Vendor $vendor) 
    {
        $data = array(
            'venId' => $vendor->getVenId(),
			'name' => $vendor->getName(),
			'type' => $vendor->getType(),
			'contactId' => $vendor->getContactId(),
			'address' => $vendor->getAddress(),
            'remark' => $vendor->getRemark(),
			'cTime' => $vendor->getCTime()
        );
        if (null === ($id = $vendor->getVenId())) {
            unset($data['venId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('venId = ?' => $vendor->getVenId()));
        }
    }

	public function delete($venId)
	{
		$this->getDbTable()->delete("venId = ".(int)$venId);
	}

	public function findVenName($id)
	{
		$arrayNames = $this->getDbTable()->findVenName($id);
		
		$name = $arrayNames[0]->name;
		
		return $name;
	}

	

}
?>