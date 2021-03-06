<?php
//update on 14th May by Rob


class Vehicle_Models_Vehicle
{
	protected $_veId;
	protected $_plateNo;
	protected $_name;
	protected $_color;
	protected $_license;
	protected $_contactId;
	protected $_user;
	protected $_fuelCons;
	protected $_remark;
	protected $_cTime;
	protected $_contactName; //数据库ve_vehicles中没有，在这里用于存储来自em_contacts中的Name
	protected $_pilot; // 二阶段新增变量
	protected $_pDate;
	protected $_brand;
	protected $_price;
	protected $_pilotName;
	
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
			throw new Exception('Invalid vehicle property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid vehicle property');
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
	public function setName($name)
	{
		$this->_name = $name;
		return $this;
	}

	public function getName()
	{
		return $this->_name;
	}

	/************************************************/

	public function setColor($color)
	{
		$this->_color = $color;
		return $this;
	}

	public function getColor()
	{
		return $this->_color;
	}

	/************************************************/

	public function setLicense($license)
	{
		$this->_license = $license;
		return $this;
	}

	public function getLicense()
	{
		return $this->_license;
	}

	/************************************************/

	public function setContactId($contactId)
	{
		$this->_contactId = $contactId;
		return $this;
	}

	public function getContactId()
	{
		return $this->_contactId;
	}

	/************************************************/
	public function setUser($user)
	{
		$this->_user = $user;
		return $this;
	}

	public function getUser()
	{
		return $this->_user;
	}

	/************************************************/

	public function setFuelCons($fuelCons)
	{
		$this->_fuelCons = $fuelCons;
		return $this;
	}

	public function getFuelCons()
	{
		return $this->_fuelCons;
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

	/************************************************/

	public function setContactName($contactName)
	{
		$this->_contactName = $contactName;
		return $this;
	}

	public function getContactName()
	{
		return $this->_contactName;
	}

	/************************************************/

	public function setPilot($pilot)
	{
		$this->_pilot = (int)$pilot;
		return $this;
	}

	public function getPilot()
	{
		return $this->_pilot;
	}

	/************************************************/

	public function setPDate($pDate)
	{
		$this->_pDate = $pDate;
		return $this;
	}

	public function getPDate()
	{
		return $this->_pDate;
	}

	/************************************************/

	public function setBrand($brand)
	{
		$this->_brand = $brand;
		return $this;
	}

	public function getBrand()
	{
		return $this->_brand;
	}

	/************************************************/

	public function   setPrice($price)
	{
		$this->_price = $price;
		return $this;
	}

	public function getPrice()
	{
		return $this->_price;
	}

	/************************************************/

	public function setPilotName($pilotName)
	{
		$this->_pilotName = $pilotName;
		return $this;
	}

	public function getPilotName()
	{
		return $this->_pilotName;
	}
}
?>