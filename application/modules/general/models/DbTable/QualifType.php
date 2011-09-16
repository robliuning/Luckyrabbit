<?php

class General_Models_DbTable_QualifType extends Zend_Db_Table_Abstract
{
	protected $_name = 'ge_qualiftypes';
	
	public function fetchAllBySerie($serie)
	{
		$select = $this->select();
		$select->where('serie = ?',$serie);
		$entries = $this->fetchAll($select);
		return $entries;
		}
}
?>
