<?php

class Application_Model_DbTable_Employee extends Zend_Db_Table_Abstract
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
								$status,
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
			'titlesName' => $titleName,
			'status' => $status,
		);
		$this->insert($data);
	}

	public function updateEmployee(
								$empId,
								$deptName,
								$dutyName,
								$titleName,
								$status,
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
			'status' => $status,
		);
		$this->update($data, 'empId = ' . (int)$empId);
	}

	public function deleteEmployee($empId)
	{
		$this->delete('empId = ' . (int)$empId);
	}
}

?>
