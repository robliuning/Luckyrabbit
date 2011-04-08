<?php
  //creation date 04-04-2011
  //creating by lincoy
  //completion date  04-04-2011

class Project_Models_DbTable_Progress extends Zend_Db_Table_Abstract
{
    protected $_name = 'pm_progresses';

	public function getProgress($progressId)
	{
		$progressId = (int)$progressId;
		$row = $this->fetchRow('progressId = '.$progressId);
		if(!$row){
			throw new Exception("Could not find row $progressId");
		}
		return $row->toArray();
	}

	public function addProgress(
								 $projectId,
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
			'projectId' => $projectId,
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

	public function updateProgress(
		                         $progressId,
		                         $projectId,
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
			'projectId' => $projectId,
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
		$this->update($data,'progressId = '.(int)$progressId);
	}

	public function deleteProgress($progressId)
	{
		$this->delete('progressId = '.(int)$progressId);
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
	
	public function fetchAllStages($projectId) //check
	{
		$select = $this->select()
				->from('pm_progresses',array('stage'))
				->where('projectId = ?',$projectId);
		$entries = $this->fetchAll($select);
		return $entries;
		} 
}
?>
