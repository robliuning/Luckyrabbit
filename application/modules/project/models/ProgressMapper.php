<?php
  //creation date 03-4-2011
  //creating by lincoy
  //completion date 04-04-2011

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
        $data = array(
			'projectId' => $progress->getProjectId(),
            'stage' => $progress->getStage() ,
			'task' => $progress->getTask(),
			'startDateExp' => $progress->getStarDateExp(),
			'endDateExp' => $progress->getEndDateExp(),
			'periodExp' => $progress->getPeriodExp(),
			'endDateAct' => $progress->getEndDateAct(),
			'periodAct' => $progress->getPeriodAct(),
			'quality' => $progress->getQuality(),
			'remark' => $progress->getRemark(),
			'cTime' => $progress->getCTime()
        );
        if (null === ($id = $project->getProjectId())) {
            unset($data['projectId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('projectId = ?' => $projectId));
        }
    }

    public function find($projectId)
    {
		$progress = new Project_Models_Progress();
        $result = $this->getDbTable()->find($projectId);

        if (0 == count($result)) {

            return;
        }

        $row = $result->current();

        $progress  ->setProjectId($row->projectId)
                  ->setStage($row->stage)
			      ->setTask($row->task)
				  ->setStartDateExp($row->startDateExp)
			      ->setEndDateExp($row->endDateExp)
			      ->setPeriodExp($row->periodExp)
			      ->setEndDateAct($row->endDateAct)
			      ->setPeriodAct($row->PeriodAct)
                  ->setQuality($row->quality)
				  ->setRemark($row->remark)
				  ->setCTime($row->cTime);
		return $progress;
    }

	public function fetchInfo($projectId)  //获得progress 中的stage, task, endDateAct, quality
	{
		$select = $this->getDbTable()->select();
		$select->where('projectId = ?',$projectId);
		$resultSet = $this->getDbTable()->fetchAll($select);
		$entries = array();
		foreach($resultSet as $row){
			$entry = new Project_Models_Progress();
			$entry ->setStage($row->stage)
				   ->setTask($row->task)
				   ->setEndDateAct($row->endDateAct)
				   ->setQuality($row->quality);

			$entries[] = $entry;
		}
		return $entries;
	}
}
?>