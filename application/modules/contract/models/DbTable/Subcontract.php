<?php

/*create by lxj
  date 2011.3.28
  rewrite by lxj rob
  date 2011.4.7
  rewrite by lxj
  date 2011-04-08  v 0.2
  */

class Contract_Models_DbTable_Subcontract extends Zend_Db_Table_Abstract
{
    protected $_name = 'sc_subcontracts'; 

	public function findArraySubcontract($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('scontrId = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}
}
?>
