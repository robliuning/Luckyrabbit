<?php
//updated on 24th May by Rob

class Pment_Models_Mstprg
{
	protected $_mstprgId;
	protected $_projectId;
	protected $_stage;
	protected $_task;
	protected $_startDate;
	protected $_endDate;
	protected $_period;
	protected $_contactId;
	protected $_contactName;
	protected $_remark;
	protected $_cTime;

	public function __construct(array $options = null)
	{
		if (is_array($options)) {
			$this->setOptions($options);
		}
	}

	public function __set($name, $value)
	{
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid mstprg property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid mstprg property');
		}
		return $this->$method();
	} 

	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
	}
	
	public function setMstprgId($mstprgId)
	{
		$this->_mstprgId = $mstprgId;
		return $this;
	}

	public function getMstprgId()
	{
		return $this->_mstprgId;
	}

	/****************************/

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
		$this->_task = $task;
		return $this;
	}

	public function geTtask()
	{
		return $this->_task;
	}

	/****************************/
	public function setStartDate($startDate)
	{
		$this->_startDate = $startDate;
		return $this;
	}

	public function getStartDate()
	{
		return $this->_startDate;
	}

	/****************************/
	public function setEndDate($endDate)
	{
		$this->_endDate = $endDate;
		return $this;
	}

	public function getEndDate()
	{
		return $this->_endDate;
	}

	/****************************/
	public function setPeriod($period)
	{
		$this->_period = $period;
		return $this;
	}

	public function getPeriod()
	{
		return $this->_period;
	}

	/****************************/
	public function setContactId($contactId)
	{
		$this->_contactId = $contactId;
		return $this;
	}

	public function getContactId()
	{
		return $this->_contactId;
	}

	/****************************/
	public function setContactName($contactName)
	{
		$this->_contactName = $contactName;
		return $this;
	}

	public function getContactName()
	{
		return $this->_contactName;
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