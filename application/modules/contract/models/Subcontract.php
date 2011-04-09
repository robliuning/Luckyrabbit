<?php

class Contract_Models_Subcontract
{     
    protected $_scontrId;
    protected $_projectId;
	protected $_scontrType;
	protected $_contractorId;
	protected $_scontrDetail;
	protected $_quality;
	protected $_startDateExp;
	protected $_endDateExp;
	protected $_periodExp;
	protected $_startDateAct;
	protected $_endDateAct;
	protected $_periodAct;
	protected $_brConContr;
	protected $_brResContr;
	protected $_brConSContr;
	protected $_brResSContr;
	protected $_warranty;
	protected $_contrAmt;
	protected $_consMargin;
	protected $_prjMargin;
	protected $_prjWarr;
	protected $_remark;

    
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
            throw new Exception('Invalid  Subcontract property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Subcontract property');
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

	public function setEmpId($empId)
    {
        $this->_empId = (int)$empId;
        return $this;
    } 

    public function getEmpId()
    {
        return $this->_empId;
    }
    
    public function setEmpName($empName)
    {
        $this->_empName = $empName;
        return $this;
    } 

    public function getEmpName()
    {
        return $this->_empName;
    }

    public function setDeptName($deptName)
    {
        $this->_deptName = (string)$deptName;
        return $this;
    } 

    public function getDeptName()
    {
        return $this->_deptName;
    }

	
    public function setDutyName($dutyName)
    {
        $this->_dutyName= (string) $dutyName;
        return $this;
    } 

    public function getDutyName()
    {
        return $this->_dutyName;
    }
    
    public function setTitleName($titleName)
    {
        $this->_titleName= (string) $titleName;
        return $this;
    } 

    public function getTitleName()
    {
        return $this->_titleName;
    }
    
    public function setPhoneNo($phoneNo)
    {
        $this->_phoneNo = $phoneNo;
        return $this;
    } 

    public function getPhoneNo()
    {
        return $this->_phoneNo;
    }
 
     public function setStatus($status)
    {
        $this->_status= $status;
        return $this;
    }

    public function getStatus()
    {
        return $this->_status;
	}
}
?>
