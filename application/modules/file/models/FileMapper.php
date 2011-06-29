<?php
//updated in 23rd June By Rob

class File_Models_FileMapper
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
 		$this->setDbTable('File_Models_DbTable_File');
		}
		return $this->_dbTable;
	}
	public function save(File_Models_File $file) 
	{
		$data = array(
			'fileId' => $file->getFileId(),
			'name' => $file->getName(),
			'display' => $file->getDisplay(),
			'size' => $file->getSize(),
			'specId' => $file->getSpecId(),
			'edition' => $file->getEdition(),
			'contactId' => $file->getContactId(),
			'inFlag' => $file->getInFlag(),
			'projFlag' => $file->getProjFlag(),
			'projectId' => $file->getProjectId(),
			'status' => $file->getStatus(),
			'remark' => $file->getRemark(),
			'type' => $file->getType()
		);

		if (null === ($id = $file->getFileId())) {
			unset($data['fileId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('fileId = ?' => $file->getFileId()));
		}
	}

	public function find($fileId,File_Models_File $file) 
	{
		$resultSet = $this->getDbTable()->find($fileId);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();
		$file->setFileId($row->fileId)
				->setName($row->name)
				->setDisplay($row->display)
				->setSize($row->size)
				->setSpecId($row->specId)
				->setEdition($row->edition)
				->setContactId($row->contactId)
				->setInFlag($row->inFlag)
				->setProjFlag($row->projFlag)
				->setProjectId($row->projectId)
				->setStatus($row->status)
				->setRemark($row->remark)
				->setType($row->type)
				->setCTime($row->cTime);

		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($file->getContactId());
		$file->setContactName($contactName);
	}

	public function delete($fileId)
	{
		$result = $this->getDbTable()->delete('fileId = '.(int)$fileId);
		return $result;
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
		
		foreach ($resultSet as $row) 
		{
			$entry = new File_Models_File();
			$entry->setFileId($row->fileId)
				->setName($row->name)
				->setDisplay($row->display)
				->setSize($row->size)
				->setType($row->type)
				->setEdition($row->edition)
				->setContactId($row->contactId)
				->setInFlag($row->inFlag)
				->setStatus($row->status);
				
			$contacts = new Employee_Models_ContactMapper();
			$contactId = $entry->getContactId();
			$contactName = $contacts->findContactName($contactId);
			$entry->setContactName($contactName);
			$entries[] = $entry;
			}
		return $entries;
	}
	
	public function findArrayFile($id)
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('fileId = '.$id);
		if(!$row){
			throw new Exception("Could not find row $id");
		}
		
		$contacts = new Employee_Models_ContactMapper();
		$contactId = $row->contactId;
		$contactName = $contacts->findContactName($contactId);
		$row = $row->toArray();
		$row["contactName"] = $contactName;
		return $row;
	}
}
?>