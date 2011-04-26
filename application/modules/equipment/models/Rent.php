<?php
  
/*write by lxj
  2011-04-16 v0.2*/

class Equipment_Models_Rent
{     
    protected $_renId;
	protected $_projectId;
	protected $_projectName; //from pm_projects
	protected $_venId;
	protected $_venName;
	protected $_venRes;
	protected $_personId;
	protected $_personName;
	protected $_startDate;
	protected $_endDate; 
	protected $_planType;
	protected $_approvId;
	protected $_approvName; //from em_contacts
	protected $_approvDate;
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
            throw new Exception('Invalid export property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid export property');
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

	public function setRenId($renId)
    {
        $this->_renId = (int)$renId;
        return $this;
    } 

    public function getRenId()
    {
        return $this->_renId;
    }
    
	/************************************************/
    public function setProjectId($projectId)
    {
        $this->_projectId = (int)$projectId;
        return $this;
    } 

    public function getProjectId()
    {
        return $this->_projectId;
    }

	/************************************************/
	public function setProjectName($projectName)
    {
        $this->_projectName = $projectName;
        return $this;
    } 

    public function getProjectName()
    {
        return $this->_projectName;
    }

	/************************************************/
    public function setVenId($venId)
    {
        $this->_venId = $venId;
        return $this;
    } 

    public function getVenId()
    {
        return $this->_venId;
    }
    
    /************************************************/

	public function setRenRes($renRes)
    {
        $this->_renRes = $renRes;
        return $this;
    } 

    public function getRenRes()
    {
        return $this->_renRes;
    }
    
    /************************************************/

	public function setPersonId($personId)
    {
        $this->_personId = $personId;
        return $this;
    } 

    public function getPersonId()
    {
        return $this->_personId;
    }
    
    /************************************************/

	public function setPersonName($personName)
    {
        $this->_personName = $personName;
        return $this;
    } 

    public function getPersonName()
    {
        return $this->_personName;
    }
    
    /************************************************/

    public function setStartDate($startDate)
    {
        $this->_startDate = $startDate;
        return $this;
    } 

    public function getStartDate()
    {
        return $this->_startDate;
    }

	/************************************************/
	public function setEndDate($EndDate)
    {
        $this->_endDate = $endDate;
        return $this;
    } 

    public function getEndDate()
    {
        return $this->_endDate;
    }
    
	/************************************************/
    public function setPlanType($planType)
    {
        $this->_planType = $planType;
        return $this;
    } 

    public function getPlanType()
    {
        return $this->_planType;
    }

    /*********************************************/
    public function setApprovId($approvId)
    {
        $this->_approvId = $approvId;
        return $this;
    } 

    public function getApprovId()
    {
        return $this->_approvId;
    }

	/************************************************/

	public function setApprovName($approvName)
    {
        $this->_approvName = $approvName;
        return $this;
    } 

    public function getApprovName()
    {
        return $this->_approvName;
    }

    /************************************************/
    public function setApprovDate($approvDate)
    {
        $this->_approvDate = $approvDate;
        return $this;
    } 
   
    public function getApprovDate()
    {
        return $this->_approvDate;
    }
	
	/************************************************/
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