<?php

/*create by lxj
  2011-04-04	v1.1
  */

class Employee_Models_DbTable_Contract extends Zend_Db_Table_Abstract
{
    protected $_name = 'sc_contractors'; 

	public function getContract($ContractId)
	{
		$ContractId = (int)$ContractId;
		$row = $this->fetchRow('ContractId = ' . $ContractId);
		if (!$row) {
			throw new Exception("Could not find row $ContractId");
		}
		return $row->toArray();
	}

	public function addContract(
								$contractorId,
								$name,
								$artiPerson,
								$qualiSerie,
								$qualiGrade,
                                $licenseNo,

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
		
	public function displayOne($contactId,$postId,$projectId)
	{   		
		//$where = array($contactId,$postId,$projectId);
		//$select = $this->select()
		//	->setIntegrityCheck(false)
		//	->from(array('e'=>'em_cpp'),array('contactId','postId','projectId','postCardId','postType','certId'))
		//	->join(array('c'=>'em_contacts'),'e.contactId = c.contactId')
		//	->where($where);
		$cpp = Employee_Models_CppMapper();		
   		$entry = $cpp->fetchAll($projectId,"project");
   		return $entry;
		}
	public function populateCppDd($form)
  	{
  		$post=new General_Models_DbTable_Post();
		$postname = $post->fetchAll(); 
		$project=new Project_Models_DbTable_Project();
		$projectName = $project->fetchAll();

		foreach($postname as $op)
		{
			$form->getElement('postName')->addMultiOption($op->postId,$op->name);
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
