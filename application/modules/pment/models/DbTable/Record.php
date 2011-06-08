<?php
//Updated on 31th May by Rob

class Pment_Models_DbTable_Record extends Zend_Db_Table_Abstract
{
	protected $_name = 'pm_records';

	public function search($key,$condition)
	{
		$select = $this->select();
		if($condition[1] != null)
		{
			if($condition[1] == 'recUnit')
			{
				$select->where('recUnit like ?','%'.$key.'%')
						->where('projectId = ?',$condition[0]);
				}
				elseif($condition[1] == 'date')
				{
 						$select->where('recDate = ?',$key)
						->where('projectId = ?',$condition[0]);
					}
					elseif($condition[1] == 'recNumber')
					{
 						$select->where('recNumber = ?',$key)
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