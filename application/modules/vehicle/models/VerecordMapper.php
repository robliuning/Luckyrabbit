<?php
  //creation date 09-04-2011
  //creating by lincoy
  //completion date 09-09-2011

class Vehicle_Models_VerecordMapper
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
           $this->setDbTable('Vehicle_Models_DbTable_Verecord');
        }
        return $this->_dbTable;
    }
?>