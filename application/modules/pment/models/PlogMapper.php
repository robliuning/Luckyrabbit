<?php
//Updated on 25th May by Rob

class Pment_Models_PlogMapper
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
			$this->setDbTable('Pment_Models_DbTable_Plog');
		}
		return $this->_dbTable;
	}
	public function save(Pment_Models_Plog $plog)
	{
		$data = array(
			'plogId' => $plog->getPlogId(),
			'projectId' => $plog->getProjectId(),
			'logDate' => $plog->getLogDate(),
			'weatherAm' => $plog->getWeatherAm(),
			'weatherPm' => $plog->getWeatherPm(),
			'tempHi' => $plog->getTempHi(),
			'tempLo' => $plog->getTempLo(),
			'part' => $plog->getPart(),
			'number' => $plog->getNumber(),
			'operator' => $plog->getOperator(),
			'foreman' => $plog->getForeman(),
			'safety' => $plog->getSafety(),
			'problem' => $plog->getProblem(),
			'resolve' => $plog->getResolve(),
			'relatedFile' => $plog->getRelatedFile(),
			'changeSig' => $plog->getChangeSig(),
			'material' => $plog->getMaterial(),
			'contactId' => $plog->getContactId(),
			'remark' => $plog->getRemark()
		);
		if (null === ($id = $plog->getPlogId())) {
			unset($data['plogId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('plogId = ?' => $plog->getPlogId()));
		}
	}

	public function find($plogId,Pment_Models_Plog $plog)
	{
		$resultSet = $this->getDbTable()->find($plogId);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$plog->setPlogId($row->pLogId)
				->setProjectId($row->projectId)
				->setLogDate($row->logDate)
				->setWeatherAm($row->weatherAm)
				->setWeatherPm($row->weatherPm)
				->setTempHi($row->tempHi)
				->setTempLo($row->tempLo)
				->setPart($row->part)
				->setNumber($row->number)
				->setOperator($row->operator)
				->setForeman($row->foreman)
				->setSafety($row->safety)
				->setProblem($row->problem)
				->setResolve($row->resolve)
				->setRelatedFile($row->relatedFile)
				->setChangeSig($row->changeSig)
				->setMaterial($row->material)
				->setContactId($row->contactId)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($plog->getContactId());
		$plog->setContactName($contactName);
	}

	public function fetchAllNames()
	{
		$resultSet = $this->getDbTable()->fetchAllNames();
		$entries = array();
		foreach($resultSet as $row){
			$entry = new Pment_Models_Plog();
			$entry ->setPlogId($row->plogId)
					->setLogDate($row->logDate);
			$entries[] = $entry;
		}
		return $entries;
	}

	public function fetchAllJoin($key = null,$condition = null) //check
	{
		if($condition == null)
		{
			$resultSet = $this->getDbTable()->fetchAll();
			}
			else
			{
				$resultSet = $this->getDbTable()->search($key,$condition);
				}

		$plogs = array();

		foreach($resultSet as $row){
			$plog = new Pment_Models_Plog();
			$plog ->setPlogId($row->plogId)
				->setLogDate($row->logDate);
			$plogs[] = $plog;
			}
		return $plogs;
		}

	public function findarrayPlog($id)
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('plogId = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		$row = $row->toArray();
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($row['contactId']);
		$row['contactName'] = $contactName;
		return $row;
	}

	public function delete($id)
	{
		$this->getDbTable()->delete('plogId = ' . (int)$id);
	}
	
			
	public function formValidator($form,$formType)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('logDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('part')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('operator')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('foreman')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('contactName')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('logDate')->addValidator($dateValidator);
		
		$intValidator = new Zend_Validate_Int();
		$intValidator->setMessage(General_Models_Text::$text_notInt);
		$form->getElement('number')->addValidator($intValidator);
		$form->getElement('tempHi')->addValidator($intValidator);
		$form->getElement('tempLo')->addValidator($intValidator);
		
		return $form;
	}
	
	public function dataValidator($formData,$formType)
	{
		$errorMsg = null;
		$trigger = 0;

		if($formData['contactId'] == null)
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_vehicle_contact_notFound."<br/>".$errorMsg;
			}
		$projectId = $formData['projectId'];
		$logDate = $formData['logDate'];
		if($formType == 0)
		{
			if($this->getDbTable()->checkLogDate($logDate,$projectId))
			{
				$trigger = 1;
				$errorMsg = General_Models_Text::$text_date_exist."<br/>".$errorMsg;
				}
			}
		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
	}
}
?>