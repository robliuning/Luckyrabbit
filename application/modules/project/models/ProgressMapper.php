<?php
//updated on 24th May by Rob

class Project_Models_ProgressMapper
{
	protected $_dbTable;

	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}
	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->setDbTable('Project_Models_DbTable_Progress');
		}
		return $this->_dbTable;
	}
	
	public function save(Project_Models_Progress $progress)
	{
	/*	$endExp = explode("-",$progress->getEndDateExp());
		$unix_endExp = mktime(0, 0, 0, $endExp[2], $endExp[1], $endExp[0]);
		$start = explode("-",$progress->getStartDate());
		$unix_start = mktime(0, 0, 0, $start[2], $start[1], $start[0]);

		$periodExp = ($unix_endExp - $unix_start)/ 86400; 
		$periodAct = null;
		if($progress->getEndDateAct() != null)
		{
			$endAct = explode("-",$progress->getEndDateAct());
			$unix_endAct = mktime(0, 0, 0, $endAct[2], $endAct[1], $endAct[0]);
			$periodAct = ($unix_endAct - $unix_start)/ 86400;;
			}*/
			
		$data = array(
			'projectId' => $progress->getProjectId(),
			'stage' => $progress->getStage() ,
			'task' => $progress->getTask(),
			'startDate' => $progress->getStartDate(),
			'endDateExp' => $progress->getEndDateExp(),
			//'periodExp' => $periodExp,
			'endDateAct' => $progress->getEndDateAct(),
			//'periodAct' => $periodAct,
			'quality' => $progress->getQuality(),
			'remark' => $progress->getRemark()
		);
		if (null === ($id = $progress->getProgressId())) {
			unset($data['progressId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('progressId = ?' => $progress->getProgressId()));
		}
	}

	public function find($id,Project_Models_Progress $progress)
	{
		$result = $this->getDbTable()->find($id);

		if (0 == count($result)) {

			return;
		}

		$row = $result->current();

		$progress  ->setProjectId($row->projectId)
  				->setStage($row->stage)
			  	->setTask($row->task)
				  ->setStartDate($row->startDate)
			  	->setEndDateExp($row->endDateExp)
			  	->setPeriodExp($row->periodExp)
			  	->setEndDateAct($row->endDateAct)
			  	->setPeriodAct($row->periodAct)
  				->setQuality($row->quality)
				  ->setRemark($row->remark)
				  ->setCTime($row->cTime);
		$qualityCh = $this->assignQualityCh($progress->getQuality());
		$progress->setQualityCh($qualityCh);
	}

	public function findArrayProgress($id)
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('progressId = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}
		
	public function fetchAllStages($projectId) 
	{
		$entries = $this->getDbTable()->fetchAllStages($projectId);
		return $entries;
	}
	
	public function fetchAllJoin($key = null,$condition = null) //check
	{
		if($condition == null)
		{
			$resultSet = $this->getDbTable()->fetchAll();
			}
			else
			{
				$resultSet = $this->getDbTable()->search($key,$condition);
				}
   		
   		$progresses = array();
   		
   		foreach($resultSet as $row){
   			$progress = new Project_Models_Progress();
			$progress ->setProgressId($row->progressId)
						->setProjectId($row->projectId)
   						->setStage($row->stage)
						->setStartDate($row->startDate)
				   		->setEndDateExp($row->endDateExp)
						->setEndDateAct($row->endDateAct)
						->setQuality($row->quality);
			$qualityCh = $this->assignQualityCh($progress->getQuality());
			$progress->setQualityCh($qualityCh);
				
			$progresses[] = $progress;
   			}
		return $progresses;
		}
	
	public function populateProgressDd($form) //check
	{
		$projects = new Project_Models_ProjectMapper();
		$arrayProjects = $projects->fetchAllNames();
		foreach($arrayProjects as $project)
		{
			$form->getElement('projectId')->addMultiOption($project->getProjectId(),$project->getName());
			}
		}
	
	public function assignQualityCh($quality)
	{
		$qualityCh = null;
		if($quality == 0)
		{
			$qualityCh = "不合格";
			}
			elseif($quality == 1)
			{
 				$qualityCh = "合格";
				}
				elseif($quality == 2)
				{
					$qualityCh = "良好";
					}
					elseif($quality == 3)
					{
						$qualityCh = "优秀";					
						}
		return $qualityCh;   
	} 
}
?>