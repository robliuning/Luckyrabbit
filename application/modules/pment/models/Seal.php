<?php
//updated on 30th May by Rob

class Pment_Models_Seal
{
	protected $_seaId;
	protected $_projectId;
	protected $_name;
	protected $_sealFile;
	protected $_sealUser;
	protected $_contactId;
	protected $_contactName;
	protected $_reason;
	protected $_sealDate;
	protected $_returnDate;
	protected $_copy;
	protected $_takeOut;
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
			throw new Exception('Invalid seal property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid seal property');
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
	
	public function setSeaId($seaId)
	{
		$this->_seaId = $seaId;
		return $this;
	}

	public function getSeaId()
	{
		return $this->_seaId;
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

	public function setSealFile($sealFile)
	{
		$this->_sealFile = $sealFile;
		return $this;
	}

	public function getSealFile()
	{
		return $this->_sealFile;
	}

	/****************************/

	public function setSealUser($sealUser)
	{
		$this->_sealUser = $sealUser;
		return $this;
	}

	public function getSealUser()
	{
		return $this->_sealUser;
	}

	/****************************/

	public function setReason($reason)
	{
		$this->_reason = $reason;
		return $this;
	}

	public function getReason()
	{
		return $this->_reason;
	}

	/****************************/

	public function setSealDate($sealDate)
	{
		$this->_sealDate = $sealDate;
		return $this;
	}

	public function getSealDate()
	{
		return $this->_sealDate;
	}
	
	/****************************/

	public function setReturnDate($returnDate)
	{
		$this->_returnDate = $returnDate;
		return $this;
	}

	public function getreturnDate()
	{
		return $this->_returnDate;
	}

	/****************************/

	public function setCopy($copy)
	{
		$this->_copy = $copy;
		return $this;
	}

	public function getCopy()
	{
		return $this->_copy;
	}

	/****************************/

	public function setTakeOut($takeOut)
	{
		$this->_takeOut = $takeOut;
		return $this;
	}

	public function getTakeOut()
	{
		return $this->_takeOut;
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