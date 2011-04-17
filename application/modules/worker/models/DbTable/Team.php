<?php

class Worker_Models_DbTable_Team extends Zend_Db_Table_Abstract
{
    protected $_name = 'wm_teams';

	public function findArrayTeam($id)
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from(array('c'=>'em_contacts'),array('name'))
			->join(array('w'=>'wm_teams'),'c.contactId = w.contactId')		
			->where('w.contactId = ?',$id);
			
		$entries = $this->fetchAll($select);
		
		return $entries;
		}
	
	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'name')
		{
			$select->where('name like ?','%'.$key.'%');
			}
			elseif($condition == 'contactName')
			{
				$select->setIntegrityCheck(false)
					->from(array('c'=>'em_contacts'),array('name'))
			        ->join(array('w'=>'wm_teams'),'c.contactId = w.contactId')		
			        ->where('c.name like ?','%'.$key.'%');
				}
				
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>