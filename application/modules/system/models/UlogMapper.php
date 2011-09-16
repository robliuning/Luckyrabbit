<?php
//updated in 18th July by luoxinji

//functions
//save()
//fetchAllJoin()

class System_Models_UlogMapper
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
			$this->setDbTable('System_Models_DbTable_Ulog');
		}
		return $this->_dbTable;
	}

	public function save($userId,$logType)
	{
		$id = null;
		$cTime=date('Y-m-d,H:i');
		$data = array(
			'logId' => $id,
			'userId' => $userId,
			'logType' => $logType,
			'cTime' => $cTime
			);
		if (null === $id) {
			unset($data['logId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('logId = ?' => $id));
		}
	}
	
	public function find($logId,System_Models_Ulog $ulog)
	{
		$resultSet = $this->getDbTable()->find($logId);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$ulog->setLogId($row->logId)
				->setUserId($row->userId)
				->setLogType($row->logType)
				->setCTime($row->cTime);
	}

		
	public function fetchAllJoin($key = null,$condition = null)
	{
		$paginator = $this->getDbTable()->fetchAllJoin($key, $condition);
		return $paginator;
	}
}

?>