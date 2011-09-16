<?php
//updated in 8th June 2011 by Rob

class Employee_Models_DbTable_Contact extends Zend_Db_Table_Abstract
{
	protected $_name = 'em_contacts';
	
	public function findContactName($id)
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from('em_contacts',array('contactName'))
			->where('contactId = ?',$id);
			
		$entries = $this->fetchAll($select);
		
		return $entries;
		}
			
	public function findContactNames($key)
	{
		$select = $this->select()
				->from('em_contacts',array('contactId','contactName','gender','titleName'))
				->where('contactName LIKE ?', '%'.$key.'%');
		
		$entries = $this->fetchAll($select);
		
		return $entries;
		}
		
	public function findRegisterNames($key)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('e'=>'em_contacts'),array('contactId','contactName','gender','titleName'))
						->join(array('u'=>'sy_users'),'e.contactId = u.contactId')
						->where('e.contactName LIKE ?', '%'.$key.'%');

		$entries = $this->fetchAll($select);
		
		return $entries;
		}

	public function fetchAllJoin($key,$condition)
	{
		$select = $this->select();
		$select->from('em_contacts',array('contactId','contactName','deptName','dutyName','birth','enroll','phoneMob','gender'));
		//$select->order('birth Desc');
		if($condition != null)
		{
			if($condition == 'name')
			{
				$select->where('contactName like ?','%'.$key.'%');
				}
				elseif($condition == 'phoneMob')
				{
					$select->where('phoneMob like ?','%'.$key.'%');
					}
					elseif($condition =='deptName')
					{
						$select->where('deptName like ?','%'.$key.'%');
						}
			}
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
	}
}
?>