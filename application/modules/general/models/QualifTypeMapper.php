<?php
/* create by lxj
   2011-04-06  v 0.2
   rewrite by lxj
   2011-04-09  v 0.2
 */

class General_Models_QualiftypeMapper
{
	protected $_dbtable;
	
    public function setDbtable($dbtable)
    {
        if (is_string($dbtable)) {
            $dbtable = new $dbtable();
        }
        if (!$dbtable instanceof Zend_Db_table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbtable = $dbtable;
        return $this;
    }

    public function getDbtable()
    {
        if (null === $this->_dbtable) {
            $this->setDbtable('General_Models_Dbtable_Qualiftype');
        }
        return $this->_dbtable;
    }

    public function fetchAllBySerie($serie) //check
    {
		$resultSet  = $this->getDbtable()->fetchAllBySerie($serie);

        $entries   = array();
        
        foreach ($resultSet as $row) {
            $entry = new General_Models_Qualiftype();
            $entry->setTypeId($row->typeId);
			$entry->setName($row->name);
                  
            $entries[] = $entry;
        }
        return $entries;
    }
}
?>
