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
            'email'   => $employee->getEmail(),
            'name' => $employee->getEname(),
        );
        if (null === ($id = $employee->getEid())) {
            unset($data['eid']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $eid));
        }
    }
    public function find($id, Application_Model_Employee $employee)

    {

        $result = $this->getDbTable()->find($id);

        if (0 == count($result)) {

            return;

        }

        $row = $result->current();

        $employee->setEid($row->eid)

                  ->setEmail($row->email)

                  ->setEname($row->name);
    }

 

    public function fetchAll()

    {

        $resultSet = $this->getDbTable()->fetchAll();

        $entries   = array();

        foreach ($resultSet as $row) {

            $entry = new Application_Model_Employee();

            $entry->setEid($row->eid)

                  ->setEmail($row->email)

                  ->setEname($row->name);

            $entries[] = $entry;

        }

        return $entries;

    }

}

?>