<?php

/* create by lxj
   2011-03-28   v 1.1
 */

class General_Model_DbTable_Project extends Zend_Db_Table_Abstract
{
	protected $_name = 'em_cpps';

	public function getProject($projectId)
	{
		$projectId = (int)$projectId;
		$row = $this->fetchRow('projectId = ' . $projectId);
		if (!$row) {
			throw new Exception("Could not find row $projectId");
		}
		return $row->toArray();
	}

	public function addProject(
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
								$contactId,
								$postId,
								$projectId
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
			
			'contactId' => $contactId,
			'postId' => $postId,
			'projectId' => $projectId
		);
		$this->insert($data);
	}

	public function updateProject(
								$contactId,
								$postId,
								$projectId
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

			'contactId' => $contactId,
			'postId' => $postId,
			'projectId' => $projectId
		);
		$this->update($data, 'projectId = ' . (int)$projectId);
	}

	public function deleteProject($projectId)
	{
		$this->delete('projectId = ' . (int)$projectId);
	}
}

?>

