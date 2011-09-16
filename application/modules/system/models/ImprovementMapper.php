<?php
//Updated on 14th  July by rob

class System_Models_ImprovementMapper
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
			$this->setDbTable('System_Models_DbTable_Improvement');
		}
		return $this->_dbTable;
	}
		
	public function save(System_Models_Improvement $improvement)
	{
		$data = array(
			'imprId' => $improvement->getId(),
			'typeId' => $improvement->getTypeId() ,
			'userId' => $improvement->getUserId(),
			'priority' => $improvement->getPriority(),
			'description' => $improvement->getDescription(),
			'iTime' => $improvement->getITime() ,
			'modId' => $improvement->getModId() ,
			'status' => $improvement->getStatus()
			);
		if (null === ($id = $improvement->getId())) {
			unset($data['imprId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('imprId = ?' => $improvement->getId()));
		}
	}
	
	public function find($id,System_Models_Improvement $improvement)
	{
		$resultSet = $this->getDbTable()->find($id);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$improvement->setId($row->imprId)
				->setTypeId($row->typeId)
				->setUserId($row->userId)
				->setPriority($row->priority)
				->setDescription($row->description)
				->setITime($row->iTime)
				->setModId($row->modId)
				->setStatus($row->status);
		$status = $improvement->getStatus();
		if($status == 0)
		{
			$improvement->setStatusCh('等待处理');
			}
			elseif($status == 1)
			{
				$improvement->setStatusCh('处理中');
			}
			elseif($status == 2)
			{
				$improvement->setStatusCh('已解决');
				}
			elseif($status == 3)
			{
				$improvement->setStatusCh('暂时不能解决');
				}
		$users = new System_Models_UserMapper();
		$contactId = $users->getContactId($improvement->getUserId());
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($contactId);
		$modnames = new System_Models_ModnameMapper();
		$modNameCh = $modnames->getModNameCh($improvement->getModId());
		$imptypes = new System_Models_ImptypeMapper();
		$typeName = $imptypes->getTypeName($improvement->getTypeId());
		
		$improvement->setContactId($contactId);
		$improvement->setContactName($contactName);
		$improvement->setTypeName($typeName);
		$improvement->setModNameCh($modNameCh);
	}
	
	public function fetchAllJoin($key = null,$condition = null)
	{
		
		$paginator = $this->getDbTable()->fetchAllJoin($key,$condition);
		
		return $paginator;
		
		/*if($condition == null)
		{
			$resultSet = $this->getDbTable()->fetchAll();
			}
			else
			{
				$resultSet = $this->getDbTable()->search($key,$condition);
				}

		$entries= array();
		foreach ($resultSet as $row) {
			$entry = new System_Models_Improvement();
			$entry->setId($row->id)
				->setTypeId($row->typeId)
				->setUserId($row->userId)
				->setPriority($row->priority)
				->setITime($row->iTime)
				->setModId($row->modId)
				->setStatus($row->status);
			$users = new System_Models_UserMapper();
			$contactId = $users->getContactId($entry->getUserId());
			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findContactName($contactId);
			$modnames = new System_Models_ModnameMapper();
			$modNameCh = $modnames->getModNameCh($entry->getModId());
			$imptypes = new System_Models_ImptypeMapper();
			$typeName = $imptypes->getTypeName($entry->getTypeId());
			$entry->setContactId($contactId);
			$entry->setContactName($contactName);
			$entry->setTypeName($typeName);
			$entry->setModNameCh($modNameCh);
			$entries[] = $entry;
		}
		return $entries;*/
	}
	
	public function delete($id)
	{
		$this->getDbTable()->delete('imprId = ' . (int)$id);
	}
}
?>