<?php
  //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011
class Worker_Models_Worker
{     
    protected $_workerId;
	protected $_name;
	protected $_teamId;
	protected $_teamName;
	protected $_phoneNo;
	protected $_address;
	protected $_skill;
	protected $_cert;
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
            throw new Exception('Invalid worker property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid worker property');
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

	public function setWorkerId($workerId)
    {
        $this->_workerId = (int)$workerId;
        return $this;
    } 

    public function getWorkerId()
    {
        return $this->_workerId;
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

	public function setTeamId($teamId)
    {
        $this->_teamId = (int)$teamId;
        return $this;
    } 

    public function getTeamId()
    {
        return $this->_teamId;
    }
    
	/************************************************/

	public function setTeamName($teamName)
    {
        $this->_teamName = $teamName;
        return $this;
    } 

    public function getTeamName()
    {
        return $this->_teamName;
    }
    
	/************************************************/

	public function setPhoneNo($phoneNo)
    {
        $this->_phoneNo = $phoneNo;
        return $this;
    } 

    public function getPhoneNo()
    {
        return $this->_phoneNo;
    }
    
	/************************************************/

	public function setAddress($address)
    {
        $this->_address = $address;
        return $this;
    } 

    public function getAddress()
    {
        return $this->_address;
    }
    
	/************************************************/

	public function setSkill($skill)
    {
        $this->_skill = $skill;
        return $this;
    } 

    public function getSkill()
    {
        return $this->_skill;
    }
    
	/************************************************/

	public function setCert($cert)
    {
        $this->_cert = $cert;
        return $this;
    } 

    public function getCert()
    {
        return $this->_cert;
    }
    
	/************************************************/
    
    public function setRemark($remark)
    {
        $this->_remark= $remark;
        return $this;
    }

    public function getRemark()
    {
        return $this->_remark;
	}

	/************************************************/
	public function setCTime($cTime)
    {
        $this->_cTime= $cTime;
        return $this;
    }

    public function getCTime()
    {
        return $this->_cTime;
	}
}
?>