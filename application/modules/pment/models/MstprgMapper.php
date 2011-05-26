<?php
//Updated on 25th May by Rob

class Pment_Models_MstprgMapper
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
			$this->setDbTable('Pment_Models_DbTable_Mstprg');
		}
		return $this->_dbTable;
	}
	public function save(Pment_Models_Mstprg $mstprg)
	{
		$data = array(
			'mstprgId' => $mstprg->getMstprgId(),
			'projectId' => $mstprg->getProjectId(),
			'stage' => $mstprg->getStage(),
			'task' => $mstprg->getTask(),
			'startDate' => $mstprg->getStartDate(),
			'endDate' => $mstprg->getEndDate(),
			'contactId' => $mstprg->getContactId(),
			'remark' => $mstprg->getRemark()
		);
		if (null === ($id = $mstprg->getMstprgId())) {
			unset($data['mstprgId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('mstprgId = ?' => $mstprg->getMstprgId()));
		}
	}

	public function find($mstprgId,Pment_Models_Mstprg $mstprg)
	{
		$resultSet = $this->getDbTable()->find($mstprgId);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$mstprg->setMstprgId($row->mstprgId)
				->setProjectId($row->projectId)
				->setStage($row->stage)
				->setTask($row->task)
				->setStartDate($row->startDate)
				->setEndDate($row->endDate)
				->setPeriod($row->period)
				->setContactId($row->contactId)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($mstprg->getContactId());
		$mstprg->setContactName($contactName);
	}

	public function fetchAllNames()
	{
		$resultSet = $this->getDbTable()->fetchAllNames();
		$entries = array();
		foreach($resultSet as $row){
			$entry = new Pment_Models_Mstprg();
			$entry ->setMstprgId($row->mstprgId)
					->setStage($row->stage)
					->setTask($row->task);
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

		$mstprgs = array();

		foreach($resultSet as $row){
			$mstprg = new Pment_Models_Mstprg();
			$mstprg ->setMstprgId($row->mstprgId)
				->setProjectId($row->projectId)
				->setStage($row->stage)
				->setTask($row->task)
				->setStartDate($row->startDate)
				->setEndDate($row->endDate)
				->setPeriod($row->period)
				->setContactId($row->contactId);

			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findContactName($mstprg->getContactId());
			$mstprg->setContactName($contactName);
			$mstprgs[] = $mstprg;
			}
		return $mstprgs;
		}

	public function findArrayMstprg($id)
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('mstprgId = ' . $id);
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
		$this->getDbTable()->delete('mstprgId = ' . (int)$id);
	}
	
			
	public function formValidator($form,$formType)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('task')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('startDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('endDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('contactName')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('startDate')->addValidator($dateValidator);
		$form->getElement('startDate')->addValidator($dateValidator);
		
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
		$dateStart = new Zend_Date($formData['startDate'],'YYYY-MM-DD');
		$dateEnd = new Zend_Date($formData['endDate'],'YYYY-MM-DD');
		
		if($dateStart->isLater($dateEnd))
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_date_startEndError."<br/>".$errorMsg;
			}
			
		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
	}
	
	public function findStage($mstprgId)
	{
		$stage = null;
		$stage = $this->getDbTable()->findStage($mstprgId);
		$stage = (int)$stage[0];
		return $stage;
		}
	
	public function calStage($projectId)
	{
		$stage = null;
		$stage = $this->getDbTable()->calStage($projectId);
		$stage = count($stage)+1;
		return $stage;
		}
}
?>