<?php

class Material_Models_Mtrplan
{     
    protected $_mplanId;
    protected $_planId;
	protected $_mtrId;
	protected $_materialName;
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
            throw new Exception('Invalid metarial property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid metarial property');
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

	public function setMplanId($mplanId)
    {
        $this->_mplanId = (int)$mplanId;
        return $this;
    } 

    public function getMplanId()
    {
        return $this->_mplanId;
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

    public function setMtrId($mtrId)
    {
        $this->_mtrId = (int)$mtrId;
        return $this;
    } 

    public function getMtrId()
    {
        return $this->_mtrId;
    }

    public function setMaterialName($materialName)
    {
        $this->_materialName = $materialName;
        return $this;
    } 

    public function getMaterialName()
    {
        return $this->_materialName;
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
