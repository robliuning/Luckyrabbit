<?php
//updated in 9th June by Rob

class System_Models_User
{
	protected $_id;
	protected $_userName;
	protected $_password;
	protected $_salt;
	protected $_groupId;
	protected $_groupName;
	protected $_contactId;
	protected $_contactName;
	protected $_creatorId;
	protected $_creatorCid;
	protected $_creatorCname;
	protected $_eTime;
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
		$this->_userName= $userName;
		return $this;
	} 

	public function getUserName()
	{
		return $this->_userName;
	}

	public function setPassword($password)
	{
		$this->_password= $password;
		return $this;
	} 

	public function getPassword()
	{
		return $this->_password;
	}

	public function setSalt($salt)
	{
		$this->_salt= $salt;
		return $this;
	} 

	public function getSalt()
	{
		return $this->_salt;
	}

	public function setGroupId($groupId)
	{
		$this->_groupId= (int)$groupId;
		return $this;
	} 

	public function getGroupId()
	{
		return $this->_groupId;
	}

	public function setGroupName($groupName)
	{
		$this->_groupName= $groupName;
		return $this;
	} 

	public function getGroupName()
	{
		return $this->_groupName;
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

	public function setContactName($contactName)
	{
		$this->_contactName= $contactName;
		return $this;
	} 

	public function getContactName()
	{
		return $this->_contactName;
	}
	
	public function setCreatorId($creatorId)
	{
		$this->_creatorId= $creatorId;
		return $this;
	} 

	public function getCreatorId()
	{
		return $this->_creatorId;
	}
	
	public function setCreatorCid($creatorCid)
	{
		$this->_creatorCid= $creatorCid;
		return $this;
	} 

	public function getCreatorCid()
	{
		return $this->_creatorCid;
	}
	
	public function setCreatorCname($creatorCname)
	{
		$this->_creatorCname= $creatorCname;
		return $this;
	} 

	public function getCreatorCname()
	{
		return $this->_creatorCname;
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
	
	public function setETime($eTime)
	{
		$this->_eTime= $eTime;
		return $this;
	} 

	public function getETime()
	{
		return $this->_eTime;
	}
}
?>
