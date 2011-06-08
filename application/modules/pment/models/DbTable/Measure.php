<?php
//Updated on 31th May by Rob

class Pment_Models_DbTable_Measure extends Zend_Db_Table_Abstract
{
	protected $_name = 'pm_measures';

	public function search($key,$condition)
	{
		$select = $this->select();
		if($condition[1] != null)
		{
			if($condition[1] == 'date')
			{
 				$select->where('meaDate = ?',$key)
				->where('projectId = ?',$condition[0]);
				}
			}
			else
			{
				$select->where('projectId = ?',$condition[0]);
				}
		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
}
?>