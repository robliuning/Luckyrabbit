<?php
//updated on 24th May by Rob

class Pment_Models_Monprg
{
	protected $_monprgId;
	protected $_projectId;
	protected $_yearNum;
	protected $_monNum;
	protected $_subTask;
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
			throw new Exception('Invalid monprg property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid monprg property');
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
	
	public function setMonprgId($monprgId)
	{
		$this->_monprgId = $monprgId;
		return $this;
	}

	public function getmonprgId()
	{
		return $this->_monprgId;
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
	public function setYearNum($yearNum)
	{
		$this->_yearNum = $yearNum;
		return $this;
	}

	public function getYearNum()
	{
		return $this->_yearNum;
	}

	/****************************/
	public function setMonNum($monNum)
	{
		$this->_monNum = $monNum;
		return $this;
	}

	public function getMonNum()
	{
		return $this->_monNum;
	}

	/****************************/
	public function setSubTask($subTask)
	{
		$this->_subTask = $subTask;
		return $this;
	}

	public function getSubTask()
	{
		return $this->_subTask;
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