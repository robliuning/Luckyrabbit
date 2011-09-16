<?php
//updated on 30th May by Rob

class Pment_Models_Comment
{
	protected $_cId;
	protected $_mtrId;
	protected $_contactId;
	protected $_contactName;
	protected $_addDate;
	protected $_comment;

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
	
	public function setCId($cId)
	{
		$this->_cId = $cId;
		return $this;
	}

	public function getCId()
	{
		return $this->_cId;
	}

	/****************************/

	public function setMtrId($mtrId)
	{
		$this->_mtrId = $mtrId;
		return $this;
	}

	public function getMtrId()
	{
		return $this->_mtrId;
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
		
	public function setComment($comment)
	{
		$this->_comment = $comment;
		return $this;
	}

	public function getComment()
	{
		return $this->_comment;
	}
}
?>