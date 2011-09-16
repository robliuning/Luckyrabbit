<?php
//updated in 9th June by Rob

class Pment_Models_Bhistory
{
	protected $_hiId;
	protected $_planId;
	protected $_contactId;
	protected $_contactName;
	protected $_editDate;
	protected $_status;
	protected $_editType;

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
			throw new Exception('Invalid bhistory property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid bhistory property');
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

	public function setHiId($hiId)
	{
		$this->_hiId = (int)$hiId;
		return $this;
	}

	public function getHiId()
	{
		return $this->_hiId;
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

	public function setPlanId($planId)
	{
		$this->_planId= $planId;
		return $this;
	} 

	public function getPlanId()
	{
		return $this->_planId;
	}
	
	public function setContactName($contactName)
	{
		$this->_contactName= (string)$contactName;
		return $this;
	} 

	public function getContactName()
	{
		return $this->_contactName;
	}
	
	public function setEditDate($editDate)
	{
		$this->_editDate= $editDate;
		return $this;
	} 

	public function getEditDate()
	{
		return $this->_editDate;
	}
	
	public function setStatus($status)
	{
		$this->_status = $status;
		return $this;
	}

	public function getStatus()
	{
		return $this->_status;
	}
	
	public function setEditType($editType)
	{
		$this->_editType = $editType;
		return $this;
	}

	public function getEditType()
	{
		return $this->_editType;
	}
}
?>
