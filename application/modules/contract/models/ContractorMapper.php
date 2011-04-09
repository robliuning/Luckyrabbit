<?php

/* write by lxj
   2011-04-03   v2.0
   rewrite by lxj
   2011-04-08   v0.2
   */

class Contract_Models_ContractorMapper
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
            $this->setDbTable('Contract_Models_Dbtable_Contractor');
        }
        return $this->_dbTable;
    }

    public function save(Contract_Models_Contract $contract)
    {
        $data = array(
            'ContractorId' => $contract->getContractorId(),
            'name' => $contract->getName(),
            'artiPerson' => $contract->getArtiPerson(),
            'licenseNo' => $contract->getLicenseNo(),
			'busiField' => $contract->getBusiField(),
			'phoneNo' => $contract->getPhoneNo(),
			'otherContact' => $contract->getOtherContact(),
			'address' => $contract->getAddress(),
			'remark' => $contract->getRemark()
        );
        if (null === ($id = $contract->getContractorId())) {
            unset($data['contractorId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('contractorId = ?' => $contractorId));
        }
    }
 
	public function delete($id) //check
    {
    	$result = $this->getDbTable()->delete('contractorId = ' . (int)$id);
    	return $result;	
    	}
 

    public function fetchAll() //check
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Contract_Models_Contractor();

			 $entry ->setContractorId($row->contractorId)
        				 ->setName($row->name)
						 ->setArtiPerson($row->artiPerson)
						 ->setLicenseNo($row->licenseNo)
				         ->setPhoneNo($row->phoneNo)
						 ->setOtherContact($row->otherContact)
						 ->setAddress($row->address);
                  
            $entries[] = $entry;
        }
        return $entries;
    }

	public function Search($key, $condition)
	{
		 $resultSet = $this->getDbTable()->Search($key, $condition);
         $entries   = array();
         foreach ($resultSet as $row) {
             $entry = new Contract_Models_Contract();

			 $entry ->setContractorId($row->contractorId)
        				 ->setName($row->name)
						 ->setArtiPerson($row->artiPerson)
						 ->setLicenseNo($row->licenseNo)
						 ->setPhoneNo($row->phoneNo)
						 ->setOtherContact($row->otherContact)
						 ->setAddress($row->address);
                  
            $entries[] = $entry;
        }
        return $entries;
	}

	public function findArrayContractor($contractorId)
	{
		$resultSet = $this->getDbtable()->findArrayContract($contractorId);
        return $resultSet;
	}

}
?>
