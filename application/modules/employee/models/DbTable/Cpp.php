<?php

/*create by lxj
  2011-03-28	v1.1
  rewrite by lxj
  2011-04-03	v0.2
  */

class Employee_Models_DbTable_Cpp extends Zend_Db_Table_Abstract
{
    protected $_name = 'em_cpp'; 
	protected $_primary = array('contactId','postId','projectId');

	public function getCpp($CppId)
	{
		$CppId = (int)$CppId;
		$row = $this->fetchRow('CppId = ' . $CppId);
		if (!$row) {
			throw new Exception("Could not find row $CppId");
		}
		return $row->toArray();
	}

	public function addCpp(
								$contactId,
								$postId,
								$projectId,
								$postCardId,
								$postType,
								$certId
								)
	{
		$data = array (
			'contactId' => $contactId,
			'postId' => $postId,
			'projectId' => $projectId,
			'postCardId' => $postCardId,
			'postType' => $postType,
			'certId' => $certId

		);
		$this->insert($data);
	}

	public function updateCpp(
								$contactId,
								$postId,
								$projectId,
								$postCardId,
								$postType,
								$certId
								)
	{
		$data = array (
			'contactId' => $contactId,
			'postId' => $postId,
			'projectId' => $projectId,
			'postCardId' => $postCardId,
			'postType' => $postType,
			'certId' => $certId
		);

		$where = array($contactId,$postId,$projectId);

		$this->update($data, $where);
	}

	public function deleteCpp($contactId,$postId,$projectId)
	{
		$where = array($contactId,$postId,$projectId);
		$this->delete($where);
	}
		
	public function populateCppDd($form)
  	{
  		$post=new General_Models_DbTable_Post();
		$postname = $post->fetchAll(); 
		$project=new Project_Models_DbTable_Project();
		$projectName = $project->fetchAll();

		foreach($postname as $op)
		{
			$form->getElement('postId')->addMultiOption($op->postId,$op->name);
			}
		foreach($projectName as $op)
		{
			$form->getElement('projectName')->addMultiOption($op->projectId,$op->name);
			}
  	}
	/*public function getAllCppByPid($projectId)
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from(array('e'=>'em_cpp'),array('contactId','postId','projectId','postCardId','postType','certId'))
			->join(array('g'=>'ge_posts'),'e.postId = g.postId')
			->where('e.projectId = ?',$projectId);

		$entries = $this->fetchall($select);
		return $entries;
	}*/

}

?>
