<?php
//updated in 13th June by Rob

class Contract_Models_Contractor
{
	protected $_contractorId;
	protected $_name;
	protected $_licenseNo;
	protected $_busiField;
	protected $_contact;
	protected $_phoneNo;
	protected $_otherContact;
	protected $_address;
	protected $_remark;
	protected $_cTime;
	protected $_cpId;
	
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
			throw new Exception('Invalid contractor property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid contractor property');
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

	public function setContractorId($contractorId)
	{
		$this->_contractorId = (int)$contractorId;
		return $this;
	} 

	public function getContractorId()
	{
		return $this->_contractorId;
	}

	public function setName($name)
	{
		$this->_name = (string)$name;
		return $this;
	} 

	public function getName()
	{
		return $this->_name;
	}

	
	public function setContact($contact)
	{
		$this->_contact= (string) $contact;
		return $this;
	} 

	public function getContact()
	{
		return $this->_contact;
	}
 
 	public function setLicenseNo($licenseNo)
	{
		$this->_licenseNo= $licenseNo;
		return $this;
	}

	public function getLicenseNo()
	{
		return $this->_licenseNo;
	} 

 	public function setBusiField($busiField)
	{
		$this->_busiField = $busiField;
		return $this;
	}

	public function getBusiField()
	{
		return $this->_busiField;
	}

	public function setPhoneNo($phoneNo)
	{
		$this->_phoneNo = $phoneNo;
		return $this;
	}

	public function getPhoneNo()
	{
		return $this->_phoneNo;
	}

 	public function setOtherContact($otherContact)
	{
		$this->_otherContact = $otherContact;
		return $this;
	}

	public function getOtherContact()
	{
		return $this->_otherContact;
	}

 	public function setAddress($address)
	{
		$this->_address= $address;
		return $this;
	}

 	public function getAddress()
	{
		return $this->_address;
	}

 	public function setRemark($remark)
	{
		$this->_remark = $remark;
		return $this;
	}

 	public function getRemark()
	{
		return $this->_remark;
	}
 	
	public function setCTime($cTime)
	{
		$this->_cTime = $cTime;
		return $this;
	}

	public function getCTime()
	{
		return $this->_cTime;
	}

	public function setCpId($cpId)
	{
		$this->_cpId = $cpId;
		return $this;
	}

	public function getCpId()
	{
		return $this->_cpId;
	}
}
?>
