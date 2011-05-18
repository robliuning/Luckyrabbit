<?php
class Equipment_Models_DbTable_Eqpplan extends Zend_Db_Table_Abstract
{
    protected $_name = 'eq_eqp_plan';
	
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