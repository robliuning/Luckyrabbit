<?php
//updated on 24th May by Rob

class Pment_Models_Wkprg
{
	protected $_wkprgId;
	protected $_projectId;
	protected $_wkNum;
	protected $_startDate;
	protected $_endDate;
	protected $_period;
	protected $_wkPlan;
	protected $_wkAct;
	protected $_nextPlan;
	protected $_problem;
	protected $_resolve;
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
			throw new Exception('Invalid wkprg property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid wkprg property');
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
	
	public function setWkprgId($wkprgId)
	{
		$this->_wkprgId = $wkprgId;
		return $this;
	}

	public function getWkprgId()
	{
		return $this->_wkprgId;
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
	public function setWkNum($wkNum)
	{
		$this->_wkNum = $wkNum;
		return $this;
	}

	public function getWkNum()
	{
		return $this->_wkNum;
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
	public function setWkPlan($wkPlan)
	{
		$this->_wkPlan = $wkPlan;
		return $this;
	}

	public function getWkPlan()
	{
		return $this->_wkPlan;
	}

	/****************************/
	public function setWkAct($wkAct)
	{
		$this->_wkAct = $wkAct;
		return $this;
	}

	public function getWkAct()
	{
		return $this->_wkAct;
	}

	/****************************/
	public function setNextPlan($nextPlan)
	{
		$this->_nextPlan = $nextPlan;
		return $this;
	}

	public function getNextPlan()
	{
		return $this->_nextPlan;
	}

	/****************************/
	public function setProblem($problem)
	{
		$this->_problem = $problem;
		return $this;
	}

	public function getProblem()
	{
		return $this->_problem;
	}

	/****************************/
	public function setResolve($resolve)
	{
		$this->_resolve = $resolve;
		return $this;
	}

	public function getResolve()
	{
		return $this->_resolve;
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