<?php
//updated on 30th May by Rob

class Pment_Models_Measure
{
	protected $_meaId;
	protected $_projectId;
	protected $_meaDate;
	protected $_measure;
	protected $_problem;
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
			throw new Exception('Invalid measure property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid measure property');
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
	
	public function setMeaId($meaId)
	{
		$this->_meaId = $meaId;
		return $this;
	}

	public function getMeaId()
	{
		return $this->_meaId;
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

	public function setMeaDate($meaDate)
	{
		$this->_meaDate = $meaDate;
		return $this;
	}

	public function getMeaDate()
	{
		return $this->_meaDate;
	}

	/****************************/
	
	public function setMeasure($measure)
	{
		$this->_measure = $measure;
		return $this;
	}

	public function getMeasure()
	{
		return $this->_measure;
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