<?php
//update on 14th May by Rob

class Vehicle_Models_Repair
{
	protected $_repId;
	protected $_veId;
	protected $_plateNo;
	protected $_rDate;
	protected $_reason;
	protected $_detail;
	protected $_contactId;
	protected $_contactName;
	protected $_spot;
	protected $_descr;
	protected $_amount;
	protected $_insFlag;
	protected $_indem;
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
			throw new Exception('Invalid repair property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid repair property');
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
	
	public function setRepId($repId)
	{
		$this->_repId = $repId;
		return $this;
	}

	public function getRepId()
	{
		return $this->_repId;
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

	public function setReason($reason)
	{
		$this->_reason = $reason;
		return $this;
	}

	public function getReason()
	{
		return $this->_reason;
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

	public function setSpot($spot)
	{
		$this->_spot = $spot;
		return $this;
	}

	public function getSpot()
	{
		return $this->_spot;
	}

	/************************************************/

	public function setDescr($descr)
	{
		$this->_descr = $descr;
		return $this;
	}

	public function getDescr()
	{
		return $this->_descr;
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

	public function setInsFlag($insFlag)
	{
		$this->_insFlag = $insFlag;
		return $this;
	}

	public function getInsFlag()
	{
		return $this->_insFlag;
	}

	/************************************************/

	public function setIndem($indem)
	{
		$this->_indem = $indem;
		return $this;
	}

	public function getIndem()
	{
		return $this->_indem;
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