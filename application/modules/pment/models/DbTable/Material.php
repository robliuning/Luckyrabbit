<?php
//updated in 5th july by rob

class Pment_Models_DbTable_Material extends Zend_Db_Table_Abstract
{
	protected $_name = 'mm_materials';
	
	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'planId')
		{
			$select->where('planId = ?',$key);
			}
					
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>