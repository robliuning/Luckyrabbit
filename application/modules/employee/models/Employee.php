<?php

class Employee_Models_Employee
{     
    protected $_empId;
	protected $_deptName;
	protected $_dutyName;
	protected $_status;
    
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
            throw new Exception('Invalid employee property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid employee property');
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
