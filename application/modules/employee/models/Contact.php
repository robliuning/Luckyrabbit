<?php

class Application_Model_Employee
{
    protected $_empId;
	protected $_name;
	protected $_gender;
	protected $_age;
	protected $_deptName;
	protected $_dutyName;
	protected $_titleName;
	protected $_idCard;
	protected $_phone;
	protected $_otherContact;
	protected $_address;
	protected $_status;
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
            throw new Exception('Invalid employee property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid employee property');
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

	public function setEmpId($empId)
    {
        $this->_empId = (string)$empId;
        return $this;
    } 

    public function getEmpId()
    {
        return $this->_empId;
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
 
     public function setAge($age)
    {
        $this->_age = (int) $age;
        return $this;
    }

    public function getAge()
    {
        return $this->_age;
    }

     public function setDeptName($deptName)
    {
        $this->_deptName = $deptName;
        return $this;
    }

    public function getDeptName()
    {
        return $this->_deptName;
    }

    public function setDutyName($dutyName)
    {
        $this->_dutyName = (string) $dutyName;
        return $this;
    }

    public function getDutyName()
    {
        return $this->_dutyName;
    }

     public function setTitleName($titleName)
    {
        $this->_titleName = (string) $titleName;
        return $this;
    }
 
    public function getTitleName()
    {
        return $this->_titleName;
    }

 
     public function setIdCard($idCard)
    {
        $this->_idCard = (string) $idCard;
        return $this;
    }

    public function getIdCard()
    {
        return $this->_idCard;
    }

 
     public function setPhone($phone)
    {
        $this->_phone = (string) $phone;
        return $this;
    } 

    public function getPhone()
    {
        return $this->_phone;
    }

 
     public function setOtherContact($otherContact)
    {
        $this->_otherContact = (string) $otherContact;
        return $this;
    }

    public function getOtherContact()
    {
        return $this->_otherContact;
    }

     public function setAddress($address)
    {
        $this->_address = (string) $address;
        return $this;
    } 

    public function getAddress()
    {
        return $this->_address;
    }

     public function setStatus($status)
    {
        $this->_status = (string) $status;
        return $this;
    } 

    public function getStatus()
    {
        return $this->_status;
    }
 
     public function setRemark($remark)
    {
        $this->_remark = (string) $remark;
        return $this;
    }

    public function getRemark()
    {
        return $this->_remark;
    }
}
?>