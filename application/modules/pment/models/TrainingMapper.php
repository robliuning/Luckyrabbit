<?php
//Updated on 30th May by Rob

class Pment_Models_TrainingMapper
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
			$this->setDbTable('Pment_Models_DbTable_Training');
		}
		return $this->_dbTable;
	}
	public function save(Pment_Models_Training $training)
	{
		$data = array(
			'traId' => $training->getTraId(),
			'projectId' => $training->getProjectId(),
			'traDate' => $training->getTraDate(),
			'content' => $training->getContent(),
			'name' => $training->getName(),
			'contactId' => $training->getContactId(),
			'remark' => $training->getRemark()
		);
		if (null === ($id = $training->getTraId())) {
			unset($data['traId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('traId = ?' => $training->getTraId()));
		}
	}

	public function find($trainingId,Pment_Models_Training $training)
	{
		$resultSet = $this->getDbTable()->find($trainingId);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$training->setTraId($row->traId)
				->setProjectId($row->projectId)
				->setTraDate($row->traDate)
				->setContent($row->content)
				->setName($row->name)
				->setContactId($row->contactId)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($training->getContactId());
		$training->setContactName($contactName);
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

		$trainings = array();

		foreach($resultSet as $row){
			$training = new Pment_Models_Training();
			$training ->setTraId($row->traId)
				->setProjectId($row->projectId)
				->setTraDate($row->traDate)
				->setName($row->name)
				->setContactId($row->contactId);

			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findContactName($training->getContactId());
			$training->setContactName($contactName);
			$trainings[] = $training;
			}
		return $trainings;*/
		}

	public function findArrayTraining($id)
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('traId = ' . $id);
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
		$this->getDbTable()->delete('traId = ' . (int)$id);
	}
	
			
	public function formValidator($form,$formType)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('traDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('content')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('name')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('traDate')->addValidator($dateValidator);
		
		return $form;
	}
	
	public function dataValidator($formData,$formType)
	{
		$errorMsg = null;
		$trigger = 0;

		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
	}
}
?>