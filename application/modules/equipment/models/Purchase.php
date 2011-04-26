<?php

/*write by lxj
 2011-04-16 v0.2*/


class Equipment_Models_Purchase
{     
    protected $_purId;
    protected $_projectId;
	protected $_projectName;
	protected $_venId;
	protected $_venName;
	protected $_buyerId;
	protected $_buyerName;
	protected $_purDate;
	protected $_planType;
	protected $_approvId;
	protected $_approvName;
	protected $_approvDate;
	protected $_destId;
	protected $_destName;
	protected $_freight;
	protected $_invoice;
	protected $_total;
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
            throw new Exception('Invalid purchase property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid purchase property');
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
 /***************************************************/
	public function setPurId($purId)
    {
        $this->_purId = (int)$purId;
        return $this;
    } 

    public function getPurId()
    {
        return $this->_purId;
    }

	 /***************************************************/
	public function setProjectId($projectId)
    {
        $this->_projectId = $projectId;
        return $this;
    } 

    public function getProjectId()
    {
        return $this->_projectId;
    }

	 /***************************************************/
	public function setProjectName($projectName)
    {
        $this->_projectName = $projectName;
        return $this;
    } 

    public function getProjectName()
    {
        return $this->_projectName;
    }

	 /***************************************************/
	public function setVenId($venId)
    {
        $this->_venId = $venId;
        return $this;
    } 

    public function getVenId()
    {
        return $this->_venId;
    }

	 /***************************************************/
	public function setVenName($venName)
    {
        $this->_venName = $venName;
        return $this;
    } 

    public function getVenName()
    {
        return $this->_venName;
    }

	 /***************************************************/
	public function setBuyerId($buyerId)
    {
        $this->_buyerId = $buyerId;
        return $this;
    } 

    public function getBuyerId()
    {
        return $this->_buyerId;
    }

	/***************************************************/
	public function setBuyerName($buyerName)
    {
        $this->_buyerName = $buyerName;
        return $this;
    } 

    public function getBuyerName()
    {
        return $this->_buyerName;
    }

	 /***************************************************/
	public function setPurDate($purDate)
    {
        $this->_purDate = $purDate;
        return $this;
    } 

    public function getPurDate()
    {
        return $this->_purDate;
    }

	 /***************************************************/
	public function setPlanType($planType)
    {
        $this->_planType = $planType;
        return $this;
    } 

    public function getPlanType()
    {
        return $this->_planType;
    }

	 /***************************************************/
	public function setApprovId($approvId)
    {
        $this->_approvId = $approvId;
        return $this;
    } 

    public function getApprovId()
    {
        return $this->_approvId;
    }

	 /***************************************************/
	public function setApprovName($approvName)
    {
        $this->_approvName = $approvName;
        return $this;
    } 

    public function getApprovName()
    {
        return $this->_approvName;
    }

	 /***************************************************/
	public function setApprovDate($approvDate)
    {
        $this->_approvDate = $approvDate;
        return $this;
    } 

    public function getApprovDate()
    {
        return $this->_approvDate;
    }

	 /***************************************************/
	public function setDestId($destId)
    {
        $this->_destId = $destId;
        return $this;
    } 

    public function getDestId()
    {
        return $this->_destId;
    }

	 /***************************************************/
	public function setDestName($destName)
    {
        $this->_destName = $destName;
        return $this;
    } 

    public function getDestName()
    {
        return $this->_destName;
    }

	 /***************************************************/
	public function setFreight($freight)
    {
        $this->_freight = $freight;
        return $this;
    } 

    public function getFreight()
    {
        return $this->_freight;
    }

	 /***************************************************/
	public function setInvoice($invoice)
    {
        $this->_invoice = $invoice;
        return $this;
    } 

    public function getInvoice()
    {
        return $this->_invoice;
    }

  /***************************************************/
	public function setTotal($total)
    {
        $this->_total = $total;
        return $this;
    }

    public function getTotal()
    {
        return $this->_total;
	}
    
	 /***************************************************/
    public function setRemark($remark)
    {
        $this->_remark= $remark;
        return $this;
    }

    public function getRemark()
    {
        return $this->_remark;
	}

	/***************************************************/
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