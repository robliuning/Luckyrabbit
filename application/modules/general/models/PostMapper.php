<?php
//updated in 9th June by rob

class General_Models_PostMapper
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
			$this->setDbTable('General_Models_DbTable_Post');
		}
		return $this->_dbTable;
	}
	
	public function findPostName($id) //check
	{
		$row = $this->getDbTable()->fetchRow('postId = '.$id);
		
		if (!$row) {
			throw new Exception("Could not find row $postId");
		}
		
		$post = array();
		$post['name'] = $row->name;
		$post['detail'] = $row->detail;
		
		return $post;
		}

	public function fetchAll() //check
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$entries   = array();
		foreach ($resultSet as $row) {
			$entry = new General_Models_Post();
			$entry->setPostId($row->postId)
					->setName($row->name);

			$entries[] = $entry;
		}
		return $entries;
	}
}
?>
