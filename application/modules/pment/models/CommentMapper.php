<?php
//Updated on 30th May by Rob

class Pment_Models_CommentMapper
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
			$this->setDbTable('Pment_Models_DbTable_Comment');
		}
		return $this->_dbTable;
	}
	public function save(Pment_Models_Comment $comment)
	{
		$data = array(
			'cId' => $comment->getCId(),
			'mtrId' => $comment->getMtrId(),
			'addDate' => $comment->getAddDate(),
			'comment' => $comment->getComment(),
			'contactId' => $comment->getContactId()
			);
		if (null === ($id = $comment->getCId())) {
			unset($data['cId']);
			$id = $this->getDbTable()->insert($data);
			return $id;
		} else {
			$this->getDbTable()->update($data, array('cId = ?' => $comment->getCId()));
		}
	}
	
	public function fetchAllComments($mtrId)
	{
		$resultSet = $this->getDbTable()->fetchAllComments($mtrId);
		
		$arrayComments = null;
		foreach ($resultSet as $row)
		{
			$comment['contactId'] = $row->contactId;
			$comment['contactName'] = $row->contactName;
			$comment['addDate'] = $row->addDate;
			$comment['comment'] = $row->comment;
			$comment['cId'] = $row->cId;
			$arrayComments[] = $comment;
			}
		return $arrayComments;
	}

	public function delete($id)
	{
		$this->getDbTable()->delete('cId = ' . (int)$id);
	}
}
?>