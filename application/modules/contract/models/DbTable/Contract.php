<?php

/*create by lxj
  2011-04-04	v1.1
  */

class Contract_Models_DbTable_Contract extends Zend_Db_Table_Abstract
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
								$name,
								$artiPerson,
								$licenseNo,
								$busiField,
                                $otherContact, 
                                $address,
                                $remark
								)
	{
		$data = array (
			'name' => $name,
			'artiPerson' => $artiPerson,
			'licenseNo' => $licenseNO,
			'otherContact' => $otherContact,
			'address' => $address,
			'remark' => $remark
		);
		$this->insert($data);
	}

	public function updateContract(
								$contractorId,
								$name,
								$artiPerson,
								$licenseNo,
								$busiField,
                                $otherContact,
                                $address,
                                $remark
								)
	{
		$data = array (
			'contractorId' => $contractorId,
			'name' => $name,
			'artiPerson' => $artiPerson,
			'licenseNo' => $licenseNo,
			'busiField' => $busiField,
            'otherContact' => $otherContact,
            'address' => $address,
            'remark' => $remark
		);

		$this->update($data, 'contractId = '.(int)$contractorId);
	}

	public function deleteCpp($contractId)
	{
		$this->delete('contractId = '.(int)$contractorId);
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

}

?>
