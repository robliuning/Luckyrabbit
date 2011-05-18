<?php

class Equipment_Models_Eqpplan
{     
    protected $_eplanId;
    protected $_planId;
	protected $_eqpId;
	protected $_eqpName;
	protected $_price;
	protected $_quantity;
	protected $_amount;
    
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
            throw new Exception('Invalid Equipment property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Equipment property');
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

	public function setEplanId($eplanId)
    {
        $this->_eplanId = (int)$eplanId;
        return $this;
    } 

    public function getEplanId()
    {
        return $this->_eplanId;
    }
    
    public function setPlanId($planId)
    {
        $this->_planId = $planId;
        return $this;
    } 

    public function getPlanId()
    {
        return $this->_planId;
    }

    public function setEqpId($eqpId)
    {
        $this->_eqpId = (int)$eqpId;
        return $this;
    } 

    public function getEqpId()
    {
        return $this->_eqpId;
    }

    public function setEqpName($eqpName)
    {
        $this->_eqpName = $eqpName;
        return $this;
    } 

    public function getEqpName()
    {
        return $this->_eqpName;
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
 
}
?>
