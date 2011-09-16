<?php
//updated on 30th May by Rob

class Pment_Models_Record
{
	protected $_recId;
	protected $_projectId;
	protected $_recDate;
	protected $_recUnit;
	protected $_content;
	protected $_recNumber;
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
		$method = 'set' . $recNumber;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid record property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid record property');
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
	
	public function setRecId($recId)
	{
		$this->_recId = $recId;
		return $this;
	}

	public function getRecId()
	{
		return $this->_recId;
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

	public function setRecDate($recDate)
	{
		$this->_recDate = $recDate;
		return $this;
	}

	public function getRecDate()
	{
		return $this->_recDate;
	}
	
	/****************************/

	public function setRecUnit($recUnit)
	{
		$this->_recUnit = $recUnit;
		return $this;
	}

	public function getRecUnit()
	{
		return $this->_recUnit;
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

	public function setRecNumber($recNumber)
	{
		$this->_recNumber = $recNumber;
		return $this;
	}

	public function getRecNumber()
	{
		return $this->_recNumber;
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
	public function setcontactName($contactName)
	{
		$this->_contactName = $contactName;
		return $this;
	}

	public function getcontactName()
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