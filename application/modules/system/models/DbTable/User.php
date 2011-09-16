<?php
//updated in 9th June by Rob

class System_Models_DbTable_User extends Zend_Db_Table_Abstract
{
	protected $_name = 'sy_users'; 

	public function getUserId($name)
	{
		$select = $this->select();
		$select->where('username = ?',$name);
		
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
	
	public function getUserIdById($contactId)
	{
		$select = $this->select();
		$select->where('contactId = ?',$contactId);
		
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
	
	public function search($key,$condition)
	{
		$select = $this->select();
		if($condition == "username")
		{
			$select->where("username like ?",'%'.$key.'%');
			}
		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
	
	public function fetchAllIds($groupId)
	{
		$select = $this->select();
		if($groupId != 0)
		{
			$select->where('groupId = ?',$groupId);
			}
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
	
	public function fetchAllJoin($key,$condition)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('su'=>'sy_users'))
						->join(array('ec'=>'em_contacts'),'ec.contactId = su.contactId',array('cName'=>'contactName'))
						->join(array('em'=>'em_contacts'),'em.contactId = su.creatorId',array('rName'=>'contactName'))
						->join(array('sy'=>'sy_usergroups'),'sy.groupId = su.groupId',array('groupName'));
		if($condition == "username")
		{
			$select->where("su.username like ?",'%'.$key.'%');
			}
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
		}
}
?>
