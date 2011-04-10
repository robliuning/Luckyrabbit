<?php
/* create by lxj
   2011-04-06  v 0.2
   rewrite by lxj
   2011-04-09  v 0.2
 */

class General_Models_QualifTypeMapper
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
            $this->setDbTable('General_Models_DbTable_QualifType');
        }
        return $this->_dbTable;
    }

    public function fetchAllBySerie($key) //check
    {
		if($key == null)
		{
			$resultSet  = $this->getDbTable()->fetchAll();
			}
			else
			{	
				$resultSet  = $this->getDbTable->fetchAllBySerie($key);
				}
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new General_Models_QualifType();
			$entry->setName($row->name);
                  
            $entries[] = $entry;
        }
        return $entries;
    }
}
?>
