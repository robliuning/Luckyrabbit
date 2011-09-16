<?php
//updated on 14th May By Rob

class Vehicle_Models_RepairMapper
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
		$this->setDbTable('Vehicle_Models_DbTable_Repair');
		}
		return $this->_dbTable;
	}

	public function save(Vehicle_Models_Repair $repair) 
	{
		$data = array(
			'repId' => $repair->getRepId(),
			'veId' => $repair->getVeId(),
			'rDate' => $repair->getRDate(),
			'reason' => $repair->getReason(),
			'detail' => $repair->getDetail(),
			'contactId' => $repair->getContactId(),
			'spot' => $repair->getSpot(),
			'descr' => $repair->getDescr(),
			'amount' => $repair->getAmount(),
			'insFlag' => $repair->getInsFlag(),
			'indem' => $repair->getIndem(),
			'remark' => $repair->getRemark()
		);
		if (null === ($id = $repair->getRepId())) {
			unset($data['repId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('repId = ?' => $repair->getRepId()));
		}
	}

	public function findArrayRepair($id)
	{
		$row = $this->getDbTable()->fetchRow('repId = '.$id);
		$row = $row->toArray();
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($row['contactId']);
		$row['contactName'] = $contactName;
		
		return $row;
	}

	public function findRepairJoin($repId,Vehicle_Models_Repair $repair) 
	{
		$row = $this->getDbTable()->fetchRow('repId = '.$repId);

		if (0 == count($row)){
			return;
			}
			
		$repair->setRepId($row->repId)
				->setVeId($row->veId)
				->setRDate($row->rDate)
				->setReason($row->reason)
				->setDetail($row->detail)
				->setContactId($row->contactId)
				->setSpot($row->spot)
				->setDescr($row->descr)
				->setAmount($row->amount)
				->setInsFlag($row->insFlag)
				->setIndem($row->indem)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		if($repair->getInsFlag() == 1)
			{
				$repair->setInsFlag(General_Models_Text::$text_repair_indem_true);
				}
				else
				{
					$repair->setInsFlag(General_Models_Text::$text_repair_indem_false);
					}
		$veId = $repair->getVeId();
		$vehicles = new Vehicle_Models_VehicleMapper();
		$plateNo = $vehicles->findPlateNo($veId);
		$repair->setPlateNo($plateNo);
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($repair->getContactId());
		$repair->setContactName($contactName);
	}

	public function delete($repId)
	{
		$this->getDbTable()->delete('repId = '.(int)$repId);
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
		$repairs = array();
		
		foreach ($resultSet as $row) 
		{
			$repair = new Vehicle_Models_Repair();
			$repair->setRepId($row->repId)
				 	->setVeId($row->veId)
				 	->setRDate($row->rDate)
				 	->setContactId($row->contactId)
				 	->setSpot($row->spot)
				 	->setAmount($row->amount)
				 	->setInsFlag($row->insFlag);

			if($repair->getInsFlag() == '1')
			{
				$repair->setInsFlag(General_Models_Text::$text_repair_indem_true);
				}
				else
				{
					$repair->setInsFlag(General_Models_Text::$text_repair_indem_false);
					}
			$veId = $repair->getVeId();
			$vehicles = new Vehicle_Models_VehicleMapper();
			$plateNo = $vehicles->findPlateNo($veId);
			$repair->setPlateNo($plateNo);
			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findContactName($repair->getContactId());
			$repair->setContactName($contactName);
			$repairs[] = $repair;
			}
		return $repairs;*/
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
		$numberValidator = new Zend_Validate_Float();
		$numberValidator->setMessage(General_Models_Text::$text_notInt);
		$form->getElement('amount')->addValidator($numberValidator);
		$form->getElement('indem')->addValidator($numberValidator);
		
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('rDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('contactName')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('amount')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('insFlag')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('rDate')->addValidator($dateValidator);
		
		return $form;
	}
	
	public function dataValidator($formData,$formType)
	{
		$errorMsg = null;
		$trigger = 0;
		$checkRc = 0;
		
		if($formData['contactId'] == null)
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_repair_contact_notFound."<br/>".$errorMsg;
			}
			
		$arry['trigger'] = $trigger;
		$arry['errorMsg'] = $errorMsg;
		return $arry;
	}
	
	public function findVeId($id)
	{
		$row = $this->getDbTable()->fetchRow('repId = '.$id);
		$veId = $row->veId;
		return $veId;
		}
}
?>