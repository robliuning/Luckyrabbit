<?php
//Updated on 30th May by Rob

class Pment_Models_RecordMapper
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
			$this->setDbTable('Pment_Models_DbTable_Record');
		}
		return $this->_dbTable;
	}
	public function save(Pment_Models_Record $record)
	{
		$data = array(
			'recId' => $record->getrecId(),
			'projectId' => $record->getProjectId(),
			'recDate' => $record->getRecDate(),
			'recUnit' => $record->getRecUnit(),
			'content' =>$record->getContent(),
			'recNumber' => $record->getrecNumber(),
			'contactId' => $record->getContactId(),
			'remark' => $record->getRemark()
		);
		if (null === ($id = $record->getRecId())) {
			unset($data['recId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('recId = ?' => $record->getRecId()));
		}
	}

	public function find($recId,Pment_Models_Record $record)
	{
		$resultSet = $this->getDbTable()->find($recId);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$record->setrecId($row->recId)
				->setProjectId($row->projectId)
				->setRecDate($row->recDate)
				->setRecNumber($row->recNumber)
				->setRecUnit($row->recUnit)
				->setContent($row->content)
				->setContactId($row->contactId)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findcontactName($record->getContactId());
		$record->setContactName($contactName);
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

		$records = array();

		foreach($resultSet as $row){
			$record = new Pment_Models_Record();
			$record ->setrecId($row->recId)
				->setProjectId($row->projectId)
				->setRecDate($row->recDate)
				->setRecUnit($row->recUnit)
				->setRecNumber($row->recNumber)
				->setContactId($row->contactId);

			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findcontactName($record->getContactId());
			$record->setContactName($contactName);
			$records[] = $record;
			}
		return $records;*/
		}

	public function findArrayRecord($id)
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('recId = ' . $id);
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
		$this->getDbTable()->delete('recId = ' . (int)$id);
	}
	
			
	public function formValidator($form,$formType)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('recDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('recNumber')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('recUnit')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('contactName')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('content')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('recDate')->addValidator($dateValidator);
		
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

		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
	}
}
?>