<?php

/* create by lxj
   2011-04-08   v 0.2
   rewrite by lxj
   2011-04-09   v 0.2
   */

class Contract_Models_DbTable_Contrqualif extends Zend_Db_Table_Abstract
{
    protected $_name = 'sc_contr_qualif'; 

	public function findArrayContrqualif($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('cqId = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}
	
	public function fetchAllContrqualifs($id)
	{
		$select = $this->select()
			->where("contractorId = ?",$contractorId);
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}

?>
