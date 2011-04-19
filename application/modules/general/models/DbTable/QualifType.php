<?php

class General_Models_DbTable_QualifType extends Zend_Db_Table_Abstract
{
    protected $_name = 'ge_qualiftypes';

	public function deleteEmployee($empId)
	{
		$this->delete('empId = ' . (int)$empId);
	}
	
	public function fetchAllBySerie($serie) //check
	{
		$select = $this->select()
			->setIntegrityCheck(false)	
			->from('ge_qualiftypes',array('typeId','name'))
			->where('serie = ?',$serie);
		$entries = $this->fetchAll($select);
		return $entries;
		}
}
?>
