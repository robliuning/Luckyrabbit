<?php

/* create by lxj
   2011-03-28   v 1.1
 */

class Application_Model_DbTable_Post extends Zend_Db_Table_Abstract
{
    protected $_name = 'ge_post';

	public function getPost($postId)
	{
		$postId = (int)$postId;
		$row = $this->fetchRow('postId = ' . $postId);
		if (!$row) {
			throw new Exception("Could not find row $postId");
		}
		return $row->toArray();
	}

	public function addPost(
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
								$name,
								$type,
								$cardId,
								$certId,
								$remark
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
			'name' => $name,
			'type' => $type,
			'cardId' => $cardId,
			'certId' => $certId,
			'remark' => $remark
		);
		$this->insert($data);
	}

	public function updatePost(
								$postId,
								$name,
								$type,
								$cardId,
								$certId,
								$remark
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
			'name' => $name,
			'type' => $type,
			'cardId' => $cardId,
			'certId' => $certId,
			'remark' => $remark
		);
		$this->update($data, 'postId = ' . (int)$postId);
	}

	public function deletePost($postId)
	{
		$this->delete('postId = ' . (int)$postId);
	}
}

?>
