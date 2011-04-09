<?php
//creation date 09-04-2011
  //creating by lincoy
  //completion date 09-04-2011

calss Vehicle_Models_Vehicle
{
	protected $_recordId;
	protected $_plateNo;
	protected $_startDate;
	protected $_endDate;
	protected $_purpose;
	protected $_mile;
	protected $_pilot;
	protected $_otherUser;
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
            throw new Exception('Invalid vehicle property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid vehicle property');
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

   /********************************************/
	public function setRecordId($recordId)
	{
		$this->_recordId = $recordId;
		return $this;
	}

	public function getRecordId()
	{
		return $this->_recordId;
	}

	/********************************************/
	public function setPlateNo($plateNo)
	{
		$this->_plateNo = $plateNo;
		return $this;
	}

	public function getPlateNo()
	{
		return $this->_plateNo;
	}

	/********************************************/
	public function setStartDate($startDate)
	{
		$this->_startDate = $startDate;
		return $this;
	}

	public function getStartDate()
	{
		return $this->_startDate;
	}

	/********************************************/
	public function set($)
	{
		$this->_ = $;
		return $this;
	}

	public function get()
	{
		return $this->_;
	}

	/********************************************/
	public function set($)
	{
		$this->_ = $;
		return $this;
	}

	public function get()
	{
		return $this->_;
	}

	/********************************************/
	public function set($)
	{
		$this->_ = $;
		return $this;
	}

	public function get()
	{
		return $this->_;
	}

	/********************************************/
	public function set($)
	{
		$this->_ = $;
		return $this;
	}

	public function get()
	{
		return $this->_;
	}

	/********************************************/
	public function set($)
	{
		$this->_ = $;
		return $this;
	}

	public function get()
	{
		return $this->_;
	}

	/********************************************/
	public function set($)
	{
		$this->_ = $;
		return $this;
	}

	public function get()
	{
		return $this->_;
	}

	/********************************************/
	public function set($)
	{
		$this->_ = $;
		return $this;
	}

	public function get()
	{
		return $this->_;
	}
}