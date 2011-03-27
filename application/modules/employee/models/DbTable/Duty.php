<?php

/* create by lxj
   2011-03-28   v 1.1
 */

class Application_Model_DbTable_Duty extends Zend_Db_Table_Abstract
{
	protected $_name = 'ge_duty';

	public function getDuty($dutyId)
	{
		$dutyId = (int)$dutyId;
		$row = $this->fetchRow('duytId = ' . $dutyId);
		if (!$row) {
			throw new Exception("Could not find row $dutyId");
		}
		return $row->toArray();
	}

	public function addDuty(
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
								$dutyId,
								$name
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
			
			'dutyId' => $dutyId,
			'name' => $name
		);
		$this->insert($data);
	}

	public function updateDuty(
								$dutyId,
								$name
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

			'dutyId' => $dutyId,
			'name' => $name
		);
		$this->update($data, 'dutyId = ' . (int)$dutyId);
	}

	public function deleteDuty($dutyId)
	{
		$this->delete('dutyId = ' . (int)$dutyId);
	}
}

?>
}

?>
