<?php

class Employee_Models_DbTable_Employee extends Zend_Db_Table_Abstract
{
    protected $_name = 'em_employees';

	public function findArrayEmployee($id)
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from(array('c'=>'em_contacts'),array('name'))
			->join(array('e'=>'em_employees'),'e.empId = c.contactId')		
			->where('e.empId = ?',$id);
			
		$entries = $this->fetchAll($select);
		
		return $entries;
		}
	
	public function getEmployee($empId)
	{
		$empId = (int)$empId;
		$row = $this->fetchRow('empId = ' . $empId);
		if (!$row) {
			throw new Exception("Could not find row $empId");
		}
		return $row->toArray();
	}
		
	public function displayOne($id)
	{   		
		$select = $this->select()
			->setIntegrityCheck(false)
			->from(array('e'=>'em_employees'),array('empId','deptName','dutyName','status'))
			->join(array('c'=>'em_contacts'),'e.empId = c.contactId')
			->where('e.empId = ?',$id);
	
   		$entry = $this->fetchAll($select);
   		return $entry;
		}

	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'name')
		{
			$select->setIntegrityCheck(false)
						->from(array('c'=> 'em_contacts'),array('name'))
						->join(array('e'=>'em_employees'),'c.contactId = e.empId')
						->where('c.name like ?','%'.$key.'%');
			}
			elseif($condition == 'deptName')
			{
				$select->where('deptName like ?','%'.$key.'%');
				}
				elseif($condition == 'dutyName')
				{
                   $select->where('dutyName like ?','%'.$key.'%');				
				   }
					
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}

?>
