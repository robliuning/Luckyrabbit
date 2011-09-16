<?php
//Updated on 25th May by Rob

class Pment_Models_WkprgMapper
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
			$this->setDbTable('Pment_Models_DbTable_Wkprg');
		}
		return $this->_dbTable;
	}
	public function save(Pment_Models_Wkprg $wkprg)
	{
		$data = array(
			'wkprgId' => $wkprg->getWkprgId(),
			'projectId' => $wkprg->getProjectId(),
			'wkNum' => $wkprg->getWkNum(),
			'startDate' => $wkprg->getStartDate(),
			'endDate' => $wkprg->getEndDate(),
			'wkPlan' => $wkprg->getWkPlan(),
			'wkAct' => $wkprg->getWkAct(),
			'nextPlan' => $wkprg->getNextPlan(),
			'problem' => $wkprg->getProblem(),
			'resolve' => $wkprg->getResolve(),
			'contactId' => $wkprg->getContactId(),
			'remark' => $wkprg->getRemark()
		);
		if (null === ($id = $wkprg->getWkprgId())) {
			unset($data['wkprgId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('wkprgId = ?' => $wkprg->getWkprgId()));
		}
	}

	public function find($wkprgId,Pment_Models_Wkprg $wkprg)
	{
		$resultSet = $this->getDbTable()->find($wkprgId);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$wkprg->setWkprgId($row->wkprgId)
				->setProjectId($row->projectId)
				->setWkNum($row->wkNum)
				->setStartDate($row->startDate)
				->setEndDate($row->endDate)
				->setPeriod($row->period)
				->setWkPlan($row->wkPlan)
				->setWkAct($row->wkAct)
				->setNextPlan($row->nextPlan)
				->setProblem($row->problem)
				->setResolve($row->resolve)
				->setContactId($row->contactId)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($wkprg->getContactId());
		$wkprg->setContactName($contactName);
	}

	public function fetchAllNames()
	{
		$resultSet = $this->getDbTable()->fetchAllNames();
		$entries = array();
		foreach($resultSet as $row){
			$entry = new Pment_Models_Wkprg();
			$entry ->setWkprgId($row->wkprgId)
					->setWkNum($row->wkNum);
			$entries[] = $entry;
		}
		return $entries;
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

		$wkprgs = array();

		foreach($resultSet as $row){
			$wkprg = new Pment_Models_Wkprg();
			$wkprg ->setWkprgId($row->wkprgId)
				->setProjectId($row->projectId)
				->setWkNum($row->wkNum)
				->setStartDate($row->startDate)
				->setEndDate($row->endDate)
				->setPeriod($row->period)
				->setContactId($row->contactId);

			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findContactName($wkprg->getContactId());
			$wkprg->setContactName($contactName);
			$wkprgs[] = $wkprg;
			}
		return $wkprgs;*/
		}

	public function findArrayWkprg($id)
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('wkprgId = ' . $id);
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
		$this->getDbTable()->delete('wkprgId = ' . (int)$id);
	}
	
			
	public function formValidator($form,$formType)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('wkAct')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('nextPlan')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('startDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('endDate')->setAllowEmpty(false)
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
	
	public function findWkNum($wkprgId)
	{
		$wkNum = null;
		$wkNum = $this->getDbTable()->findWkNum($wkprgId);
		$wkNum = (int)$wkNum[0]->wkNum;
		return $wkNum;
		}
	
	public function calWkNum($projectId)
	{
		$wkNum = null;
		$wkNum = $this->getDbTable()->calWkNum($projectId);
		$wkNum = count($wkNum)+1;
		return $wkNum;
		}
	
	public function findWkPlan($wkNum,$projectId)
	{
		$wkNum = $wkNum - 1;
		$resultSet = $this->getDbTable()->findWkPlan($wkNum,$projectId);
		$wkPlan = $resultSet[0]->nextPlan;
		return $wkPlan;
		}
}
?>