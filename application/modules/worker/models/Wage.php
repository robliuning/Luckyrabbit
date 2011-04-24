<?php
  //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011
class Worker_Models_Wage
{     
    protected $_wagId;
	protected $_amount;
	protected $_startDate;
	protected $_endDate;
	protected $_workerId;
	protected $_workerName;
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
            throw new Exception('Invalid wage property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid wage property');
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

	public function setWagId($wagId)
    {
        $this->_wagId = (int)$wagId;
        return $this;
    } 

    public function getWagId()
    {
        return $this->_wagId;
    }
    
	/************************************************/

	public function setAmount($amount)
    {
        $this->_amount = $amount;
        return $this;
    } 

    public function getAmount()
    {
        return $this->_amount;
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

	public function setEndDate($endDate)
    {
        $this->_endDate = $endDate;
        return $this;
    } 

    public function getEndDate()
    {
        return $this->_endDate;
    }

    /************************************************/
    
    public function setWorkerId($workerId)
    {
        $this->_workerId = $workerId;
        return $this;
    }

    public function getWorkerId()
    {
        return $this->_workerId;
	}

	/************************************************/
    
    public function setWorkerName($workerName)
    {
        $this->_workerName = $workerName;
        return $this;
    }

    public function getWorkerName()
    {
        return $this->_workerName;
	}
	/************************************************/
    
    public function setRemark($remark)
    {
        $this->_remark = $remark;
        return $this;
    }

    public function getRemark()
    {
        return $this->_remark;
	}
}
?>