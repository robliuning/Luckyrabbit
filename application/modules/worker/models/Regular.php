<?php
  //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011
class Worker_Models_Regular
{     
    protected $_regId;
	protected $_projectId;
	protected $_projectName;
	protected $_item;
	protected $_number;
	protected $_startDate;
	protected $_endDate;
	protected $_period;
	protected $_budget;
	protected $_cost;
	protected $_profit;
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
            throw new Exception('Invalid regular property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid regular property');
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

	public function setRegId($regId)
    {
        $this->_regId = (int)$regId;
        return $this;
    } 

    public function getRetId()
    {
        return $this->_regId;
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

	public function setItem($item)
    {
        $this->_item = $item;
        return $this;
    } 

    public function getItem()
    {
        return $this->_item;
    }

	/************************************************/

	public function setNumber($number)
    {
        $this->_number = (int)$number;
        return $this;
    } 

    public function getNumber()
    {
        return $this->_number;
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

	public function setBudget($budget)
    {
        $this->_budget = $budget;
        return $this;
    } 

    public function getBudget()
    {
        return $this->_budget;
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

	public function setProfit($profit)
    {
        $this->_profit = $profit;
        return $this;
    } 

    public function getProfit()
    {
        return $this->_profit;
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