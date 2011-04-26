<?php

/*create by lxj
  2011-04-04	v1.1
  rewrite by lxj
  modify by lincoy  04-16
  2011-04-08   v0.2
  */

class Contract_Models_DbTable_Contractor extends Zend_Db_Table_Abstract
{
    protected $_name = 'sc_contractors'; 

	public function findArrayContract($contractorId)
	{
		$contractorId = (int)$contractorId;
		$row = $this->fetchRow('contractorId = ' . $contractorId);
		if (!$row) {
			throw new Exception("Could not find row $contractorId");
		}
		return $row->toArray();
	}

	public function Search($key, $condition)
	{
		$select = $this->select();
		if($condition == "name")
		{
			$select->where("name like ?","%$key%");
			}
		elseif($condition == "artiPerson")
		{
			$select->where("artiPerson like ?","%$key%");
			}

    	$resultSet = $this->fetchAll($select);
		return $resultSet;
	}

}

?>
