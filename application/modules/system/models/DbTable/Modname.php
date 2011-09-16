<?php
//updated in 9th June by Rob

class System_Models_DbTable_Modname extends Zend_Db_Table_Abstract
{
	protected $_name = 'sy_modnames';
	
	public function getModId($modname)
	{
		$select = $this->select();
		$select->where('modName = ?',$modname);
		
		$result = $this->fetchRow($select);
		
		return $result;
	}

	public function getModNameCh($modId)
	{
		$select = $this->select();
		$select->where('modId = ?',$modId);
		
		$result = $this->fetchRow($select);
		
		return $result;
	}
}
?>
