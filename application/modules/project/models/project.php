<?php
//updated on 24th May by Rob

class Project_Models_Project
{
	protected $_projectId;
	protected $_name;
	protected $_address;
	protected $_status;
	protected $_structype;
	protected $_level;
	protected $_period;
	protected $_startDate;
	protected $_contactId;
	protected $_contactName;
	protected $_constructor;
	protected $_contractor;
	protected $_supervisor;
	protected $_designer;
	protected $_license;
	protected $_stage;
	protected $_amount;
	protected $_constrArea;
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

	/****************************/
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
	public function setConstructor($constructor)
	{
		$this->_constructor = $constructor;
		return $this;
	}

	public function getConstructor()
	{
		return $this->_constructor;
	}

	/****************************/
	public function setContractor($contractor)
	{
		$this->_contractor = $contractor;
		return $this;
	}

	public function getContractor()
	{
		return $this->_contractor;
	}

	/****************************/
	public function setSupervisor($supervisor)
	{
		$this->_supervisor = $supervisor;
		return $this;
	}

	public function getSupervisor()
	{
		return $this->_supervisor;
	}

	/****************************/
	public function setDesigner($designer)
	{
		$this->_designer = $designer;
		return $this;
	}

	public function getDesigner()
	{
		return $this->_designer;
	}

	/****************************/
	public function setLicense($license)
	{
		$this->_license = $license;
		return $this;
	}

	public function getLicense()
	{
		return $this->_license;
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