<?php
  //creation date 01-04-2011
  //creating by lincoy
  //completion date 01-04-2011

class Project_Models_Project
{
	protected $_projectId;
	protected $_name;
	protected $_address;
	protected $_status;
	protected $_structype;
	protected $_level;
	protected $_amount;
	protected $_purpose;
	protected $_constrArea;
	protected $_staffNo;
	protected $_remark;
	protected $_cTime;

	protected $_cId;  //contactId  in contact
	protected $_cName;//contactName  in conctact
	protected $_stage;//stage in progress

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
            throw new Exception('Invalid project property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid project property');
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

	public function setName($name)
	{
		$this->_name = $name;
		return $this;
	}

	public function getName()
	{
		return $this->_name;
	}

	/**************************************************/
	public function setAddress($address)
	{
		$this->_address = $address;
		return $this;
	}

	public function getAddress()
	{
		return $this->_address;
	}
	/****************************/

	public function setStatus($status)
	{
		$this->_status = $status;
		return $this;
	}

	public function getStatus()
	{
		return $this->_status;
	}
	/****************************/

	public function setStructype($structype)
	{
		$this->_structype = $structype;
		return $this;
	}

	public function getStructype()
	{
		return $this->_structype;
	}
	/****************************/

	public function setLevel($level)
	{
		$this->_level = $level;
		return $this;
	}

	public function getLevel()
	{
		return $this->_level;
	}
	/****************************/

	public function setAmount($amount)
	{
		$this->_amount = $amount;
		return $this;
	}

	public function getAmount()
	{
		return $this->_amount;
	}

	/****************************/
	public function setPurpose($purpose)
	{
		$this->_purpose = $purpose;
		return $this;
	}

	public function getPurpose()
	{
		return $this->_purpose;
	}

	/****************************/
	public function setConstrArea($constrArea)
	{
		$this->_constrArea = $constrArea;
		return $this;
	}

	public function getConstrArea()
	{
		return $this->_constrArea;
	}
	/****************************/
	public function setStaffNo($staffNo)
	{
		$this->_staffNo = $staffNo;
		return $this;
	}

	public function getStaffNo()
	{
		return $this->_staffNo;
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
	/****************************/
	public function setCId($cId)
	{
		$this->_cId = $cId;
		return $this;
	}

	public function getCId()
	{
		return $this->_cId;
	}
	/****************************/
	public function setCName($cName)
	{
		$this->_cName = $cName;
		return $this;
	}

	public function getCName()
	{
		return $this->_cName;
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
}
?>