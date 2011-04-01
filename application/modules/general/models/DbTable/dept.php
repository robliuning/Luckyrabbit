<?php

/* create by lxj
   2011-03-28   v 1.1
 */

class General_Models_DbTable_Dept extends Zend_Db_Table_Abstract
{
	protected $_name = 'ge_depts';

	public function getDept($deptId)
	{
		$deptId= (int)$deptId;
		$row = $this->fetchRow('deptId = ' . $deptId);
		if (!$row) {
			throw new Exception("Could not find row $deptId");
		}
		return $row->toArray();
	}

	public function addDept(
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
								$postId,
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
			
			'postId' => $postId,
			'name' => $name
		);
		$this->insert($data);
	}

	public function updateDept(
								$postId,
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

			'postId' => $postId,
			'name' => $name
		);
		$this->update($data, 'deptId = ' . (int)$deptId);
	}

	public function deleteDept($deptId)
	{
		$this->delete('deptId = ' . (int)$deptId);
	}
}

?>