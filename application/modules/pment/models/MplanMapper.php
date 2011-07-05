<?php
//Updated in 4th July by Rob

class Pment_Models_MplanMapper
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
			$this->setDbTable('Pment_Models_DbTable_Mplan');
		}
		return $this->_dbTable;
	}

	public function save(Pment_Models_Mplan $mplan) 
	{
		$data = array(
			'planId' => $mplan->getPlanId(),
			'projectId' => $mplan->getProjectId(),
			'yearNum' => $mplan->getYearNum(),
			'monNum' => $mplan->getMonNum(),
			'pDate' => $mplan->getPDate(),
			'contactId' => $mplan->getContactId(),
			'status' =>$mplan->getStatus(),
			'remark' => $mplan->getRemark()
		);
		if (null === ($id = $mplan->getPlanId())) {
			unset($data['planId']);
			return $this->getDbTable()->insert($data);
		} else {
			return $this->getDbTable()->update($data, array('planId = ?' => $mplan->getPlanId()));
		}
	}
	
	/*public function find($id,Pment_Models_Mplan $mplan)
	{
		$result = $this->getDbTable()->find($id);

		if (0 == count($result)) {
			return;
		}
		$row = $result->current();
		$mplan->setPlanId($row->planId)
				->setPlanType($row->planType)
				->setProjectId($row->projectId)
				->setDueDate($row->dueDate)
				->setApplicId($row->applicId)
				->setApplicDate($row->applicDate)
				->setApprovId($row->approvId)
 				->setApprovDate($row->approvDate)
				->setTotal($row->total)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		$projects = new Project_Models_ProjectMapper();
		$projectName = $projects->findProjectName($mplan->getProjectId());
		$mplan->setProjectName($projectName);
		$contacts = new Employee_Models_ContactMapper();
		$applicName = $contacts->findContactName($mplan->getApplicId());
		if($mplan->getApprovId()!= null)
		{
			$approvName = $contacts->findContactName($mplan->getApprovId());
			$mplan->setApprovName($approvName);
			}
		$mplan->setApplicName($applicName);
	}*/
	
	public function findArrayMplan($id) 
	{
		$id = (int)$id;
		$mplan = $this->getDbTable()->fetchRow('planId = '.$id);
		$entry = $mplan->toArray();
		return $entry;
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
		
		$entries = array();
		foreach($resultSet as $row){
			$entry = new Pment_Models_Mplan();
			$entry->setPlanId($row->planId)
				->setYearNum($row->yearNum)
				->setmonNum($row->monNum)
				->setProjectId($row->projectId)
				->setPDate($row->pDate)
				->setContactId($row->contactId)
				->setStatus($row->status);
			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findContactName($entry->getContactId());
			$entry->setContactName($contactName);
			
			$entries[] = $entry;
			}
		return $entries;
		}
	
	public function delete($planId)
	{
		$this->getDbTable()->delete("planId = ".(int)$planId);
	}
	
	public function populateDd($form)
	{
		$yearNow = date("Y");
		$startYear = $yearNow - 5;
		$endYear = $yearNow + 5;
		$monNow = date("m");
		for($i = $startYear; $i<= $endYear; $i++)
		{
			$dis = $i."年";
			$form->getElement('yearNum')->addMultiOption($i,$dis);
			}
		$form->setDefault('yearNum', $yearNow);
		for($i = 1;$i<=12;$i++)
		{
			$dis = $i."月";
			$form->getElement('monNum')->addMultiOption($i,$dis);
			}
		$form->setDefault('monNum',$monNow);
	}

	public function formValidator($form,$formType)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('pDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('pDate')->addValidator($dateValidator);
		
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
