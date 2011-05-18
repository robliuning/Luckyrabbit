<?php
//update on 14th May by Rob

class Vehicle_Models_Mtnc
{
	protected $_mtnId;
	protected $_veId;
	protected $_plateNo;
	protected $_rDate;
	protected $_detail;
	protected $_contactId;
	protected $_contactName;
	protected $_mile;
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
			throw new Exception('Invalid mtnc property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid mtnc property');
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
	
	public function setMtnId($mtnId)
	{
		$this->_mtnId = $mtnId;
		return $this;
	}

	public function getMtnId()
	{
		return $this->_mtnId;
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
	public function setRDate($rDate)
	{
		$this->_rDate = $rDate;
		return $this;
	}

	public function getRDate()
	{
		return $this->_rDate;
	}

	/************************************************/

	public function setDetail($detail)
	{
		$this->_detail = $detail;
		return $this;
	}

	public function getDetail()
	{
		return $this->_detail;
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

	public function setAmount($amount)
	{
		$this->_amount = $amount;
		return $this;
	}

	public function getAmount()
	{
		return $this->_amount;
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