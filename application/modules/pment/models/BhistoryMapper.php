<?php
//Updated on 30th May by Rob

class Pment_Models_BhistoryMapper
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
			$this->setDbTable('Pment_Models_DbTable_Bhistory');
		}
		return $this->_dbTable;
	}
	
	public function save(Pment_Models_Bhistory $bhistory)
	{
		$data = array(
			'hiId' => $bhistory->getHiId(),
			'planId' => $bhistory->getPlanId(),
			'editDate' => $bhistory->getEditDate(),
			'contactId' => $bhistory->getContactId(),
			'status' => $bhistory->getStatus(),
			'editType' => $bhistory->getEditType()
		);
		if (null === ($id = $bhistory->getHiId())) {
			unset($data['hiId']);
			$id = $this->getDbTable()->insert($data);
			return $id;
		} else {
			$this->getDbTable()->update($data, array('hiId = ?' => $bhistory->getHiId()));
		}
	}
	
	public function fetchAllBhistories($planId,$status)
	{
		$resultSet = $this->getDbTable()->fetchAllBhistories($planId,$status);

		$arrayBhistories = null;
		foreach ($resultSet as $row)
		{
			$bhistory = new Pment_Models_Bhistory();
			$bhistory->setContactId($row->contactId);
			$bhistory->setContactName($row->contactName);
			$bhistory->setEditDate($row->editDate);
			$bhistory->setHiId($row->hiId);
			$bhistory->setStatus($row->status);
			$bhistory->setEditType($row->editType);
			$arrayBhistories[] = $bhistory;
			}
		return $arrayBhistories;
	}

	public function delete($id)
	{
		$this->getDbTable()->delete('hiId = ' . (int)$id);
	}
}
?>