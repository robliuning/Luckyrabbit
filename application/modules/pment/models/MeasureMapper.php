<?php
//Updated on 30th May by Rob

class Pment_Models_MeasureMapper
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
			$this->setDbTable('Pment_Models_DbTable_Measure');
		}
		return $this->_dbTable;
	}
	public function save(Pment_Models_Measure $measure)
	{
		$data = array(
			'meaId' => $measure->getMeaId(),
			'projectId' => $measure->getProjectId(),
			'meaDate' => $measure->getMeaDate(),
			'measure' => $measure->getmeasure(),
			'problem' => $measure->getProblem(),
			'contactId' => $measure->getContactId(),
			'remark' => $measure->getRemark()
		);
		if (null === ($id = $measure->getMeaId())) {
			unset($data['meaId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('meaId = ?' => $measure->getMeaId()));
		}
	}

	public function find($meaId,Pment_Models_Measure $measure)
	{
		$resultSet = $this->getDbTable()->find($meaId);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$measure->setMeaId($row->meaId)
				->setProjectId($row->projectId)
				->setMeaDate($row->meaDate)
				->setMeasure($row->measure)
				->setProblem($row->problem)
				->setContactId($row->contactId)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findcontactName($measure->getContactId());
		$measure->setcontactName($contactName);
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

		$measures = array();

		foreach($resultSet as $row){
			$measure = new Pment_Models_Measure();
			$measure ->setMeaId($row->meaId)
				->setProjectId($row->projectId)
				->setMeaDate($row->meaDate)
				->setContactId($row->contactId);

			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findcontactName($measure->getContactId());
			$measure->setcontactName($contactName);
			$measures[] = $measure;
			}
		return $measures;
		}

	public function findArrayMeasure($id)
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('meaId = ' . $id);
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
		$this->getDbTable()->delete('meaId = ' . (int)$id);
	}
	
			
	public function formValidator($form,$formType)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('meaDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('measure')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('problem')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('contactName')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('meaDate')->addValidator($dateValidator);
		
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