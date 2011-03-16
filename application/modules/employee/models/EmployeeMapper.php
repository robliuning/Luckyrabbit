<?php

class Application_Model_EmployeeMapper
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
            $this->setDbTable('Application_Model_DbTable_Employee');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Employee $employee)
    {
        $data = array(
            'empId' => $employee->getEmpId(),
            'name' => $employee->getName(),
            'gender' => $employee->getGender(),
            'age' => $employee->getAge(),
            'deptName' => $employee->getDeptName(),
            'dutyName' => $employee->getDutyName(),
            'titleName' => $employee->getTitleName(),
            'idCard' => $employee->getIdCard(),
            'phone' => $employee->getPhone(),
            'otherContact' => $employee->getOtherContact(),
            'address' => $employee->getAddress(),
            'status' => $employee->getStatus(),
            'remark' => $employee->getRemark(),
        );
        if (null === ($id = $employee->getEmpId())) {
            unset($data['empId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('empId = ?' => $empId));
        }
    }
    public function find($empId, Application_Model_Employee $employee)

    {

        $result = $this->getDbTable()->find($empId);

        if (0 == count($result)) {

            return;

        }

        $row = $result->current();

        $employee ->setEmpId($row->empId)
        		->setName($row->name)
                  ->setGender($row->gender)
                  ->setAge($row->age)
                  ->setDeptNamedeptName
                  ->setDutyName($row->dutyName)
                  ->setTitleName($row->titleName)
                  ->setIdCard($row->idCard)
                  ->setPhone($row->phone)
                  ->setOtherContact($row->otherContact)
                  ->setAddress($row->address)
                  ->setStatus($row->status)
                  ->setRemark($row->remark);
    }
 

    public function fetchAll()

    {

        $resultSet = $this->getDbTable()->fetchAll();

        $entries   = array();

        foreach ($resultSet as $row) {

            $entry = new Application_Model_Employee();

			$entry->setEmpId($row->empId)
				  ->setName($row->name)
                  ->setGender($row->gender)
                  ->setAge($row->age)
                  ->setDeptName($row->deptName)
                  ->setDutyName($row->dutyName)
                  ->setTitleName($row->titleName)
                  ->setIdCard($row->idCard)
                  ->setPhone($row->phone)
                  ->setOtherContact($row->otherContact)
                  ->setAddress($row->address)
                  ->setStatus($row->status)
                  ->setRemark($row->remark);

            $entries[] = $entry;

        }

        return $entries;

    }

}

?>