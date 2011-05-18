<?php
//updated on 17th May by Rob

class Vehicle_Models_Verecord
{
	protected $_recordId;
	protected $_veId;
	protected $_plateNo;
	protected $_prjFlag;
	protected $_projectId;
	protected $_projectName;
	protected $_startDate;
	protected $_endDate;
	protected $_period;
	protected $_route;
	protected $_mileBf;
	protected $_mileAf;
	protected $_mile;
	protected $_purpose;
	protected $_contactId;
	protected $_contactName;
	protected $_user;
	protected $_mileRef;
	protected $_amount;
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
	public function setPlateNo($plateNo)
	{
		$this->_plateNo = $plateNo;
		return $this;
	}

	public function getPlateNo()
	{
		return $this->_plateNo;
	}

	/********************************************/
	public function setPrjFlag($prjFlag)
	{
		$this->_prjFlag = $prjFlag;
		return $this;
	}

	public function getPrjFlag()
	{
		return $this->_prjFlag;
	}

	/********************************************/
	public function setProjectId($projectId)
	{
		$this->_projectId = $projectId;
		return $this;
	}

	public function getProjectId()
	{
		return $this->_projectId;
	}

	/********************************************/
	public function setProjectName($projectName)
	{
		$this->_projectName = $projectName;
		return $this;
	}

	public function getProjectName()
	{
		return $this->_projectName;
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
	public function setPeriod($period)
	{
		$this->_period = $period;
		return $this;
	}

	public function getPeriod()
	{
		return $this->_period;
	}

	/********************************************/
	public function setRoute($route)
	{
		$this->_route = $route;
		return $this;
	}

	public function getRoute()
	{
		return $this->_route;
	}

	/********************************************/
	public function setMileBf($mileBf)
	{
		$this->_mileBf = $mileBf;
		return $this;
	}

	public function getMileBf()
	{
		return $this->_mileBf;
	}

	/********************************************/
	public function setMileAf($mileAf)
	{
		$this->_mileAf = $mileAf;
		return $this;
	}

	public function getMileAf()
	{
		return $this->_mileAf;
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
	public function setContactId($contactId)
	{
		$this->_contactId = $contactId;
		return $this;
	}

	public function getContactId()
	{
		return $this->_contactId;
	}

	/********************************************/
	public function setContactName($contactName)
	{
		$this->_contactName = $contactName;
		return $this;
	}

	public function getContactName()
	{
		return $this->_contactName;
	}

	/********************************************/
	public function setUser($user)
	{
		$this->_user = $user;
		return $this;
	}

	public function getUser()
	{
		return $this->_user;
	}

	/********************************************/
	public function setMileRef($mileRef)
	{
		$this->_mileRef = $mileRef;
		return $this;
	}

	public function getMileRef()
	{
		return $this->_mileRef;
	}

	/********************************************/
	public function setAmount($amount)
	{
		$this->_amount = $amount;
		return $this;
	}

	public function getAmount()
	{
		return $this->_amount;
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
	
	/********************************************/
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