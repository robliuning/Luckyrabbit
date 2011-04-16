<?php
 //creation date 15-04-2011
  //creating by lincoy
  //completion date 15-04-2011 
class Material_Models_Plan
{     
    protected $_planId;
    protected $_planType;
	protected $_projectId;
	protected $_projectName; //from pm_projects
	protected $_dueDate;
	protected $_applicId;
	protected $_applicName; //from em_contacts 
	protected $_applicDate;
	protected $_approvId;
	protected $_approvName; //from em_contacts
	protected $_approvDate;
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

    /*******************************************/
	public function setPlanId($planId)
    {
        $this->_planId = (int)$planId;
        return $this;
    } 

    public function getPlanId()
    {
        return $this->_planId;
    }
    

	/*******************************************/
    public function setPlanType($planType)
    {
        $this->_planType = $planType;
        return $this;
    } 

    public function getPlanType()
    {
        return $this->_planType;
    }
    

	/*******************************************/
    public function setProjectId($projectId)
    {
        $this->_projectId = (int)$projectId;
        return $this;
    } 

    public function getProjectId()
    {
        return $this->_projectId;
    }

    /*******************************************/
	public function setProjectName($projectName)
    {
        $this->_projectName = $projectName;
        return $this;
    } 

    public function getProjectName()
    {
        return $this->_projectName;
    }
	

	/*******************************************/
    public function setDueDate($dueDate)
    {
        $this->_dueDate = $dueDate;
        return $this;
    } 

    public function getDueDate()
    {
        return $this->_dueDate;
    }
    

	/*******************************************/
    public function setApplicId($applicId)
    {
        $this->_applicId = $applicId;
        return $this;
    } 

    public function getApplicId()
    {
        return $this->_applicId;
    }

	/*******************************************/
    public function setApplicName($applicName)
    {
        $this->_applicName = $applicName;
        return $this;
    } 

    public function getApplicName()
    {
        return $this->_applicName;
    }
    
	/*******************************************/
    public function setApplicDate($applicDate)
    {
        $this->_applicDate = $applicDate;
        return $this;
    } 

    public function getApplicDate()
    {
        return $this->_applicDate;
    }

    /*******************************************/
    public function setApprovId($approvId)
    {
        $this->_approvId = $approvId;
        return $this;
    } 

    public function getApprovId()
    {
        return $this->_approvId;
    }
    

	/*******************************************/
    public function setApprovName($approvName)
    {
        $this->_approvName = $approvName;
        return $this;
    } 

    public function getApprovName()
    {
        return $this->_approvName;
    }
    

	/*******************************************/
    public function setApprovDate($approvDate)
    {
        $this->_approvDate = $approvDate;
        return $this;
    } 

    public function getApprovDate()
    {
        return $this->_approvDate;
    }
    
	/*******************************************/
	public function setTotal($total)
    {
        $this->_total = $total;
        return $this;
    }

    public function getTotal()
    {
        return $this->_total;
	}
    

	/*******************************************/
    public function setRemark($remark)
    {
        $this->_remark= $remark;
        return $this;
    }

    public function getRemark()
    {
        return $this->_remark;
	}
	
	/*******************************************/
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
