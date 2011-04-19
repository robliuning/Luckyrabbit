<?php
  //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011
class Worker_Models_Team
{     
    protected $_teamId;
	protected $_name;
	protected $_contactId;
	protected $_contactName;
	protected $_contactPhoneNo;
	protected $_remark;
	protected $_sum;
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
            throw new Exception('Invalid team property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid team property');
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
        $this->_contactName = $contactName;
        return $this;
    } 

    public function getContactName()
    {
        return $this->_contactName;
    }
    
	/************************************************/
	public function setContactPhoneNo($contactPhoneNo)
    {
        $this->_contactPhoneNo = $contactPhoneNo;
        return $this;
    } 

    public function getContactPhoneNo()
    {
        return $this->_contactPhoneNo;
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
	public function setSum($sum)
    {
        $this->_sum = $sum;
        return $this;
    }

    public function getSum()
    {
        return $this->_sum;
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