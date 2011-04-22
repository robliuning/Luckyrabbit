<?php
  //creation date 22-04-2011
  //creating by lincoy
  //completion date 22-04-2011
class Worker_Models_Penalty
{
	protected $_penId;
	protected $_projectId;
	protected $_projectName;
	protected $_workerId;
	protected $_workerName;
	protected $_penDate;
	protected $_typeId;
	protected $_typeName;
	protected $_detail;
	protected $_amount;
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
            throw new Exception('Invalid penalty property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid penalty property');
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

	public function setPenId($penId)
    {
        $this->_penId = (int)$penId;
        return $this;
    }

    public function getPenId()
    {
        return $this->_penId;
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
        $this->_workId = $workerId;
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

	public function setPenDate($penDate)
    {
        $this->_penDate = $penDate;
        return $this;
    }

    public function getPenDate()
    {
        return $this->_penDate;
    }

	/************************************************/

	public function setTypeId($typeId)
    {
        $this->_typeId = $typeId;
        return $this;
    }

    public function getTypeId()
    {
        return $this->_typeId;
    }

    /************************************************/

	public function setTypeName($typeName)
    {
        $this->_typeName = $typeName;
        return $this;
    }

    public function getTypeName()
    {
        return $this->_typeName;
    }

	/************************************************/

	public function setDetail($detail)
    {
        $this->_detail = $detail;
        return $this;
    }

    public function getDetail()
    {
        return $this->_detail;
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