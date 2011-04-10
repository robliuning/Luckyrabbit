<?php

/* create by lxj
   2011-04-08   v 0.2
   rewrite by lxj
   2011-04-09   v 0.2
   */

class Contract_Models_DbTable_Contrqualif extends Zend_Db_Table_Abstract
{
    protected $_name = 'sc_contr_qualif'; 

	public function findArrayContrQualif($cqId)
	{
		$cqId = (int)$cqId;
		$row = $this->fetchRow('cqId = ' . $cqId);
		if (!$row) {
			throw new Exception("Could not find row $cqId");
		}
		return $row->toArray();
	}

}

?>
