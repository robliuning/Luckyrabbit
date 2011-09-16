<?php
//updated on 30th May by Rob

class Pment_Models_Reviewer
{
	protected $_reId;
	protected $_planId;
	protected $_contactId;
	protected $_contactName;
	protected $_addDate;
	protected $_status;
	protected $_statusName;

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
			throw new Exception('Invalid Reviewer property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid Reviewer property');
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
	
	public function setReId($reId)
	{
		$this->_reId = $reId;
		return $this;
	}

	public function getReId()
	{
		return $this->_reId;
	}

	/****************************/

	public function setPlanId($planId)
	{
		$this->_planId = $planId;
		return $this;
	}

	public function getPlanId()
	{
		return $this->_planId;
	}

	/****************************/

	public function setContactId($contactId)
	{
		$this->_contactId = $contactId;
		return $this;
	}

	public function getContactId()
	{
		return $this->_contactId;
	}

	/****************************/
	
	public function setContactName($contactName)
	{
		$this->_contactName = $contactName;
		return $this;
	}

	public function getContactName()
	{
		return $this->_contactName;
	}

	/****************************/
		
	public function setAddDate($addDate)
	{
		$this->_addDate = $addDate;
		return $this;
	}

	public function getAddDate()
	{
		return $this->_addDate;
	}
	
	/****************************/
		
	public function setStatus($status)
	{
		$this->_status = $status;
		return $this;
	}

	public function getStatus()
	{
		return $this->_status;
	}
	
	/****************************/
		
	public function setStatusName($statusName)
	{
		$this->_statusName = $statusName;
		return $this;
	}

	public function getStatusName()
	{
		return $this->_statusName;
	}
}
?>