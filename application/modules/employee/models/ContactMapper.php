<?php
/*
created by ËïÁÖ
time of creating 3-26-2011
completed time 3-26-2011
add fetchAllJoin  by lincoy 04-16
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
    public function save(Employee_Models_Contact $contact) //check
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
            $this->getDbTable()->update($data, array('contactId = ?' => $contact->getContactId()));
        }
    }
    public function find($contactId, Employee_Models_Contact $contact) //check
    {

        $result = $this->getDbTable()->find($contactId);

        if (0 == count($result)) {

            return;

        }

        $row = $result->current();

        $contact  ->setContactId($row->contactId)
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
	public function findArrayContact($id) //check
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('contactId = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
		}
		
	public function findContactName($id) // check //ref from cpp
	{
		$arrayNames = $this->getDbTable()->findContactName($id);
		
		$name = $arrayNames[0]->name;
		
		return $name;
		}
	public function findContactNames($key) //check
	{
		$arrayNames = $this->getDbTable()->findContactNames($key);
		
		return $arrayNames;
		}
		
    public function fetchAll() //check
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
                   
            $strtimes = explode(" ",$entry->getBirth());
			$timearray = explode("-",$strtimes[0]);
			$birthYear = $timearray[0];
			$thisYear = date('Y');
			$age = $thisYear - $birthYear;
			$entry->setAge($age);    
            $entries[] = $entry;
        }
        return $entries;
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
                   
            $strtimes = explode(" ",$entry->getBirth());
			$timearray = explode("-",$strtimes[0]);
			$birthYear = $timearray[0];
			$thisYear = date('Y');
			$age = $thisYear - $birthYear;
			$entry->setAge($age);    
            $entries[] = $entry;
        }
        return $entries;
    }
			
    
    public function delete($id) //check
    { 	
    	$this->getDbTable()->delete('contactId = ' . (int)$id);
    	}
    	
    public function populateContactDd($form) //check
  	{		
  		$titles=new General_Models_TitleMapper();
		$arrayTitles = $titles->fetchAll();
  		foreach($arrayTitles as $title)
		{
			$form->getElement('titleName')->addMultiOption($title->getName(),$title->getName());
			}	
  		}
}
?>