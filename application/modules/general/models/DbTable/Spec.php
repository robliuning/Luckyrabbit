<?php
//updated in 23rd June by Rob

class General_Models_DbTable_Spec extends Zend_Db_Table_Abstract
{
	protected $_name = 'ge_specs';
	
	public function findSpecName($id)
	{
		$select = $this->select()
			->where('specId = ?',$id);
			
		$entries = $this->fetchAll($select);
		
		return $entries;
	}
}
?>