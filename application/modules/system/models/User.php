<?php
//updated in 9th June by Rob

class System_Models_User
{
	protected $_id;
	protected $_userName;
	protected $_password;
	protected $_salt;
	protected $_role;
	protected $_contactId;
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
			throw new Exception('Invalid user property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid user property');
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

	public function setId($id)
	{
		$this->_id = (int)$id;
		return $this;
	}

	public function getId()
	{
		return $this->_id;
	}

	public function setUserName($userName)
	{
		$this->_userName= (int)$userName;
		return $this;
	} 

	public function getUserName()
	{
		return $this->_userName;
	}

	public function setPassword($password)
	{
		$this->_password= (int)$password;
		return $this;
	} 

	public function getPassword()
	{
		return $this->_password;
	}

	public function setSalt($salt)
	{
		$this->_salt= (int)$salt;
		return $this;
	} 

	public function getSalt()
	{
		return $this->_salt;
	}

	public function setRole($role)
	{
		$this->_role= (int)$role;
		return $this;
	} 

	public function getRole()
	{
		return $this->_role;
	}

	public function setContactId($contactId)
	{
		$this->_contactId= (int)$contactId;
		return $this;
	} 

	public function getContactId()
	{
		return $this->_contactId;
	}

	public function setCTime($cTime)
	{
		$this->_cTime= (int)$cTime;
		return $this;
	} 

	public function getCTime()
	{
		return $this->_cTime;
	}
}
?>
