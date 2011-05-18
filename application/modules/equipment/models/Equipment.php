<?php

/*write by lxj
 2011-04-16 v0.2
 */

class Equipment_Models_Equipment
{     
    protected $_eqpId;
    protected $_name;
	protected $_typeId;
	protected $_typeName;
	protected $_spec;
	protected $_unit;
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
            throw new Exception('Invalid equipment property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid equipment property');
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

	public function setEqpId($eqpId)
    {
        $this->_eqpId = (int)$eqpId;
        return $this;
    } 

    public function getEqpId()
    {
        return $this->_eqpId;
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

    public function setTypeId($typeId)
    {
        $this->_typeId = (int)$typeId;
        return $this;
    } 

    public function getTypeId()
    {
        return $this->_typeId;
    }
    
    public function setTypeName($typeName)
    {
        $this->_typeName = $typeName;
        return $this;
    } 

    public function getTypeName()
    {
        return $this->_typeName;
    }
    
    public function setSpec($spec)
    {
        $this->_spec= (string) $spec;
        return $this;
    } 

    public function getSpec()
    {
        return $this->_spec;
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
