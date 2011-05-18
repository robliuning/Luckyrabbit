<?php
//updated on 14th May By Rob

class Vehicle_Models_MtncMapper
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
		$this->setDbTable('Vehicle_Models_DbTable_Mtnc');
		}
		return $this->_dbTable;
	}

	public function save(Vehicle_Models_Mtnc $mtnc) 
	{
		$data = array(
			'mtnId' => $mtnc->getMtnId(),
			'veId' => $mtnc->getVeId(),
			'rDate' => $mtnc->getRDate(),
			'detail' => $mtnc->getDetail(),
			'contactId' => $mtnc->getContactId(),
			'mile' => $mtnc->getMile(),
			'amount' => $mtnc->getAmount(),
			'remark' => $mtnc->getRemark()
		);
		if (null === ($id = $mtnc->getMtnId())) {
			unset($data['mtnId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('mtnId = ?' => $mtnc->getMtnId()));
		}
	}

	public function findArrayMtnc($id)
	{
		$row = $this->getDbTable()->fetchRow('mtnId = '.$id);
		$row = $row->toArray();
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($row['contactId']);
		$row['contactName'] = $contactName;
		
		return $row;
	}

	public function findMtncJoin($mtnId,Vehicle_Models_Mtnc $mtnc) 
	{
		$row = $this->getDbTable()->fetchRow('mtnId = '.$mtnId);

		if (0 == count($row)){
			return;
			}
			
		$mtnc->setMtnId($row->mtnId)
				->setVeId($row->veId)
				->setRDate($row->rDate)
				->setDetail($row->detail)
				->setContactId($row->contactId)
				->setMile($row->mile)
				->setAmount($row->amount)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		$veId = $mtnc->getVeId();
		$vehicles = new Vehicle_Models_VehicleMapper();
		$plateNo = $vehicles->findPlateNo($veId);
		$mtnc->setPlateNo($plateNo);
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($mtnc->getContactId());
		$mtnc->setContactName($contactName);
	}

	public function delete($mtnId)
	{
		$this->getDbTable()->delete('mtnId = '.(int)$mtnId);
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
		$mtncs = array();
		
		foreach ($resultSet as $row) 
		{
			$mtnc = new Vehicle_Models_Mtnc();
			$mtnc->setMtnId($row->mtnId)
					->setVeId($row->veId)
					->setRDate($row->rDate)
					->setContactId($row->contactId)
					->setMile($row->mile)
					->setAmount($row->amount);
			$veId = $mtnc->getVeId();
			$vehicles = new Vehicle_Models_VehicleMapper();
			$plateNo = $vehicles->findPlateNo($veId);
			$mtnc->setPlateNo($plateNo);
			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findContactName($mtnc->getContactId());
			$mtnc->setContactName($contactName);
			$mtncs[] = $mtnc;
			}
		return $mtncs;
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

		$intValidator = new Zend_Validate_Int();
		$intValidator->setMessage(General_Models_Text::$text_notInt);
		$form->getElement('mile')->addValidator($intValidator);
		
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('rDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('contactName')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('amount')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('mile')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('rDate')->addValidator($dateValidator);
		
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
			$errorMsg = General_Models_Text::$text_mtnc_contact_notFound."<br/>".$errorMsg;
			}
			
		$arry['trigger'] = $trigger;
		$arry['errorMsg'] = $errorMsg;
		return $arry;
	}
	
	public function findVeId($id)
	{
		$row = $this->getDbTable()->fetchRow('mtnId = '.$id);
		$veId = $row->veId;
		return $veId;
		}
}
?>