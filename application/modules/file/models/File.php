<?php
//updated in 23rd June by Rob

class File_Models_File
{
	protected $_fileId;
	protected $_display;
	protected $_name;
	protected $_size;
	protected $_specId;
	protected $_edition;
	protected $_contactId;
	protected $_contactName; 
	protected $_inFlag;
	protected $_projectId;
	protected $_cTime;
	protected $_projFlag;
	protected $_remark;
	protected $_status;
	protected $_type;
	protected $_parent;
	
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
			throw new Exception('Invalid File property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid File property');
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

	public function setFileId($fileId)
	{
		$this->_fileId = $fileId;
		return $this;
	}

	public function getFileId()
	{
		return $this->_fileId;
	}

	/*********************************************/

	public function setDisplay($display)
	{
		$this->_display = $display;
		return $this;
	}

	public function getDisplay()
	{
		return $this->_display;
	}

	/************************************************/
	public function setName($name)
	{
		$this->_name = $name;
		return $this;
	}

	public function getName()
	{
		return $this->_name;
	}

	/************************************************/

	public function setSize($size)
	{
		$this->_size = $size;
		return $this;
	}

	public function getSize()
	{
		return $this->_size;
	}

	/************************************************/

	public function setSpecId($specId)
	{
		$this->_specId = $specId;
		return $this;
	}

	public function getSpecId()
	{
		return $this->_specId;
	}

	/************************************************/

	public function setContactId($contactId)
	{
		$this->_contactId = $contactId;
		return $this;
	}

	public function getContactId()
	{
		return $this->_contactId;
	}

	/************************************************/
	public function setEdition($edition)
	{
		$this->_edition = $edition;
		return $this;
	}

	public function getEdition()
	{
		return $this->_edition;
	}

	/************************************************/

	public function setInFlag($inFlag)
	{
		$this->_inFlag = $inFlag;
		return $this;
	}

	public function getInFlag()
	{
		return $this->_inFlag;
	}

	/************************************************/

	public function setProjectId($projectId)
	{
		$this->_projectId = $projectId;
		return $this;
	}

	public function getProjectId()
	{
		return $this->_projectId;
	}

	/************************************************/
	
	public function setCTime($cTime)
	{
		$this->_cTime = $cTime;
		return $this;
	}

	public function getCTime()
	{
		return $this->_cTime;
	}

	/************************************************/

	public function setContactName($contactName)
	{
		$this->_contactName = $contactName;
		return $this;
	}

	public function getContactName()
	{
		return $this->_contactName;
	}

	/************************************************/

	public function setProjFlag($projFlag)
	{
		$this->_projFlag = $projFlag;
		return $this;
	}

	public function getProjFlag()
	{
		return $this->_projFlag;
	}

	/************************************************/

	public function setRemark($remark)
	{
		$this->_remark = $remark;
		return $this;
	}

	public function getRemark()
	{
		return $this->_remark;
	}

	/************************************************/

	public function setStatus($status)
	{
		$this->_status = $status;
		return $this;
	}

	public function getStatus()
	{
		return $this->_status;
	}

	/************************************************/
	public function setType($type)
	{
		$this->_type = $type;
		return $this;
	}

	public function getType()
	{
		return $this->_type;
	}

	/************************************************/
	public function setParent($parent)
	{
		$this->_parent = $parent;
		return $this;
	}

	public function getParent()
	{
		return $this->_parent;
	}
}
?>