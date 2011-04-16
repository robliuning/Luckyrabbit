<?php
  //creation date 09-04-2011
  //creating by lincoy
  //completion date 09-04-2011

class Vehicle_Models_VehicleMapper
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
           $this->setDbTable('Vehicle_Models_DbTable_Vehicle');
        }
        return $this->_dbTable;
    }
    public function save(Vehicle_Models_Vehicle $vehicle) 
    {
        $data = array(
			'veId' => $vehicle->getVeId(),
			'plateNo' => $vehicle->getPlateNo(),
			'name' => $vehicle->getName(),
			'color' => $vehicle->getColor(),
			'license' => $vehicle->getLicense(),
			'contactId' => $vehicle->getContactId(),
			'user' => $vehicle->getUser(),
			'fuelCons' => $vehicle->getFuelCons(),
			'remark' => $vehicle->getRemark()
        );

        if (null === ($id = $vehicle->getVeId())) {
            unset($data['veId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('veId = ?' => $vehicle->getVeId()));
        }  
    }

    public function find($veId,Vehicle_Models_Vehicle $vehicle) 
    {
        $resultSet = $this->getDbTable()->find($veId);

        if (0 == count($resultSet)) {

            return;
        }

        $row = $resultSet->current();
        $vehicle  ->setVeId($row->veId)
			      ->setPlateNo($row->plateNo)
			      ->setName($row->name)
			      ->setColor($row->color)
			      ->setLicense($row->license)
			      ->setContactId($row->contactId)
			      ->setUser($row->user)
			      ->setFuelCons($row->fuelCons)
			      ->setRemark($row->remark)
			      ->setCTime($row->cTime);
    }

	public function delete($veId)
	{
		$this->getDbTable()->delete('veId = '.(int)$veId);
	}

    /*public function fetchAllJoin()  // according to contactId from name  //check
    {
    	$resultSet = $this->getDbTable()->fetchAll();	
        $vehicles   = array();
        
        foreach ($resultSet as $row) 
        {
			$vehicle = new Vehicle_Models_Vehicle();
            $vehicle->setVeId($row->veId)
			      ->setPlateNo($row->plateNo)
			      ->setName($row->name)
			      ->setColor($row->color)
			      ->setLicense($row->license)
			      ->setContactId($row->contactId)
			      ->setUser($row->user);
			      //->setFuelCons($row->fuelCons)
			      //->setRemark($row->remark);
				  
		    $contacts = new Employee_Models_ContactMapper();
			$contactId = $vehicle->getContactId();
			$name = $contacts->findContactName($contactId);
            
			$vehicle->setContactName($name);
			
			$vehicles[] = $vehicle;
			}
		return $vehicles;
	} */

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
        
        foreach ($resultSet as $row) 
        {
			$entry = new Vehicle_Models_Vehicle();
            $entry->setVeId($row->veId)
			      ->setPlateNo($row->plateNo)
			      ->setName($row->name)
			      ->setColor($row->color)
			      ->setLicense($row->license)
			      ->setContactId($row->contactId)
			      ->setUser($row->user);
			      //->setFuelCons($row->fuelCons)
			      //->setRemark($row->remark);
				  
		    $contacts = new Employee_Models_ContactMapper();
			$contactId = $vehicle->getContactId();
			$name = $contacts->findContactName($contactId);
            
			$entry->setContactName($name);
			
			$entries[] = $entry;
			}
		return $entries;
	}

	public function search($key,$condition)
	{
		$resultSet = $this->getDbTable()->Search($key, $condition);
         $entries   = array();
         foreach ($resultSet as $row) {
             $entry = new Vehicle_Models_Vehicle();
			 $entry ->setVeId($row->veId)
			        ->setPlateNo($row->plateNo)
			        ->setName($row->name)
			        ->setColor($row->color)
			        ->setLicense($row->license)
			        ->setContactId($row->contactId)
			        ->setUser($row->user)
			        ->setContactName($row->contactName);
                  
            $entries[] = $entry;
        }
        return $entries;
	}
	
	public function findArrayVehicle($id)
	{
		$id = (int)$id;
	   	$row = $this->getDbTable()->fetchRow('veId = '.$id);
	   	if (!$row) {
			throw new Exception("Could not find row $id");
		}
		
		$contacts = new Employee_Models_ContactMapper();
		$contactId = $row->contactId;
		$name = $contacts->findContactName($contactId);
		$row = $row->toArray();
		$row["contactName"] = $name;
	   	return $row;
	}

	public function fetchAllVeId($key,$condition)
	{
		$resultSet = $this->getDbTable()->fetchAllVeId($key,$condition);
		return $resultSet;
	}

	public function findPlateNo($id)
	{
		$resultSet = $this->getDbTable()->findPlateNo($id);
		$plateNo = $resultSet[0]->plateNo;
		return $plateNo;
		}
	
	public function fetchAllPalteNo()
	{
		$resultSet = $this->getDbTable()->fetchAllPalteNo();		
		$vehicles   = array();
        foreach ($resultSet as $row) 
        {
			$vehicle = new Vehicle_Models_Vehicle();
            $vehicle->setVeId($row->veId)
			      ->setPlateNo($row->plateNo);
			      			
			$vehicles[] = $vehicle;
			}
		return $vehicles;	
	}
	
}
?>