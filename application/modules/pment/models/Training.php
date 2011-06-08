<?php
//updated on 30th May by Rob

class Pment_Models_Training
{
	protected $_traId;
	protected $_projectId;
	protected $_traDate;
	protected $_content;
	protected $_name;
	protected $_contactId;
	protected $_contactName;
	protected $_remark;
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
			throw new Exception('Invalid training property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid training property');
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
	
	public function setTraId($traId)
	{
		$this->_traId = $traId;
		return $this;
	}

	public function getTraId()
	{
		return $this->_traId;
	}

	/****************************/

	public function setProjectId($projectId)
	{
		$this->_projectId = $projectId;
		return $this;
	}

	public function getProjectId()
	{
		return $this->_projectId;
	}

	/****************************/

	public function setTraDate($traDate)
	{
		$this->_traDate = $traDate;
		return $this;
	}

	public function getTraDate()
	{
		return $this->_traDate;
	}

	/****************************/
	
	public function setContent($content)
	{
		$this->_content = $content;
		return $this;
	}

	public function getContent()
	{
		return $this->_content;
	}

	/****************************/
		
	public function setName($name)
	{
		$this->_name = $name;
		return $this;
	}

	public function getName()
	{
		return $this->_name;
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
	public function setRemark($remark)
	{
		$this->_remark = $remark;
		return $this;
	}

	public function getRemark()
	{
		return $this->_remark;
	}
	
	/****************************/
	public function setCTime($cTime)
	{
		$this->_cTime = $cTime;
		return $this;
	}

	public function getCTime()
	{
		return $this->_cTime;
	}
}
?>