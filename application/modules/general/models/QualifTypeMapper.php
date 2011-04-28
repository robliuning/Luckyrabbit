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
    
    public function find($id,General_Models_Qualiftype $qualiftype)
    {
        $resultSet = $this->getDbTable()->find($id);

        if (0 == count($resultSet)) {

            return;
        }

        $row = $resultSet->current();

        $qualiftype  ->setTypeId($row->typeId)
                  ->setSerie($row->serie)
			      ->setName($row->name);	
    }
    
    public function findQualifSerie($id)
    {
    	$row = $this->getDbTable()->fetchRow('typeId ='. $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		$row = $row->toArray();
		$serie = $row['serie'];
		return $serie;
    }
}
?>
