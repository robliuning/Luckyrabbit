<?php
  //creation date 01-04-2011
  //creating by lincoy
  //completion date 01-04-2011

class Project_Models_Progress
{
	protected $_projectId;	
	protected $_stage;
	protected $_task;
	protected $_startDateExp;
	protected $_endDateExp;
	protected $_periodExp;
	protected $_endDateAct;
	protected $_periodAct;
	protected $_quality;
	protected $_remark;
	protected $_cTime;

	public function setProjectId($projectId)
	{
		$this->_projectId = $projectId;
		return $this;
	}

	public function getProjectId()
	{
		return $this->_projectId;
	}
	/****************************/ 

	public function setStage($stage)
	{
		$this->_stage = $stage;
		return $this;
	}

	public function getStage()
	{
		return $this->_stage;
	}
	/****************************/ 

	public function setTask($task)
	{
		$this->_Task = $task;
		return $this;
	}

	public function getTask()
	{
		return $this->_task;
	}
	/****************************/ 

	public function setStartDateExp($startDateExp)
	{
		$this->_startDateExp = $startDateExp;
		return $this;
	}

	public function getEndDateExp()
	{
		return $this->_startDateExp;
	}
	/****************************/

	public function setPeriodExp($periodExp)
	{
		$this->_periodExp = $periodExp;
		return $this;
	}

	public function getPeriodExp()
	{
		return $this->_periodExp;
	}
	/****************************/

	public function setEndDateAct($endDateAct)
	{
		$this->_endDateAct = $endDateAct;
		return $this;
	}

	public function getEndDateAct()
	{
		return $this->_endDateAct;
	}
	/****************************/

	public function setPeriodAct($periodAct)
	{
		$this->_periodAct = $periodAct;
		return $this;
	}

	public function getPeriodAct()
	{
		return $this->_periodAct;
	}
	/****************************/

	public function setQuality($quality)
	{
		$this->_quality = $quality;
		return $this;
	}

	public function getQuality()
	{
		return $this->_quality;
	}
	/****************************/

	public function setRemark($remark)
	{
		$this->_remark = $remark;
		return $this;
	}

	public function getRemark()
	{
		return $this->_remark;
	}
	/****************************/
	public function setCTime($cTime)
	{
		$this->_cTime = $cTime;
		return $this;
	}

	public function getCTime()
	{
		return $this->_cTime;
	}
}
?>