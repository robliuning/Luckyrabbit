<?php
//updated in 18th July 2011 by luoxinji
//元素
//id,userId,contactId,contactName,timer

class System_Models_Online
{
	protected $_id;
	protected $_userId;
	protected $_contactId;
	protected $_contactName;
	protected $_timer;

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
			throw new Exception('Invalid Online property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid Online property');
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

	public function setId($Id)
	{
		$this->_id = (int)$Id;
		return $this;
	}

	public function getId()
	{
		return $this->_id;
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
		$this->_contactId= $contactId;
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
	
	public function setTimer($timer)
	{
		$this->_timer = $timer;
		return $this;
	}
	
	public function GetTimer()
	{
		return $this->_timer;
	}
}

?>