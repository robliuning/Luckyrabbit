<?php

class Contract_Models_ContractMapper
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
            $this->setDbTable('Contract_Models_Dbtable_Contract');
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
    public function find($contractorId, Contract_Models_Contract $contractorId)

    {

        $result = $this->getDbTable()->find($empId);

        if (0 == count($result)) {

            return;

        }

        $row = $result->current();

        $employee ->setEmpId($row->empId)
        		  ->setDeptName($row->deptName)
                  ->setDutyName($row->dutyName)
                  ->setStatus($row->status);
    }
 

    public function fetchAll()

    {

        $resultSet = $this->getDbTable()->fetchAll();

        $entries   = array();

        foreach ($resultSet as $row) {

            $entry = new Employee_Models_Employee();

			$entry->setEmpId($row->empId)
				  ->setDeptName($row->deptName)
                  ->setDutyName($row->dutyName)
                  ->setStatus($row->status);
                  
            $entries[] = $entry;

        }

        return $entries;

    }
}
?>
