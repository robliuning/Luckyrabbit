<?php
//Updated on 30th May by Rob

class Pment_Models_ReviewerMapper
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
			$this->setDbTable('Pment_Models_DbTable_Reviewer');
		}
		return $this->_dbTable;
	}
	public function save(Pment_Models_Reviewer $reviewer)
	{
		$data = array(
			'reId' => $reviewer->getReId(),
			'planId' => $reviewer->getPlanId(),
			'addDate' => $reviewer->getAddDate(),
			'contactId' => $reviewer->getContactId(),
			'status' => $reviewer->getStatus()
			);
		if (null === ($id = $reviewer->getReId())) {
			unset($data['reId']);
			$id = $this->getDbTable()->insert($data);
			return $id;
		} else {
			$this->getDbTable()->update($data, array('reId = ?' => $reviewer->getReId()));
		}
	}
	
	public function fetchAllIds($planId)
	{
		$resultSet = $this->getDbTable()->fetchAllIds($planId);
		$arrayIds = null;
		foreach($resultSet as $row)
		{
			$contactId = $row->contactId;
			$users = new System_Models_UserMapper();
			$userId = $users->getUserIdById($contactId);
			$arrayIds[] = $userId;
			}
		return $arrayIds;
	}
	
	public function fetchAllNames($planId)
	{
		$resultSet = $this->getDbTable()->fetchAllNames($planId);
		
		$arrayNames = null;
		foreach ($resultSet as $row)
		{
			$reviewer = new Pment_Models_Reviewer();
			$reviewer->setContactId($row->contactId);
			$reviewer->setPlanId($row->planId);
			$reviewer->setContactName($row->contactName);
			$addDate = "无";
			if($row->addDate != "")
			{
				$addDate = $row->addDate;
				}
			$reviewer->setAddDate($addDate);
			$reviewer->setReId($row->reId);
			$reviewer->setStatus($row->status);
			if($row->status == 0)
			{
				$reviewer->setStatusName('未核验');
				}
				elseif($row->status == 1)
				{
					$reviewer->setStatusName('已核验');
					}
			$arrayNames[] = $reviewer;
			}
		return $arrayNames;
	}

	public function findReviewer($planId,$userId)
	{
		$users = new System_Models_UserMapper();
		$contactId = $users->getContactId($userId);
		$resultSet = $this->getDbTable()->findReviewer($planId,$contactId);
		
		$reviewer = new Pment_Models_Reviewer();
		
		$row = $resultSet[0];
		
		$reviewer->setPlanId($planId);
		$reviewer->setContactId($row->contactId);
		$reviewer->setAddDate($row->addDate);
		$reviewer->setReId($row->reId);
		$reviewer->setStatus($row->status);
		if($row->status == 0)
		{
			$reviewer->setStatusName('未核验');
			}
			elseif($row->status == 1)
			{
				$reviewer->setStatusName('已核验');
				}
		return $reviewer;
	}

	public function find($reId,Pment_Models_Reviewer $reviewer)
	{
		$resultSet = $this->getDbTable()->find($reId);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$reviewer->setReId($row->reId)
				->setPlanId($row->planId)
				->setAddDate($row->addDate)
				->setContactId($row->contactId)
				->setStatus($row->status);
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($reviewer->getContactId());
		$reviewer->setContactName($contactName);
	}

	public function resetAllReviewers($planId)
	{
		$arrayNames = $this->fetchAllNames($planId);
		foreach($arrayNames as $name)
		{
			if($name->getStatus() == 1)
			{
				$name->setStatus(0);
				$name->setAddDate(null);
				$this->save($name);
				}
			}
		}

	public function checkAllValidated($planId)
	{
		$arrayNames = $this->fetchAllNames($planId);
		$validation = true;
		foreach($arrayNames as $name)
		{
			if($name->getStatus() == 0)
			{
				$validation = false;
				}
			}
		return $validation;
		}

	public function checkExist($contactId,$planId)
	{
		return true;
		}

	public function fetchAllJoin($key = null,$condition = null) //check
	{
		
		$paginator = $this->getDbTable()->fetchAllJoin($key, $condition);
		return $paginator;
		}

	public function delete($id)
	{
		$this->getDbTable()->delete('reId = ' . (int)$id);
	}
}
?>