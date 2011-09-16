<?php
//updated in 9th June by Rob

class System_Models_DbTable_Authority extends Zend_Db_Table_Abstract
{
	protected $_name = 'sy_usergroup_privs';

	public function checkAuth($groupId,$modId)
	{
		$select = $this->select();
		$select->where('groupId = ?',$groupId)
				->where('modId = ?',$modId);
		$result = $this->fetchrow($select);
		
		return $result;
	}
}
?>
