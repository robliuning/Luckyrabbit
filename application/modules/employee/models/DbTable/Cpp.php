<?php

class Employee_Models_DbTable_Cpp extends Zend_Db_Table_Abstract
{
    protected $_name = 'em_cpp';

	public function getCpp($empId)
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
		
	public function displayOne($empId)
	{   		
		$select = $this->select()
			->setIntegrityCheck(false)
			->from(array('e'=>'em_employees'),array('empId','deptName','dutyName','status'))
			->join(array('c'=>'em_contacts'),'e.empId = c.contactId')
			->where('e.empId = ?',$empId);
	
   		$entry = $this->fetchAll($select);
   		return $entry;
		}
	public function populateCppDd($form)
  	{
  		$dept=new General_Models_DbTable_Dept();
		$deptOptions = $dept->fetchAll(); 
		$duty=new General_Models_DbTable_Duty();
		$dutyOptions = $duty->fetchAll();

		foreach($deptOptions as $op)
		{
			$form->getElement('deptName')->addMultiOption($op->name,$op->name);
			}
		foreach($dutyOptions as $op)
		{
			$form->getElement('dutyName')->addMultiOption($op->name,$op->name);
			}
  	}
}

?>
