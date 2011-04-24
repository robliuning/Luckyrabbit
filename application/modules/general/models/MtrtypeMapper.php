<?php

/* create by rob
   2011-04-14
 */

class General_Models_MtrtypeMapper
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
            $this->setDbTable('General_Models_DbTable_Mtrtype');
        }
        return $this->_dbTable;
    }
    
    public function findTypeName($id) //check
	{
		$row = $this->getDbTable()->fetchRow('typeId = '.$id);
		
		if (!$row) {
			throw new Exception("Could not find row $postId");
		}
		
		$name = $row->name;
		
		return $name;
		}

    public function fetchAll() //check
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new General_Models_Mtrtype();
			$entry->setTypeId($row->typeId)
				  ->setName($row->name);
                  
            $entries[] = $entry;
        }
        return $entries;
    }
}
?>
