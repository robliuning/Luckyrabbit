<?php
/*
created by ËïÁÖ
time of creating 3-26-2011
completed time 3-26-2011
*/

class Employee_Models_ContactMapper
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
            $this->setDbTable('Employee_Models_DbTable_Contact');
        }
        return $this->_dbTable;
    }
    public function save(Employee_Models_Contact $contact)
    {
        $data = array(
			'contactId' => $contact->getContactId(),
		     'name' => $contact->getName(),
			 'gender' => $contact->getGender(),
             'titleName' => $contact->getTitleName(),
			 'birth' => $contact->getBirth(),
			 'idCard' => $contact->getIdCard(),
			 'phoneNo' => $contact->getPhoneNo(),
			 'otherContact' => $contact->getOtherContact(),
			 'address' => $contact->getAddress(),
			 'remark' => $contact->getRemark(),
        );
        if (null === ($id = $contact->getContactId())) {
            unset($data['contactId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('contactId = ?' => $contactId));
        }
    }
    public function find($contactId, Employee_Models_Contact $contact)

    {

        $result = $this->getDbTable()->find($contactId);

        if (0 == count($result)) {

            return;

        }

        $row = $result->current();

        $contact  ->setEmpId($row->contactId)
        		  ->setName($row->name)
                  ->setGender($row->gender)
                  ->setTitleName($row->titleName)
                  ->setBirth($row->birth)
                  ->setIdCard($row->idCard)
                  ->setPhoneNo($row->phoneNo)
                  ->setOtherContact($row->otherContact)
                  ->setAddress($row->address)
                  ->setRemark($row->remark);
    }
 

    public function fetchAll()

    {

        $resultSet = $this->getDbTable()->fetchAll();

        $entries   = array();

        foreach ($resultSet as $row) {

            $entry = new Employee_Models_Contact();
		    $entry ->setContactId($row->contactId)
        		   ->setName($row->name)
        		   ->setTitleName($row->titleName)
                   ->setGender($row->gender)
                   ->setBirth($row->birth)
                   ->setIdCard($row->idCard)
                   ->setPhoneNo($row->phoneNo)
                   ->setOtherContact($row->otherContact)
                   ->setAddress($row->address)
                   ->setRemark($row->remark);


            $entries[] = $entry;

        }
        return $entries;
    }
}
?>