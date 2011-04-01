<?php

class Employee_Models_DbTable_Employee extends Zend_Db_Table_Abstract
{
    protected $_name = 'em_employees';

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
							/*	$name,
								$gender,
								$age,
								$deptName,
								$dutyName,
								$titleName,
								$idCard,
								$phone,
								$otherContact,
								$address,
								$status,
								$remark*/
								$empId,
								$deptName,
								$dutyName,
								$titleName,
								$status
								)
	{
		$data = array (
			/*'name' => $name,
			'gender' => $gender,
			'age' => $age,
			'deptName' => $deptName,
			'dutyName' => $dutyName,
			'titleName' => $titleName,
			'idCard' => $idCard,
			'phone' => $phone,
			'otherContact' => $otherContact,
			'address' => $address,
			'status' => $status,
			'remark' => $remark,*/
			
			'empId' => $empId,
			'deptName' => $deptName,
			'dutyName' => $dutyName,
			'titleName' => $titleName,
			'status' => $status
		);
		$this->insert($data);
	}

	public function updateEmployee(
								$empId,
								$deptName,
								$dutyName,
								$titleName,
								$status
								)
	{
		$data = array (
			/*'name' => $name,
			'gender' => $gender,
			'age' => $age,
			'deptName' => $deptName,
			'dutyName' => $dutyName,
			'titleName' => $titleName,
			'idCard' => $idCard,
			'phone' => $phone,
			'otherContact' => $otherContact,
			'address' => $address,
			'status' => $status,
			'remark' => $remark,*/

			'empId' => $empId,
			'deptName' => $deptName,
			'dutyName' => $dutyName,
			'titleName' => $titleName,
			'status' => $status
		);
		$this->update($data, 'empId = ' . (int)$empId);
	}

	public function deleteEmployee($empId)
	{
		$this->delete('empId = ' . (int)$empId);
	}
	
	public function displayAll()
	{
		$select = $this->select()
			->setIntegrityCheck(false)	
			->from(array('e'=>'em_employees'),array('empId','deptName','dutyName','titleName','status'))
			->join(array('c'=>'em_contacts'),'e.empId = c.contactId');
		$entries = $this->fetchAll($select);
		return $entries;
		}
		
	public function displayOne($empId)
	{   		
		$select = $this->select()
			->setIntegrityCheck(false)
			->from(array('e'=>'em_employees'),array('empId','deptName','dutyName','titleName','status'))
			->join(array('c'=>'em_contacts'),'e.empId = c.contactId')
			->where('e.empId = ?',$empId);
	
   		$entry = $this->fetchAll($select);
   		return $entry;
		}
	public function populateEmployeeDd($form)
  	{
  		$dept=new General_Models_DbTable_Dept();
		$deptOptions = $dept->fetchAll(); 
		$duty=new General_Models_DbTable_Duty();
		$dutyOptions = $duty->fetchAll();
		$title=new General_Models_DbTable_Title();
		$titleOptions = $title->fetchAll();
		foreach($deptOptions as $op)
		{
			$form->getElement('deptName')->addMultiOption($op->name,$op->name);
			}
		foreach($dutyOptions as $op)
		{
			$form->getElement('dutyName')->addMultiOption($op->name,$op->name);
			}
		foreach($titleOptions as $op)
		{
			$form->getElement('titleName')->addMultiOption($op->name,$op->name);
			}	
  	}
}

?>
