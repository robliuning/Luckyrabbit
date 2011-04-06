<?php

/*create by lxj
  2011-04-04	v1.1
  */

class Contract_Models_DbTable_Contract extends Zend_Db_Table_Abstract
{
    protected $_name = 'sc_contr_qualif'; 

	public function getContract($cpId)
	{
		$cpId = (int)$cpId;
		$row = $this->fetchRow('cpId = ' . $cpId);
		if (!$row) {
			throw new Exception("Could not find row $cpId");
		}
		return $row->toArray();
	}

	public function addContract(
								$contractorId,
								$qualifSerie,
								$qualifType,
								$qualifGrade
								)
	{
		$data = array (
			'contractorId' => $contractorId,
			'qualifSerie' => $qualifSerie,
			'qualifType' => $qualifType,
			'qualifGrade' => $qualifGrade
		);
		$this->insert($data);
	}

	public function updateContract(
								$cpId,
								$contractorId,
								$qualifSerie,
								$qualifType,
								$qualifGrade,
								)
	{
		$data = array (
			'cpId' => $cpId,
			'contractorId' => $contractorId,
			'qualifSerie' => $qualifSerie,
			'qualifType' => $qualifType,
			'qualifGrade' => $qualifGrade
		);

		$this->update($data, 'cpId = '.(int)$cpId);
	}

	public function deleteCpp($cpId)
	{
		$this->delete('cpId = '.(int)$cpId);
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
