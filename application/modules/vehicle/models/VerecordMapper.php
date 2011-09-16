<?php
//updated on 14th May By Rob

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
		$mile = 0;
		$mileBf = $verecord->getMileBf();
		$mileAf = $verecord->getMileAf();
		if($mileBf != null && $mileAf != null)
		{
			$mile = $mileAf - $mileBf;
			}
		$data = array(
			'recordId' => $verecord->getRecordId(),
			'veId' => $verecord->getVeId(),
			'prjFlag' => $verecord->getPrjFlag(),
			'projectId' => $verecord->getProjectId(),
			'startDate' => $verecord->getStartDate(),
			'endDate' => $verecord->getEndDate(),
			'route' => $verecord->getRoute(),
			'mileBf' => $verecord->getMileBf(),
			'mileAf' => $verecord->getMileAf(),
			'purpose' => $verecord->getPurpose(),
			'user' => $verecord->getUser(),
			'mileRef' => $verecord->getMileRef(),
			'contactId' => $verecord->getContactId(),
			'mile' => $mile,
			'amount' => $verecord->getAmount(),
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
		$row = $row->toArray();
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($row['contactId']);
		$row['contactName'] = $contactName;
		return $row;
	}

	public function findVerecordJoin($recordId,Vehicle_Models_Verecord $verecord)
	{
		$row = $this->getDbTable()->fetchRow('recordId = '.$recordId);
		if (0 == count($row)){
			return;
			}
		$verecord->setRecordId($row->recordId)
				->setVeId($row->veId)
				->setPrjFlag($row->prjFlag)
				->setProjectId($row->projectId)
				->setStartDate($row->startDate)
				->setEndDate($row->endDate)
				->setPeriod($row->period)
				->setRoute($row->route)
				->setMileBf($row->mileBf)
				->setMileAf($row->mileAf)
				->setMile($row->mile)
				->setPurpose($row->purpose)
				->setContactId($row->contactId)
				->setUser($row->user)
				->setMileRef($row->mileRef)
				->setAmount($row->amount)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		$veId = $verecord->getVeId();
		$vehicles = new Vehicle_Models_VehicleMapper();
		$plateNo = $vehicles->findPlateNo($veId);
		$verecord->setPlateNo($plateNo);
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($verecord->getContactId());
		$verecord->setContactName($contactName);
		
		if($verecord->getPrjFlag() == '0')
		{
			$verecord->setPrjFlag(General_Models_Text::$text_verecord_prjFlag_false);
			$verecord->setProjectName(General_Models_Text::$text_verecord_prjFlag_false);
			}
			elseif($verecord->getPrjFlag() == '1')
			{
				$verecord->setPrjFlag(General_Models_Text::$text_verecord_prjFlag_true);
				$projects = new Project_Models_ProjectMapper();
				$verecord->setProjectName($projects->findProjectName($verecord->getProjectId()));
				}
	}

	public function delete($recordId)
	{
		$this->getDbTable()->delete('recordId = '.(int)$recordId);
	}

	public function fetchAllJoin($key = null,$condition = null)
	{
		$paginator = $this->getDbTable()->fetchAllJoin($key, $condition);
		return $paginator;
		/*if($condition == null)
		{
			$resultSet = $this->getDbTable()->fetchAll();
			}
			else
			{
				$resultSet = $this->getDbTable()->search($key,$condition);
				}
		$verecords = array();
		
		foreach ($resultSet as $row) 
		{
			$verecord = new Vehicle_Models_Verecord();
			$verecord->setrecordId($row->recordId)
					->setVeId($row->veId)
					->setPrjFlag($row->prjFlag)
					->setStartDate($row->startDate)
					->setEndDate($row->endDate)
					->setPeriod($row->period)
					->setMile($row->mile)
					->setContactId($row->contactId);
			$veId = $verecord->getVeId();
			$vehicles = new Vehicle_Models_VehicleMapper();
			$plateNo = $vehicles->findPlateNo($veId);
			$verecord->setPlateNo($plateNo);
			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findContactName($verecord->getContactId());
			$verecord->setContactName($contactName);
			$verecords[] = $verecord;
			}
		return $verecords;*/
	}

	public function populateVeDd($form) 
	{
		$vehicles = new Vehicle_Models_VehicleMapper();
		$arrayVehicles = $vehicles->fetchAllPalteNo();

		foreach($arrayVehicles as $vehicle)
		{
			$text = '车牌: '.$vehicle->getPlateNo()."　名称: ".$vehicle->getName();
			$form->getElement('veId')->addMultiOption($vehicle->getVeId(),$text);
		}
	}
	
	public function formValidator($form,$formType)
	{
		$intValidator = new Zend_Validate_Int();
		$intValidator->setMessage(General_Models_Text::$text_notInt);
		$form->getElement('mileBf')->addValidator($intValidator);
		$form->getElement('mileAf')->addValidator($intValidator);
		$form->getElement('mileRef')->addValidator($intValidator);

		$numberValidator = new Zend_Validate_Float();
		$numberValidator->setMessage(General_Models_Text::$text_notInt);
		$form->getElement('amount')->addValidator($numberValidator);
		
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('startDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('endDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('mileBf')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('mileAf')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('contactName')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('startDate')->addValidator($dateValidator);
		$form->getElement('endDate')->addValidator($dateValidator);
		return $form;
	}
	
	public function dataValidator($formData,$rid,$vId,$formType)
	{
		$errorMsg = null;
		$trigger = 0;
		$checkRc = 0;
		
		if($formData['contactId'] == null)
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_verecord_contact_notFound."<br/>".$errorMsg;
			}
		if($formData['prjFlag'] == '1')
		{
			if($formData['projectId'] == '0')
			{
				$trigger = 1;
				$errorMsg = General_Models_Text::$text_verecord_projectId_wrong."<br/>".$errorMsg;
				}
			}
		$arry['trigger'] = $trigger;
		$arry['errorMsg'] = $errorMsg;
		return $arry;
	}
	
	public function findVeId($id)
	{
		$row = $this->getDbTable()->fetchRow('recordId = '.$id);
		$veId = $row->veId;
		return $veId;
		}
}
?>