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
			'planName' => $mplan->getPlanName(),
			'typeId' => $mplan->getTypeId(),
			'yearNum' => $mplan->getYearNum(),
			'monNum' => $mplan->getMonNum(),
			'pDate' => $mplan->getPDate(),
			'contactId' => $mplan->getContactId(),
			'status' =>$mplan->getStatus(),
			'remark' => $mplan->getRemark(),
			'approvcId' => $mplan->getApprovcId(),
			'approvcDate' => $mplan->getApprovcDate(),
			'approvcRemark' => $mplan->getApprovcRemark(),
			'approvfId' => $mplan->getApprovfId(),
			'approvfDate' => $mplan->getApprovfDate(),
			'approvfRemark' => $mplan->getApprovfRemark(),
			'total' => $mplan->getTotal()
		);
		if (null === ($id = $mplan->getPlanId())) {
			unset($data['planId']);
			return $this->getDbTable()->insert($data);
		} else {
			return $this->getDbTable()->update($data, array('planId = ?' => $mplan->getPlanId()));
		}
	}
	
	public function find($id,Pment_Models_Mplan $mplan)
	{
		$result = $this->getDbTable()->find($id);

		if (0 == count($result)) {
			return;
		}
		$row = $result->current();
		$mplan->setPlanId($row->planId)
				->setProjectId($row->projectId)
				->setPlanName($row->planName)
				->setTypeId($row->typeId)
				->setYearNum($row->yearNum)
				->setMonNum($row->monNum)
				->setPDate($row->pDate)
				->setContactId($row->contactId)
				->setTotal($row->total)
				->setApprovcId($row->approvcId)
				->setApprovcDate($row->approvcDate)
				->setApprovcRemark($row->approvcRemark)
				->setApprovfId($row->approvfId)
				->setApprovfDate($row->approvfDate)
				->setApprovfRemark($row->approvfRemark)
				->setStatus($row->status)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($mplan->getContactId());
		$status = $mplan->getStatus();
		$mstatus = new General_Models_MstatusMapper();
		$statusName = $mstatus->getStatusName($status);
		$mplan->setStatusName($statusName);
		if($status >= 3)
		{
			$approvcName = $contacts->findContactName($mplan->getApprovcId());
			$mplan->setApprovcName($approvcName);
			}
		if($status == 4 || $status ==6)
		{
			$approvfName = $contacts->findContactName($mplan->getApprovfId());
			$mplan->setApprovfName($approvfName);
			}
		$mplan->setContactName($contactName);
		$ptypes = new General_Models_PtypeMapper();
		$typeName = $ptypes->findPtypeName($mplan->getTypeId());
		$mplan->setTypeName($typeName);
	}
	
	public function findArrayMplan($id) 
	{
		$id = (int)$id;
		$mplan = $this->getDbTable()->fetchRow('planId = '.$id);
		$entry = $mplan->toArray();
		return $entry;
	}

	public function fetchAllJoin($key = null,$condition = null) 
	{
	/*	if($condition == null)
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
		return $entries;*/
		$paginator = $this->getDbTable()->fetchAllJoin($key,$condition);
		return $paginator;
		}
	
	public function fetchAllValidations($userId)
	{
		$contactId = $this->userIdToContactId($userId);
		$resultSet = $this->getDbTable()->fetchAllValidations($contactId);
		$entries = array();
		foreach($resultSet as $row){
			$entry = new Pment_Models_Mplan();
			$entry->setPlanId($row->planId)
				->setPlanName($row->planName)
				->setTypeId($row->typeId)
				->setTypeName($row->typeName)
				->setYearNum($row->yearNum)
				->setMonNum($row->monNum)
				->setProjectId($row->projectId)
				->setProjectName($row->name)
				->setPDate($row->pDate)
				->setContactId($row->contactId)
				->setContactName($row->contactName);
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
		
		$ptypes = new General_Models_PtypeMapper();
		$arrayPtypes = $ptypes->fetchAll();

		foreach($arrayPtypes as $ptype)
		{
			$form->getElement('typeId')->addMultiOption($ptype->getId(),$ptype->getName());
			}
	}

	public function formValidator($form,$formType)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('pDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('planName')->setAllowEmpty(false)
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

	public function userIdToContactId($userId)
	{
		$users = new System_Models_UserMapper();
		$contactId = $users->getContactId($userId);
		return $contactId;
		}
}
?>
