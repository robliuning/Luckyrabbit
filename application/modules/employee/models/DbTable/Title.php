<?php

/* create by lxj
   2011-03-28   v 1.1
 */

class Application_Model_DbTable_Title extends Zend_Db_Table_Abstract
{
	protected $_name = 'ge_title';

	public function getTitle($titleId)
	{
		$titleId = (int)$titleId;
		$row = $this->fetchRow('titleId = ' . $titleId);
		if (!$row) {
			throw new Exception("Could not find row $");
		}
		return $row->toArray();
	}

	public function addTitle(
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
								$titleId,
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
			
			'titleId' => $titleId,
			'name' => $name
		);
		$this->insert($data);
	}

	public function updateTitle(
								$titleId,
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

			'titleId' => $titleId,
			'name' => $name
		);
		$this->update($data, 'titleId = ' . (int)$titleId);
	}

	public function deleteTitle($titleId)
	{
		$this->delete('titleId = ' . (int)$titleId);
	}
}

?>
}

?>
