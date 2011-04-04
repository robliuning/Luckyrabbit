<?php
  //creation date 04-04-2011
  //creating by lincoy
  //completion date  04-04-2011

class Project_Models_DbTable_Progress extends Zend_Db_Table_Abstract
{
    protected $_name = 'pm_progresses';

	public function getProgress($projectId)
	{
		$projectId = (int)$projectId;
		$row = $this->fetchRow('projectId = '.$projectId);
		if(!$row){
			throw new Exception("Could not find row $projectId");
		}
		return $row->toArray();
	}

	public function addProgress(
		                         $stage,
								 $task,
								 $startDateExp,
		                         $endDateExp,
		                         $periodExp,
		                         $endDateAct,
		                         $periodAct,
		                         $quality,
		                         $remark
		                         )
	{
		$data = array(
			'stage' => $stage,
			'task' => $task,
			'startDateExp' => $startDateExp,
			'endDateExp' => $endDateExp,
			'periodExp' => $periodExp,
			'endDateAct' => $endDateAct,
			'periodAct' => $periodAct,
			'quality' => $quality,
			'remark' => $remark
			);
		$this->insert($data);
	}

	public function updatePregress(
		                         //$projectId,
		                         //$stage,
								 $task,
								 $startDateExp,
		                         $endDateExp,
		                         $periodExp,
		                         $endDateAct,
		                         $periodAct,
		                         $quality,
		                         $remark
		                         )
	{
		$data = array(
			//'projectId' => $projectId,
			//'stage' => $stage,
			'task' => $task,
			'startDateExp' => $startDateExp,
			'endDateExp' => $endDateExp,
			'periodExp' => $periodExp,
			'endDateAct' => $endDateAct,
			'periodAct' => $periodAct,
			'quality' => $quality,
			'remark' => $remark
			);
		$this->update($data,'projectId = '.(int)$projectId);
	}

	public function deleteProgress($projectId)
	{
		$this->delete('projectId = '.(int)$projectId);
	}

	public function populateDd($form)         //填充project name
	{
		$project = new Project_Models_DbTable_Project();
		$options = $project->fetchAll();
		foreach($options as $op)
		{
			$form->getElement('projectId')->addMultiOption($op->projectId,$op->name);
			}
	} 
}
?>
