<?php
//update on 14th May By Rob

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
			'pilot' => $vehicle->getPilot(),
			'user' => $vehicle->getUser(),
			'fuelCons' => $vehicle->getFuelCons(),
			'pDate' => $vehicle->getPDate(),
			'brand' => $vehicle->getBrand(),
			'price' => $vehicle->getPrice(),
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
		$vehicle->setVeId($row->veId)
				->setPlateNo($row->plateNo)
				->setName($row->name)
				->setColor($row->color)
				->setLicense($row->license)
				->setContactId($row->contactId)
				->setPilot($row->pilot)
				->setUser($row->user)
				->setFuelCons($row->fuelCons)
				->setPDate($row->pDate)
				->setBrand($row->brand)
				->setPrice($row->price)
				->setRemark($row->remark)
				->setCTime($row->cTime);

		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($vehicle->getContactId());
		$pilotName = $contacts->findContactName($vehicle->getPilot());
		$vehicle->setContactName($contactName);
		$vehicle->setPilotName($pilotName);
	}

	public function delete($veId)
	{
		$result = $this->getDbTable()->delete('veId = '.(int)$veId);
		return $result;
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
		
		foreach ($resultSet as $row) 
		{
			$entry = new Vehicle_Models_Vehicle();
			$entry->setVeId($row->veId)
				->setPlateNo($row->plateNo)
				->setName($row->name)
				->setColor($row->color)
				->setLicense($row->license)
				->setContactId($row->contactId)
				->setPilot($row->pilot);
				
			$contacts = new Employee_Models_ContactMapper();
			$contactId = $entry->getContactId();
			$contactName = $contacts->findContactName($contactId);
			$pilot = $entry->getPilot();
			$pilotName = $contacts->findContactName($pilot);
			
			$entry->setContactName($contactName);
			$entry->setPilotName($pilotName);
			
			$entries[] = $entry;
			}
		return $entries;
	}
	
	public function findArrayVehicle($id)
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('veId = '.$id);
		if(!$row){
			throw new Exception("Could not find row $id");
		}
		
		$contacts = new Employee_Models_ContactMapper();
		$contactId = $row->contactId;
		$pilot = $row->pilot;
		$contactName = $contacts->findContactName($contactId);
		$pilotName = $contacts ->findContactName($pilot);
		$row = $row->toArray();
		$row["contactName"] = $contactName;
		$row["pilotName"] = $pilotName;
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
		
	public function findContactId($id)
	{		
		$resultSet = $this->getDbTable()->findContactId($id);
		$contactId = $resultSet[0]->contactId;
		return $contactId;
		}
	
	public function fetchAllPalteNo()
	{
		$resultSet = $this->getDbTable()->fetchAllPalteNo();
		$vehicles = array();
		foreach ($resultSet as $row) 
		{
			$vehicle = new Vehicle_Models_Vehicle();
			$vehicle->setVeId($row->veId)
				->setPlateNo($row->plateNo)
				->setName($row->name);
			
			$vehicles[] = $vehicle;
			}
		return $vehicles;	
	}
		
	public function formValidator($form,$formType)
	{
		$numberValidator = new Zend_Validate_Float();
		$numberValidator->setMessage(General_Models_Text::$text_notInt);
		$form->getElement('fuelCons')->addValidator($numberValidator);
		$form->getElement('price')->addValidator($numberValidator);
		
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('name')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('contactName')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('pilotName')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('pDate')->addValidator($dateValidator);
		
		if($formType == 0) //indicate it is a addForm
		{
			$lengthValidator = new Zend_Validate_StringLength(array('min'=>9,'max'=>9));
			$lengthValidator->setMessage(General_Models_Text::$text_vehicle_plateNo_length);
			$form->getElement('plateNo')->addValidator($lengthValidator);
			$form->getElement('plateNo')->setAllowEmpty(false)
										->addValidator($emptyValidator);
		}
		return $form;
	}
	
	public function dataValidator($formData,$formType)
	{
		$errorMsg = null;
		$trigger = 1;
		if($formType == 0 )
		{
			$validatorPlateNo = new Zend_Validate_Db_RecordExists(
				array(
					'table' => 've_vehicles',
					'field' => 'plateNo'
					)
				);
			if($validatorPlateNo->isValid($formData['plateNo']))
			{
				$trigger = 1;
				$errorMsg = General_Models_Text::$text_recordExists."<br/>".$errorMsg;
				}
			}
		if($formData['contactId'] == null)
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_vehicle_contact_notFound."<br/>".$errorMsg;
			}
		if($formData['pilot'] == null)
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_vehicle_pilot_notFound."<br/>".$errorMsg;
			}
		
		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
	}
}
?>