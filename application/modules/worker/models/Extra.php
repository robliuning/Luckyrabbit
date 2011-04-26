<?php
  //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011
class Worker_Models_Extra
{     
    protected $_extId;
	protected $_projectId;
	protected $_projectName;
	protected $_workerId;
	protected $_workerName;
	protected $_startDate;
	protected $_endDate;
	protected $_period;
	protected $_cost;
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
            throw new Exception('Invalid extra property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid extra property');
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

	public function setExtId($extId)
    {
        $this->_extId = (int)$extId;
        return $this;
    } 

    public function getExtId()
    {
        return $this->_extId;
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

	public function setPeriod($period)
    {
        $this->_period = $period;
        return $this;
    } 

    public function getPeriod()
    {
        return $this->_period;
    }

	/************************************************/

	public function setCost($cost)
    {
        $this->_cost = $cost;
        return $this;
    } 

    public function getCost()
    {
        return $this->_cost;
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

	/************************************************/

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