<?php
 
/*write by lxj
  2011-04-17   v0.2*/

class Asset_Models_Purchase
{     
    protected $_purId;
    protected $_name;
	protected $_venId;
	protected $_venName; 
	protected $_type;
	protected $_spec;
	protected $_invoice; 
	protected $_unit;
	protected $_price;
	protected $_quantity; 
	protected $_amount;
	protected $_contactId;
	protected $_contactName;
	protected $_purDate;
	protected $_approvId;
	protected $_approvName;
	protected $_approvDate;
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
            throw new Exception('Invalid plan property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid plan property');
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

	public function setPurId($purId)
    {
        $this->_purId = (int)$purId;
        return $this;
    } 

    public function getPurId()
    {
        return $this->_purId;
    }
    
    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    } 

    public function getName()
    {
        return $this->_name;
    }

    public function setVenId($venId)
    {
        $this->_venId = (int)$venId;
        return $this;
    } 

    public function getVenId()
    {
        return $this->_venId;
    }

	public function setVenName($venName)
    {
        $this->_venName = $venName;
        return $this;
    } 

    public function getVenName()
    {
        return $this->_venName;
    }
	
    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    } 

    public function getType()
    {
        return $this->_type;
    }
    
    public function setSpec($spec)
    {
        $this->_spec = $spec;
        return $this;
    } 

    public function getSpec()
    {
        return $this->_spec;
    }

	public function setInvoice($invoice)
    {
        $this->_invoice = $invoice;
        return $this;
    } 

    public function getInvoice()
    {
        return $this->_invoice;
    }
    
    public function setUnit($unit)
    {
        $this->_unit = $unit;
        return $this;
    } 

    public function getUnit()
    {
        return $this->_unit;
    }

    public function setPrice($price)
    {
        $this->_price = $price;
        return $this;
    } 

    public function getPrice()
    {
        return $this->_price;
    }
    
    public function setQuantity($quantity)
    {
        $this->_quantity = $quantity;
        return $this;
    } 

    public function getQuantity()
    {
        return $this->_quantity;
    }
    
    public function setAmount($amount)
    {
        $this->_amount = $amount;
        return $this;
    } 

    public function getAmount()
    {
        return $this->_amount;
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
    
    public function setContactName($contactName)
    {
        $this->_contactName= $contactName;
        return $this;
    }

    public function getContactName()
    {
        return $this->_contactName;
	}

	public function setPurDate($purDate)
    {
        $this->_purDate = $purDate;
        return $this;
    }

    public function getPurDate()
    {
        return $this->_purDate;
	}
    
    public function setApprovId($approvId)
    {
        $this->_approvId= $approvId;
        return $this;
    }

    public function getApprovId()
    {
        return $this->_approvId;
	}
	
	public function setApprovName($approvName)
    {
        $this->_approvName = $approvName;
        return $this;
    }

    public function getApprovName()
    {
        return $this->_approvName;
	}
    
    public function setApprovDate($approvDate)
    {
        $this->_approvDate= $approvDate;
        return $this;
    }

    public function getApprovDate()
    {
        return $this->_approvDate;
	}

	public function setRemark($remark)
    {
        $this->_remark= $remark;
        return $this;
    }

    public function getRemark()
    {
        return $this->_remark;
	}

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
