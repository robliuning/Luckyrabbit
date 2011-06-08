<?php
//Updated on 31th May by Rob

class Pment_Models_DbTable_Seal extends Zend_Db_Table_Abstract
{
	protected $_name = 'pm_seals';

	public function search($key,$condition)
	{
		$select = $this->select();
		if($condition[1] != null)
		{
			if($condition[1] == 'name')
			{
				$select->where('name like ?','%'.$key.'%')
						->where('projectId = ?',$condition[0]);
				}
				elseif($condition[1] == 'date')
				{
 						$select->where('seaDate = ?',$key)
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