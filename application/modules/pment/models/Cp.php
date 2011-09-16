<?php
//updated in 9th June by Rob

class Pment_Models_Cp
{
	protected $_cpId;
	protected $_projectId;
	protected $_contractorId;
	protected $_contractorName;

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
			throw new Exception('Invalid cp property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid cp property');
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

	public function setCpId($cpId)
	{
		$this->_cpId = (int)$cpId;
		return $this;
	}

	public function getCpId()
	{
		return $this->_cpId;
	}

	public function setContractorId($contractorId)
	{
		$this->_contractorId= (int)$contractorId;
		return $this;
	} 

	public function getContractorId()
	{
		return $this->_contractorId;
	}

	public function setProjectId($projectId)
	{
		$this->_projectId= $projectId;
		return $this;
	} 

	public function getProjectId()
	{
		return $this->_projectId;
	}
	
	public function setContractorName($contractorName)
	{
		$this->_contractorName= (string)$contractorName;
		return $this;
	} 

	public function getContractorName()
	{
		return $this->_contractorName;
	}
}
?>
