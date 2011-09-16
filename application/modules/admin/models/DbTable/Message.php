<?php
//updated in 13th June by Rob

class Admin_Models_DbTable_Message extends Zend_Db_Table_Abstract
{
	protected $_name = 'ad_messages'; 

	public function fetchAllJoin($key,$condition)
	{
		$select = $this->select()
					->setIntegrityCheck(false)
					->from(array('c'=>'em_contacts'),array('contactName'))
					->join(array('u'=>'sy_users'),'c.contactId = u.contactId')
					->join(array('a'=>'ad_messages'),'a.fromId = u.id');
		
		if($condition[1] != null)
		{
			if($condition[1] == 'username')
			{
				$select->where('c.contactName like ?','%'.$key.'%');
				}
				elseif($condition[1] == 'title')
				{
					$select->where('a.title like ?','%'.$key.'%');
					}
			}
		$select->where('a.toId = ?',$condition[0])
				->order('a.status');
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
	}
	
	public function fetchAllNews($toId)
	{
		$select = $this->select()
					->where('toId = ?',$toId)
					->where('status = 0');
		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
}
?>
