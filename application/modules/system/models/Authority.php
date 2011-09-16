<?php
//updated in 13th July by Rob

class System_Models_Authority
{
	protected $_id;
	protected $_groupId;
	protected $_modId;
	protected $_modName;
	protected $_modPriv;

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
			throw new Exception('Invalid Authority property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid authority property');
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

	public function setGroupId($groupId)
	{
		$this->_groupId= (int)$groupId;
		return $this;
	} 

	public function getGroupId()
	{
		return $this->_groupId;
	}

	public function setModId($modId)
	{
		$this->_modId= (int)$modId;
		return $this;
	} 

	public function getModId()
	{
		return $this->_modId;
	}

	public function setModName($modName)
	{
		$this->_modName= $modName;
		return $this;
	} 

	public function getModName()
	{
		return $this->_modName;
	}

	public function setModPriv($modPriv)
	{
		$this->_modPriv= (int)$modPriv;
		return $this;
	} 

	public function getModPriv()
	{
		return $this->_modPriv;
	}
}
?>
