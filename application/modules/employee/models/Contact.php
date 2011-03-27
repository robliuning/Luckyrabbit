<?php
/*
created by кОаж
time of creating 3-26-2011
completed time 3-26-2011
*/
class Application_Model_Contact
{
	protected $_contactId;
	protected $_name;
	protected $_gender;
	protected $_birth;
	protected $_idCard;
	protected $_phoneNo;
	protected $_otherContact;
	protected $_address;
	protected $_remark;

    public function __construct(array $options=null)
	{
		if(is_array($options)){
             $this->setOptions($options);
		}
	}

	public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid contact property');
        }
        $this->$method($value);
    }

	public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid contact property');
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

	public function setContactId($contactId)
	{
		$this->_contactId = $contactId;
		return $this;
	}

	public function getContactId()
	{
		return $this->_contactId;
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

    public function setGender($gender)
    {
        $this->_gender = (int) $gender;
        return $this;
    } 

    public function getGender()
    {
        return $this->_gender;
    }

	public function setBirth($birth)
	{
		$this->_birth = $birth;
		return $this;
	}

    public function getBirth()
	{
		return $this->_birth;
	}

	public function setIdCard($idCard)
	{
		$this->_idCard = $idCard;
		return $this;
	}

	public function getIdCard()
	{
		return $this->_idCard;
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
		$this->_address = $address;
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

}
?>