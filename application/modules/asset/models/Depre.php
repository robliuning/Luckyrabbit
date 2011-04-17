<?php
 
/*write by lxj
  2011-04-16   v0.2*/

class Material_Models_Plan
{     
    protected $_depId;
    protected $_purId;
	protected $_purName;
	protected $_projectId;
	protected $_projectName;
	protected $_quantity;
	protected $_inDate;
	protected $_outDate;
	protected $_depre;
	protected $_depreAmt;
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

	public function setDepId($depId)
    {
        $this->_depId = (int)$depId;
        return $this;
    } 

    public function getDepId()
    {
        return $this->_depId;
    }
    
    public function setPurId($purId)
    {
        $this->_purId = $purId;
        return $this;
    } 

    public function getPurId()
    {
        return $this->_purId;
    }

    public function setPurName($purName)
    {
        $this->_purName = (int)$purName;
        return $this;
    } 

    public function getPurName()
    {
        return $this->_purName;
    }

	public function setProjectName($projectName)
    {
        $this->_projectName = $projectName;
        return $this;
    } 

    public function getProjectName()
    {
        return $this->_projectName;
    }
	
    public function setProjectId($projectId)
    {
        $this->_projectId = $projectId;
        return $this;
    } 

    public function getProjectId()
    {
        return $this->_projectId;
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

	public function setInDate($inDate)
    {
        $this->_inDate = $inDate;
        return $this;
    } 

    public function getInDate()
    {
        return $this->_inDate;
    }
    
    public function setOutDate($outDate)
    {
        $this->_outDate = $outDate;
        return $this;
    } 

    public function getOutDate()
    {
        return $this->_outDate;
    }

    public function setDepre($depre)
    {
        $this->_depre = $depre;
        return $this;
    } 

    public function getDepre()
    {
        return $this->_depre;
    }
    
    public function setDepreAmt($depreAmt)
    {
        $this->_depreAmt = $depreAmt;
        return $this;
    } 

    public function getDepreAmt()
    {
        return $this->_depreAmt;
    }

	public function setRemark($remark)
    {
        $this->_remark = $remark;
        return $this;
    }

    public function getRemark()
    {
        return $this->_remark;
	}
   
	public function setCTime($cTime)
    {
        $this->_cTime = $cTime;
        return $this;
    }

    public function getCTime()
    {
        return $this->_cTime;
	}
}
?>
