<?php
//creation date 09-04-2011
  //creating by lincoy
  //completion date 09-04-2011

class Vehicle_Models_Vehicle
{
	protected $_recordId;
	protected $_veId;
	protected $_startDate;
	protected $_endDate;
	protected $_purpose;
	protected $_mile;
	protected $_pilot;
	protected $_otherUser;
	protected $_remark;

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
            throw new Exception('Invalid verecord property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid verecord property');
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

   /********************************************/
	public function setRecordId($recordId)
	{
		$this->_recordId = $recordId;
		return $this;
	}

	public function getRecordId()
	{
		return $this->_recordId;
	}

	/********************************************/
	public function setVeId($veId)
	{
		$this->_veId = $veId;
		return $this;
	}

	public function getVeId()
	{
		return $this->_veId;
	}

	/********************************************/
	public function setStartDate($startDate)
	{
		$this->_startDate = $startDate;
		return $this;
	}

	public function getStartDate()
	{
		return $this->_startDate;
	}

	/********************************************/
	public function setEndDate($endDate)
	{
		$this->_endDate = $endDate;
		return $this;
	}

	public function getEndDate()
	{
		return $this->_endDate;
	}

	/********************************************/
	public function setPurpose($purpose)
	{
		$this->_purpose = $purpose;
		return $this;
	}

	public function getPurpose()
	{
		return $this->_purpose;
	}

	/********************************************/
	public function setMile($mile)
	{
		$this->_mile = $mile;
		return $this;
	}

	public function getMile()
	{
		return $this->_mile;
	}

	/********************************************/
	public function setPilot($pilot)
	{
		$this->_pilot = $pilot;
		return $this;
	}

	public function getPolit()
	{
		return $this->_pilot;
	}

	/********************************************/
	public function setOtherUser($otherUser)
	{
		$this->_otherUser = $otherUser;
		return $this;
	}

	public function getOtherUser()
	{
		return $this->_otherUser;
	}

	/********************************************/
	public function setRemark($remark)
	{
		$this->_remark = $remark;
		return $this;
	}

	public function getRemark()
	{
		return $this->_remark;
	}
}
?>