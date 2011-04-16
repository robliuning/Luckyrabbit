<?php
/*
author sunlin
date 2011.3.26
reviewd rob and lxj
add search()  by lincoy 4-16
date 2011.4.6
*/

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
    			->from('em_contacts',array('contactId','name'))
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
			elseif($condition == 'titleName')
			{
				$select->where('titleName like ?','%'.$key.'%');
				}
				elseif($condition == 'phoneNo')
				{
                   $select->where('phoneNo like ?','%'.$key.'%');				
				   }
					
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>