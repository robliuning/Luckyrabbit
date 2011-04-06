<?php

/* create by lxj
   2011-04-06  v 0.2
 */

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
            $this->setDbTable('General_Model_DbTable_Post');
        }
        return $this->_dbTable;
    }

    public function fetchAll()
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

	public function FindPostByName($postname)
	{
			$post = new General_Model_Dbtable_post();
			$where = $postname;
			$row = $post->fetchRow(
			$where,
			null
			);
			return $row;
	}

}
?>
