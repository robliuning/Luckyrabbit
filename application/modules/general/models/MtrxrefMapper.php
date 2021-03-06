<?php

/* create by lxj
   2011-04-06   v 0.2
 */

class General_Models_MtrxrefMapper
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
            $this->setDbTable('General_Models_DbTable_Mtrxref');
        }
        return $this->_dbTable;
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();

        foreach ($resultSet as $row) {

            $entry = new General_Models_Mtrxref();
			$entry->setParent($row->indexParent)
				     ->setChild($row->indexChild);
            $entries[] = $entry;
        }
        return $entries;
    }
}
?>
