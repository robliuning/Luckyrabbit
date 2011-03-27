<?php
/*
created by lincoy
time of creating 3-27-2011
completed time 3-27-2011
*/

class Application_Model_Vehicle{
     protected $_plateNo; //车牌号
	 protected $_name;    //车辆名称
	 protected $_license; //车辆行驶证
	 protected $_personIC;//车辆负责人
	 protected $_users;   //主要使用人员
	 protected $_fuelCons;//标准油耗
	 protected $_remark;  //备注

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

	public function setPlateNo($plateNo)
	{
		$this->_plateNo = $plateNo;
		return $this;
	}

	public function getPlateNo()
	{
		return $this->_plateNo;
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

	public function setLicense($license)
	{
		$this->__license = $license;
		return $this;
	}

	public function getLicense()
	{
		return $this->_license;
	}
	
	public function setPersonIC($personIC)
	{
		$this->_personIC = $personIC;
		return $this;
	}

	public function getPersonIC()
	{
		return $this->_personIC;
	}

	public function setUsers($users)
	{
		$this->_users = $users;
		return $this;
	}

	public function getUsers()
	{
		return $this->_users;
	}

	public function setFuelCons($fuleCons)
	{
		$this->_fuelCons = $fuleCons;
		return $this;
	}

	public function getFuleCons()
	{
		return  $this->_fuleCons;
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