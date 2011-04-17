<?php
  //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011
class Worker_Models_Worker
{     
    protected $_workerId;
	protected $_name;
	protected $_teamId;
	protected $_phoneNo;
	protected $_address;
	protected $_skills;
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
        $this->_name = (int)$name;
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

	public function setContactId($contactId)
    {
        $this->_contactId = (int)$contactId;
        return $this;
    } 

    public function getContactId()
    {
        return $this->_contactId;
    }
    
	/************************************************/

	public function setContactName($contactName)
    {
        $this->_contactName = (int)$contactName;
        return $this;
    } 

    public function getContactName()
    {
        return $this->_contactName;
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