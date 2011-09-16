<?php
//updated in 18th July by luoxinji
//元素
//logId
//userId
//logType
//cTime

class System_Models_Ulog
{
	protected $_logId;
	protected $_userId;
	protected $_contactId;
	protected $_contactName;
	protected $_logType;
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
			throw new Exception('Invalid Ulog property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid Ulog property');
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

	public function setLogId($logId)
	{
		$this->_logId = (int)$logId;
		return $this;
	}

	public function getLogId()
	{
		return $this->_logId;
	}

	public function setUserId($userId)
	{
		$this->_userId= $userId;
		return $this;
	} 

	public function getUserId()
	{
		return $this->_userId;
	}

	public function setContactId($contactId)
	{
		$this->_contactId = (int)$contactId;
		return $this;
	}

	public function getContactId()
	{
		return $this->_contactId;
	}

	public function setContactName($contactName)
	{
		$this->_contactName= $contactName;
		return $this;
	} 

	public function getContactName()
	{
		return $this->_contactName;
	}
	
	public function setLogType($logType)
	{
		$this->_logType= $logType;
		return $this;
	} 

	public function getLogType()
	{
		return $this->_logType;
	}

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