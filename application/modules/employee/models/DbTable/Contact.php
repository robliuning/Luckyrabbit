<?php
//updated in 8th June 2011 by Rob

class Employee_Models_DbTable_Contact extends Zend_Db_Table_Abstract
{
	protected $_name = 'em_contacts';
	
	public function findContactName($id)
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from('em_contacts',array('name'))
			->where('contactId = ?',$id);
			
		$entries = $this->fetchAll($select);
		
		return $entries;
		}
			
	public function findContactNames($key)
	{
		$select = $this->select()
				->from('em_contacts',array('contactId','name','gender','titleName'))
				->where('name LIKE ?', '%'.$key.'%');
		
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
			elseif($condition == 'phoneHome')
			{
				$select->where('phoneHome like ?','%'.$key.'%');
				}
				elseif($condition == 'phoneMob')
				{
					$select->where('phoneMob like ?','%'.$key.'%');
					}
					elseif($condition == 'deptName')
					{
						$select->where('deptName like ?','%'.$key.'%');
						}
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>