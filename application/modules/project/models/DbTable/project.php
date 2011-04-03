<?php
  //creation date 01-04-2011
  //creating by lincoy
  //completion date

class Project_Models_DbTable_Project extends Zend_Db_Table_Abstract
{
    protected $_name = 'pm_projects';
	
	public function getProject($projectId)
	{
		$projectId = int($projectId);
		$row = $this->fetchRow('projectId = '.$projectId);
		if(!$row){
			throw new Exception("Could not find row $projectId");
		}
		return $row->roArray();
	}

	public function addProject(
		                        $name,
		                        $address,
		                        $status,
		                        $structType,
		                        $level,
		                        $amount,
		                        $purpose,
		                        $constrArea,
		                        $staffNo,
		                        $remark
		                        )
	{
		$data = array(
			'name' => $name ,
			'address' => $address,
			'status' => $status,
			'structType' => $structType,
			'level' => $level,
			'amount' => $amount,
			'purpose' => $purpose,
			'constrArea' => $constrArea,
			'staffNo' => $staffNo,
			'remark' => $remark,
			);
		$this->insert($data);
	}

	public function updateProject(
		                        $projectId,
				                $name,
		                        $address,
		                        $status,
		                        $structType,
		                        $level,
		                        $amount,
		                        $purpose,
		                        $constrArea,
		                        $staffNo,
		                        $remark
		                      )
	{
		$data = array(
			'projectId' => $projectId,
			'name' => $name ,
			'address' => $address,
			'status' => $status,
			'structType' => $structType,
			'level' => $level,
			'amount' => $amount,
			'purpose' => $purpose,
			'constrArea' => $constrArea,
			'staffNo' => $staffNo,
			'remark' => $remark
			);
		$this->update($data,'projectId = '.(int)$projectId);
	}

	public function deleteProject($projectId)
	{
		$this->delete('projectId = '.(int)$projectId);
	}

	public function populateDb($form)         //Ìî³ästructype
	{
		$structTypes = new General_Models_DbTable_Structype();
		$options = $structTypes->fetchAll();
		foreach($options as $op)
		{
			$form->getElement('name')->addMultiOption($op->structTypesId,$op->name);
			}
	}
}

