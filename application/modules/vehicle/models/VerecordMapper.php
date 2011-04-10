<?php
  //creation date 09-04-2011
  //creating by lincoy
  //completion date 09-04-2011

class Vehicle_Models_VerecordMapper
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
           $this->setDbTable('Vehicle_Models_DbTable_Verecord');
        }
        return $this->_dbTable;
    }

	public function save(Vehicle_Models_Verecord $verecord) 
    {
        $data = array(
			'recordId' => $verecord->getRecordId(),
			'veId' => $verecord->getVeId(),
			'startDate' => $verecord->getStartDate(),
			'endDate' => $verecord->getEndDate(),
			'purpose' => $verecord->getPurpose(),
			'mile' => $verecord->getMile(),
			'pilot' => $verecord->getPilot(),
			'otherUser' => $verecord->getOtherUser(),
			'remark' => $verecord->getRemark()
        );

        if (null === ($id = $verecord->getRecordId())) {
            unset($data['recordId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('recordId = ?' => $verecord->getRecordId()));
        }  
    }

	public function findArrayVerecord($id)
	{
		$row = $this->getDbTable()->fetchRow('recordId = '.$id);
		
		return $row->toArray();
	}

    public function findVerecordJoin($recordId,Vehicle_Models_Verecord $verecord) 
    {
        $resultSet = $this->getDbTable()->findVerecordJoin($recordId);

        if (0 == count($resultSet)) {

            return;
        }

        $row = $resultSet[0];
        $verecord  ->setRecordId($row->recordId)
			       ->setVeId($row->veId)
			       ->setStartDate($row->startDate)
			       ->setEndDate($row->endDate)
			       ->setPurpose($row->purpose)
			       ->setMile($row->mile)
			       ->setPilot($row->pilot)
			       ->setOtherUser($row->otherUser)
			       ->setRemark($row->remark)
			       ->setPlateNo($row->plateNo);
    }

	public function delete($recordId)
	{
		$this->getDbTable()->delete('recordId = '.(int)$recordId);
	}

	public function fetchAllJoin($data = null,$condition = null)
	{
		$resultSet = $this->getDbTable()->fetchAllJoin($data,$condition);	
        $verecords   = array();
        
        foreach ($resultSet as $row) 
        {
			$verecord = new Vehicle_Models_Verecord();
            $verecord->setRecordId($row->recordId)
				     ->setVeId($row->veId)
				     ->setStartDate($row->startDate)
				     ->setEndDate($row->endDate)
				     ->setMile($row->mile)
				     ->setPilot($row->pilot)
				     ->setOtherUser($row->otherUser)
					 ->setPlateNo($row->plateNo)
					 ->setContactId($row->contactId);

			//get contactName according to contactId
		    $contacts = new Employee_Models_ContactMapper();
			$contactId = $verecord->getContactId();
			$name = $contacts->findContactName($contactId);
            
			$verecord->setContactName($name);
			
			$verecords[] = $verecord;
			}
		return $verecords;
	}

	public function populateVeDd($form) 
	{
		$vehicles = new Vehicle_Models_VehicleMapper();
		$arrayVehicles = $vehicles->fetchAllPalteNo();

		foreach($arrayVehicles as $vehicle)
		{
			$form->getElement('veId')->addMultiOption($vehicle->getVeId(),$vehicle->getPlateNo());//veId is hiden and                                                                                           //plateNo is shown
		}
	}

	public function search($key,$condition)
	{
         $entries = $this->fetchAllJoin($key,$condition);
		 return $entries;
	}

}

?>