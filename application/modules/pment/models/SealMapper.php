<?php
//Updated on 30th May by Rob

class Pment_Models_SealMapper
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
			$this->setDbTable('Pment_Models_DbTable_Seal');
		}
		return $this->_dbTable;
	}
	public function save(Pment_Models_Seal $seal)
	{
		$data = array(
			'seaId' => $seal->getSeaId(),
			'projectId' => $seal->getProjectId(),
			'sealDate' => $seal->getSealDate(),
			'returnDate' => $seal->getReturnDate(),
			'sealUser' => $seal->getSealUser(),
			'sealFile' =>$seal->getSealFile(),
			'name' => $seal->getName(),
			'contactId' => $seal->getContactId(),
			'reason' => $seal->getReason(),
			'copy' => $seal->getCopy(),
			'takeOut' => $seal->getTakeOut(),
			'remark' => $seal->getRemark()
		);
		if (null === ($id = $seal->getSeaId())) {
			unset($data['seaId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('seaId = ?' => $seal->getSeaId()));
		}
	}

	public function find($seaId,Pment_Models_Seal $seal)
	{
		$resultSet = $this->getDbTable()->find($seaId);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$seal->setseaId($row->seaId)
				->setProjectId($row->projectId)
				->setSealDate($row->sealDate)
				->setReturnDate($row->returnDate)
				->setName($row->name)
				->setSealUser($row->sealUser)
				->setSealFile($row->sealFile)
				->setReason($row->reason)
				->setCopy($row->copy)
				->setTakeOut($row->takeOut)
				->setContactId($row->contactId)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findcontactName($seal->getContactId());
		$seal->setContactName($contactName);
	}

	public function fetchAllJoin($key = null,$condition = null) //check
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

		$seals = array();

		foreach($resultSet as $row){
			$seal = new Pment_Models_Seal();
			$seal ->setSeaId($row->seaId)
				->setProjectId($row->projectId)
				->setSealDate($row->sealDate)
				->setReturnDate($row->returnDate)
				->setSealFile($row->sealFile)
				->setName($row->name)
				->setTakeOut($row->takeOut)
				->setContactId($row->contactId);

			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findcontactName($seal->getContactId());
			$seal->setcontactName($contactName);
			$seals[] = $seal;
			}
		return $seals;*/
		}

	public function findArraySeal($id)
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('seaId = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		$row = $row->toArray();
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findcontactName($row['contactId']);
		$row['contactName'] = $contactName;
		return $row;
	}

	public function delete($id)
	{
		$this->getDbTable()->delete('seaId = ' . (int)$id);
	}
	
			
	public function formValidator($form,$formType)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('sealDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('returnDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('name')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('sealUser')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('contactName')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('sealFile')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('reason')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('copy')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$intValidator = new Zend_Validate_Int();
		$intValidator->setMessage(General_Models_Text::$text_notInt);
		$form->getElement('copy')->addValidator($intValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('sealDate')->addValidator($dateValidator);
		$form->getElement('returnDate')->addValidator($dateValidator);
		
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
			
		$dateStart = new Zend_Date($formData['sealDate'],'YYYY-MM-DD');
		$dateEnd = new Zend_Date($formData['returnDate'],'YYYY-MM-DD');
		
		if($dateStart->isLater($dateEnd))
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_date_startEndError."<br/>".$errorMsg;
			}

		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
	}
}
?>