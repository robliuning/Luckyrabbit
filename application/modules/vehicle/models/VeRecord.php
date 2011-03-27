<?php
/*
created by lincoy
time of creating 3-27-2011
completed time 3-27-2011
*/

class Application_Model_VeRecord{
     protected $_recordID;  //车辆使用记录编号
	 protected $_name;      //车辆名称
	 protected $_dateOfUse;      //使用日期
	 protected $_purpose;   //使用目的
	 protected $_milesBf;   //出车公里数
	 protected $_milesAf;   //还车公里数
	 protected $_pilot;     //驾驶人员
	 protected $_otherUsers;//其他使用人员
	 protected $_remark;    //备注


	 public function __construct(array $options=null)
	 {
		if(is_array($optionas)){
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

	public function setRecordID($recordID)
	{
		$this->_recordID = $recordID;
		return $this;
	}

	public function getRecord()
	{
		return $this->_recordID;
	}

	public function setName($name)
	{
		$this->_name = $name;
		return $this;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function setDateOfUse($dateOfUse)
	{
		$this->_dateOfUse = $dateOfUse;
		return $this;
	}

	public function getDateOfUse()
	{
		return $this->_dateOfUse;
	}

	public function setPurpose($purpose)
	{
		$this->_purpose = $purpose;
		return $this;
	}

	public function getPurpose()
	{
		return $this->_purpose;
	}

	public function setMilesBf($milesBf)
	{
		$this->_milesBf = $milesBf;
		return $this;
	}

	public function getMilesBf()
	{
		return $this->_milesBf;
	}

	public function setMilesAf($milesAf)
	{
		$this->_milesAf = $milesAf;
		return $this;
	}


	public function getMilesAf()
	{
		return $this->_milesAf;
	}

	public function setPilot($pilot)
	{
		$this->_pilot = $pilot;
		return $this;
	}

	public function getPilot()
	{
		return $this->_pilot;
	}

	public function  setOtherUsers($otherUsers)
	{
		$this->_otherUsers = $otherUsers;
		return $this;
	}

	public function getOtherUsers()
	{
		return $this->_otherUsers;
	}

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