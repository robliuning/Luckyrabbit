<?php
//updated in 18th July 2011 by luoxinji
//元素
//id,userId,contactId,contactName,timer

class System_Models_Priv
{
	protected $_privId;
	protected $_groupId;
	protected $_modId;
	protected $_modEName;
	protected $_modCName;
	protected $_conId;
	protected $_conName;
	protected $_actId;
	protected $_actEName;
	protected $_actCName;
	protected $_sidName;
	protected $_priv;

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
			throw new Exception('Invalid Priv property');
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

	public function setPrivId($privId)
	{
		$this->_privId = (int)$privId;
		return $this;
	}

	public function getPrivId()
	{
		return $this->_privId;
	}
	
	public function setGroupId($groupId)
	{
		$this->_groupId = (int)$groupId;
		return $this;
	}

	public function getGroupId()
	{
		return $this->_groupId	;
	}
	
	public function setModId($modId)
	{
		$this->_modId = (int)$modId;
		return $this;
	}

	public function getModId()
	{
		return $this->_modId;
	}
	
	public function setModEName($modEName)
	{
		$this->_modEName = $modEName;
		return $this;
	}

	public function getModEName()
	{
		return $this->_modEName;
	}
	
	public function setModCName($modCName)
	{
		$this->_modCName = $modCName;
		return $this;
	}

	public function getModCName()
	{
		return $this->_modCName;
	}
	
	public function setConId($conId)
	{
		$this->_conId = (int)$conId;
		return $this;
	}

	public function getConId()
	{
		return $this->_conId;
	}
	
	public function setConName($conName)
	{
		$this->_conName = $conName;
		return $this;
	}

	public function getConName()
	{
		return $this->_conName;
	}
	
	public function setActId($actId)
	{
		$this->_actId = (int)$actId;
		return $this;
	}

	public function getActId()
	{
		return $this->_actId;
	}
	
	public function setActEName($actEName)
	{
		$this->_actEName = $actEName;
		return $this;
	}

	public function getActEName()
	{
		return $this->_actEName;
	}

	public function setActCName($actCName)
	{
		$this->_actCName = $actCName;
		return $this;
	}

	public function getActCName()
	{
		return $this->_actCName;
	}
	
	public function setSidName($sidName)
	{
		$this->_sidName = $sidName;
		return $this;
	}

	public function getSidName()
	{
		return $this->_sidName;
	}

	public function setPriv($priv)
	{
		$this->_priv = (int)$priv;
		return $this;
	}

	public function getPriv()
	{
		return $this->_priv;
	}
}

?>