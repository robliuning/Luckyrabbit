<?php

class General_Models_Vendor
{     
    protected $_venId;
	protected $_name;
	protected $_type;
	protected $_contactId;
	protected $_address;
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
            throw new Exception('Invalid vendor property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid vendor property');
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

	/**************************************/
	public function setVenId($venId)
    {
        $this->_venId = $venId;
        return $this;
    }

    public function getVenId()
    {
        return $this->_venId;
	}
	/**************************************/
	public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
	}
	/**************************************/
	public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->_type;
	}
	/**************************************/
	public function setContactId($contactId)
    {
        $this->_contactId = $contactId;
        return $this;
    }

    public function getContactId()
    {
        return $this->_contactId;
	}
	/**************************************/
	public function setAddress($address)
    {
        $this->_address = $address;
        return $this;
    }

    public function getAddress()
    {
        return $this->_address;
	}/**************************************/
	public function set($)
    {
        $this->_= $;
        return $this;
    }

    public function get()
    {
        return $this->_;
	}

    /**************************************/
	public function setRemark($remark)
    {
        $this->_remark= $remark;
        return $this;
    }

    public function getRemark()
    {
        return $this->_remark;
	}

	/**************************************/
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