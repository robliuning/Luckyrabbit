<?php
  //creation date 15-04-2011
  //creating by lincoy
  //completion date 15-04-2011

class Material_Models_DbTable_Mtrplan extends Zend_Db_Table_Abstract
{
    protected $_name = 'mm_mtr_plan';
	
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