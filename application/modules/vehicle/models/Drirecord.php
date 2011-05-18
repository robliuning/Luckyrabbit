<?php
//update on 14th May by Rob


class Vehicle_Models_Drirecord
{
	protected $_recordId;
	protected $_veId;
	protected $_plateNo;
	protected $_rYear;
	protected $_rMonth;
	protected $_mileEarly;
	protected $_mileEnd;
	protected $_mile;
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
			throw new Exception('Invalid drirecord property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid drirecord property');
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
	
	public function setRecordId($recordId)
	{
		$this->_recordId = $recordId;
		return $this;
	}

	public function getRecordId()
	{
		return $this->_recordId;
	}

	/*********************************************/

	public function setVeId($veId)
	{
		$this->_veId = $veId;
		return $this;
	}

	public function getVeId()
	{
		return $this->_veId;
	}

	/*********************************************/

	public function setPlateNo($plateNo)
	{
		$this->_plateNo = $plateNo;
		return $this;
	}

	public function getPlateNo()
	{
		return $this->_plateNo;
	}

	/************************************************/
	public function setRYear($rYear)
	{
		$this->_rYear = $rYear;
		return $this;
	}

	public function getRYear()
	{
		return $this->_rYear;
	}

	/************************************************/

	public function setRMonth($rMonth)
	{
		$this->_rMonth = $rMonth;
		return $this;
	}

	public function getRMonth()
	{
		return $this->_rMonth;
	}

	/************************************************/

	public function setMileEarly($mileEarly)
	{
		$this->_mileEarly = $mileEarly;
		return $this;
	}

	public function getMileEarly()
	{
		return $this->_mileEarly;
	}

	/************************************************/

	public function setMileEnd($mileEnd)
	{
		$this->_mileEnd = $mileEnd;
		return $this;
	}

	public function getMileEnd()
	{
		return $this->_mileEnd;
	}

	/************************************************/
	public function setMile($mile)
	{
		$this->_mile = $mile;
		return $this;
	}

	public function getMile()
	{
		return $this->_mile;
	}

	/************************************************/

	public function setRemark($remark)
	{
		$this->_remark = $remark;
		return $this;
	}

	public function getRemark()
	{
		return $this->_remark;
	}

	/************************************************/
	
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