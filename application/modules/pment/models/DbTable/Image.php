<?php
//Updated on 24th May by Rob

class Pment_Models_DbTable_Image extends Zend_Db_Table_Abstract
{
	protected $_name = 'pm_images';
	
	public function search($key,$condition)
	{
		$select = $this->select();
		if($condition[1] != null)
		{
			if($condition[1] == 'mon')
			{
				$select->where('prgType = ?',$condition[1])
						->where('prgId = ?',$key)
						->where('projectId = ?',$condition[0]);
				}
				elseif($condition[1] == 'wk')
				{
				$select->where('prgType = ?',$condition[1])
						->where('prgId = ?',$key)
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