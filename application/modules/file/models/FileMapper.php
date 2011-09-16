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
			'file_id' => $file->getFileId(),
			'file_name' => $file->getName(),
			'file_display' => $file->getDisplay(),
			'file_size' => $file->getSize(),
			'specId' => $file->getSpecId(),
			'file_edition' => $file->getEdition(),
			'contactId' => $file->getContactId(),
			'file_inFlag' => $file->getInFlag(),
			'file_projFlag' => $file->getProjFlag(),
			'projectId' => $file->getProjectId(),
			'file_status' => $file->getStatus(),
			'file_remark' => $file->getRemark(),
			'file_type' => $file->getType(),
			'file_parent'=>$file->getParent()
		);

		if (null === ($id = $file->getFileId())) {
			unset($data['file_id']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('file_id = ?' => $file->getFileId()));
		}
	}

	public function find($fileId,File_Models_File $file) 
	{
		$resultSet = $this->getDbTable()->find($fileId);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();
		$file->setFileId($row->file_id)
				->setName($row->file_name)
				->setDisplay($row->file_display)
				->setSize($row->file_size)
				->setSpecId($row->specId)
				->setEdition($row->file_edition)
				->setContactId($row->contactId)
				->setInFlag($row->file_inFlag)
				->setProjFlag($row->file_projFlag)
				->setProjectId($row->projectId)
				->setStatus($row->file_status)
				->setRemark($row->file_remark)
				->setType($row->file_type)
				->setParent($row->file_parent)
				->setCTime($row->file_cTime);

		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($file->getContactId());
		$file->setContactName($contactName);
	}

	public function delete($fileId)
	{
		$result = $this->getDbTable()->delete('file_id = '.(int)$fileId);
		return $result;
	}

	public function fetchAllJoin($key = null,$condition = null) 
	{
		$paginator = $this->getDbTable()->fetchAllJoin($key,$condition);
		
		return $paginator;
	}
	
	public function findArrayFile($id)
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('file_id = '.$id);
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