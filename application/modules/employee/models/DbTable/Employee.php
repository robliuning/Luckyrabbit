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

	public function addEmployee(
								$empId,
								$deptName,
								$dutyName,
								$status
								)
	{
		$data = array (
			'empId' => $empId,
			'deptName' => $deptName,
			'dutyName' => $dutyName,
			'status' => $status
		);
		$this->insert($data);
	}

	public function updateEmployee(
								$empId,
								$deptName,
								$dutyName,
								$status
								)
	{
		$data = array (
			'empId' => $empId,
			'deptName' => $deptName,
			'dutyName' => $dutyName,
			'status' => $status
		);
		$this->update($data, 'empId = ' . (int)$empId);
	}

	public function deleteEmployee($empId)
	{
		$this->delete('empId = ' . (int)$empId);
	}
	
	public function fetchAllJoin() //check
	{
		$select = $this->select()
			->setIntegrityCheck(false)	
			->from(array('e'=>'em_employees'),array('empId','deptName','dutyName','status'))
			->join(array('c'=>'em_contacts'),'e.empId = c.contactId');
		$entries = $this->fetchAll($select);
		return $entries;
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
}

?>
