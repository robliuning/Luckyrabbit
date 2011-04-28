<?php

/* create by lxj
   2011-04-08   v2.0
   */

class Contract_Models_Contrqualif
{    
	protected $_cqId;
    protected $_contractorId;
    protected $_contractorName;
	protected $_qualifTypeId;
	protected $_qualifGrade;
	protected $_qualifSerie;
	protected $_qualifType;
    
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
            throw new Exception('Invalid contrqualif property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid contrqualif property');
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

	public function setCqId($cqId)
	{
		$this->_cqId = (int)$cqId;
		return $this;
	}

	public function getCqId()
	{
		return $this->_cqId;
	}

	public function setContractorId($contractorId)
    {
        $this->_contractorId= (int)$contractorId;
        return $this;
    } 

    public function getContractorId()
    {
        return $this->_contractorId;
    }
    
   	public function setContractorName($contractorName)
    {
        $this->_contractorName = $contractorName;
        return $this;
    } 

    public function getContractorName()
    {
        return $this->_contractorName;
    }
    
	public function setQualifTypeId($qualifTypeId)
    {
        $this->_qualifTypeId = (int)$qualifTypeId;
        return $this;
    } 

    public function getQualifTypeId()
    {
        return $this->_qualifTypeId;
    }
    
    public function setQualifSerie($qualifSerie)
    {
        $this->_qualifSerie = $qualifSerie;
        return $this;
    } 

    public function getQualifSerie()
    {
        return $this->_qualifSerie;
    }

	public function setQualifType($qualifType)
    {
        $this->_qualifType = $qualifType;
        return $this;
    } 

    public function getQualifType()
    {
        return $this->_qualifType;
    }

    public function setQualifGrade($qualifGrade)
    {
        $this->_qualifGrade= (string)$qualifGrade;
        return $this;
    } 

    public function getQualifGrade()
    {
        return $this->_qualifGrade;
    }	

}
?>
