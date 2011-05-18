<?php
//updated on 14th May By Rob

class Vehicle_Models_DrirecordMapper
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
		$this->setDbTable('Vehicle_Models_DbTable_Drirecord');
		}
		return $this->_dbTable;
	}

	public function save(Vehicle_Models_Drirecord $drirecord) 
	{
		$mileEarly = $drirecord->getMileEarly();
		$mileEnd = $drirecord->getMileEnd();
		
		if($mileEarly != null && $mileEnd != null)
		{
			$mile = $mileEnd - $mileEarly;
			}
			else
			{
				$mile = 0;
				}
		$data = array(
			'recordId' => $drirecord->getRecordId(),
			'veId' => $drirecord->getVeId(),
			'mileEarly' => $drirecord->getMileEarly(),
			'mileEnd' => $drirecord->getMileEnd(),
			'mile' => $mile,
			'rYear' => $drirecord->getRYear(),
			'rMonth' => $drirecord->getRMonth(),
			'remark' => $drirecord->getRemark()
		);

		if (null === ($id = $drirecord->getRecordId())) {
			unset($data['recordId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('recordId = ?' => $drirecord->getRecordId()));
		}
	}

	public function findArrayDrirecord($id)
	{
		$row = $this->getDbTable()->fetchRow('recordId = '.$id);
		
		return $row->toArray();
	}

	public function findDrirecordJoin($recordId,Vehicle_Models_Drirecord $drirecord) 
	{
		$row = $this->getDbTable()->fetchRow('recordId = '.$recordId);

		if (0 == count($row)) {

			return;
		}
		$drirecord->setRecordId($row->recordId)
				->setVeId($row->veId)
				->setRYear($row->rYear)
				->setRMonth($row->rMonth)
				->setMileEarly($row->mileEarly)
				->setMileEnd($row->mileEnd)
				->setMile($row->mile)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		$veId = $drirecord->getVeId();
		$vehicles = new Vehicle_Models_VehicleMapper();
		$plateNo = $vehicles->findPlateNo($veId);
		$drirecord->setPlateNo($plateNo);
	}

	public function delete($recordId)
	{
		$this->getDbTable()->delete('recordId = '.(int)$recordId);
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
		$drirecords = array();
		
		foreach ($resultSet as $row) 
		{
			$drirecord = new Vehicle_Models_Drirecord();
			$drirecord->setRecordId($row->recordId)
				 	->setVeId($row->veId)
				 	->setRYear($row->rYear)
				 	->setRMonth($row->rMonth)
				 	->setMile($row->mile);

			if($drirecord->getMile() == 0)
			{
				$drirecord->setMile(General_Models_Text::$text_drirecord_no_mile);
				}
				
			$vehicles = new Vehicle_Models_VehicleMapper();
			$veId = $drirecord->getVeId();
			$plateNo = $vehicles->findPlateNo($veId);
			$drirecord->setPlateNo($plateNo);
			$drirecords[] = $drirecord;
			}
		return $drirecords;
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
	
	public function populateDate($form)
	{
		//populate ryear
		$year = date('Y');
		for($i = -5;$i <= 5; $i++)
		{
			$id = $year + $i;
			$text =(string)$id.'年';
			$form->getElement('rYear')->addMultiOption($id,$text);
			}
		$form->getElement('rYear')->setValue($year);
		//populate rmonth
		for($j = 1; $j <= 12; $j++)
		{
			$id = $j;
			$text = $j.'月';
			$form->getElement('rMonth')->addMultiOption($id,$text);
			}
			
		$month = date('m');
		$month = (int)$month - 1;
		$form->getElement('rMonth')->setValue($month);
	}
	
	public function formValidator($form,$formType)
	{
		$numberValidator = new Zend_Validate_Int();
		$numberValidator->setMessage(General_Models_Text::$text_notInt);
		$form->getElement('mileEarly')->addValidator($numberValidator);
		$form->getElement('mileEnd')->addValidator($numberValidator);
		
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('mileEarly')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('mileEnd')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		return $form;
	}
	
	public function dataValidator($formData,$rid,$vId,$formType)
	{
		$errorMsg = null;
		$trigger = 0;
		$checkRc = 0;
		if($formType == 1)
		{
			if($checkRc ==1)
			{
				$checkRc = 1;
				}
			}
		if($checkRc == 0)
		{
			$rYear = $formData['rYear'];
			$rMonth = $formData['rMonth'];
			$checkRe = $this->getDbTable()->checkRecordExist($vId,$rYear,$rMonth);
			if($checkRe)
			{
				$trigger = 1;
				$errorMsg = General_Models_Text::$text_recordExists."<br/>".$errorMsg;
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