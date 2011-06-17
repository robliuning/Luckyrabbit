<?php
//updated in 9th June by Rob

class Pment_Models_DbTable_Cp extends Zend_Db_Table_Abstract
{
	protected $_name = 'sc_contr_proj'; 

	public function search($key,$condition)
	{
		$select = $this->select();
		if($condition == 'projectId')
		{
			$select->where('projectId = ?',$key);
			}
		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
	
	public function checkRe($projectId,$contractorId)
	{
		$select = $this->select();
		$select->where('projectId = ?',$projectId)
				->where('contractorId = ?',$contractorId);
		$row = $this->fetchRow($select);
		$checkRe = true;
		if($row == null)
		{
			$checkRe = false;
			}
		return $checkRe;
	}
}
?>
