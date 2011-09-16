<?php
//updated in 14th July by Rob

class System_Models_Improvement
{
	protected $_id;
	protected $_typeId;
	protected $_typeName;
	protected $_userId;
	protected $_contactId;
	protected $_contactName;
	protected $_priority;
	protected $_description;
	protected $_iTime;
	protected $_modId;
	protected $_modNameCh;
	protected $_status;
	protected $_statusCh;

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
			throw new Exception('Invalid improvement property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid improvement property');
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

	public function setTypeId($typeId)
	{
		$this->_typeId= $typeId;
		return $this;
	} 

	public function getTypeId()
	{
		return $this->_typeId;
	}

	public function setTypeName($typeName)
	{
		$this->_typeName= $typeName;
		return $this;
	} 

	public function getTypeName()
	{
		return $this->_typeName;
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

	public function setPriority($priority)
	{
		$this->_priority= $priority;
		return $this;
	} 

	public function getPriority()
	{
		return $this->_priority;
	}

	public function setDescription($description)
	{
		$this->_description= $description;
		return $this;
	} 

	public function getDescription()
	{
		return $this->_description;
	}

	public function setITime($iTime)
	{
		$this->_iTime= $iTime;
		return $this;
	} 

	public function getITime()
	{
		return $this->_iTime;
	}

	public function setModId($modId)
	{
		$this->_modId= $modId;
		return $this;
	} 

	public function getModId()
	{
		return $this->_modId;
	}

	public function setModNameCh($modNameCh)
	{
		$this->_modNameCh= $modNameCh;
		return $this;
	} 

	public function getModNameCh()
	{
		return $this->_modNameCh;
	}
		
	public function setStatus($status)
	{
		$this->_status= $status;
		return $this;
	} 

	public function getStatus()
	{
		return $this->_status;
	}
		
	public function setStatusCh($statusCh)
	{
		$this->_statusCh= $statusCh;
		return $this;
	} 

	public function getStatusCh()
	{
		return $this->_statusCh;
	}

	public function setcontactId($contactId)
	{
		$this->_contactId= $contactId;
		return $this;
	} 

	public function getcontactId()
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
}
?>
