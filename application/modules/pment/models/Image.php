<?php
//updated on 24th May by Rob

class Pment_Models_Image
{
	protected $_imageId;
	protected $_projectId;
	protected $_prgType;
	protected $_prgId;
	protected $_imageSn;
	protected $_description;
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
			throw new Exception('Invalid image property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid image property');
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
	
	public function setImageId($imageId)
	{
		$this->_imageId = $imageId;
		return $this;
	}

	public function getImageId()
	{
		return $this->_imageId;
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
	public function setPrgType($prgType)
	{
		$this->_prgType = $prgType;
		return $this;
	}

	public function getPrgType()
	{
		return $this->_prgType;
	}

	/****************************/
	public function setPrgId($prgId)
	{
		$this->_prgId = $prgId;
		return $this;
	}

	public function getPrgId()
	{
		return $this->_prgId;
	}

	/****************************/
	public function setImageSn($imageSn)
	{
		$this->_imageSn = $imageSn;
		return $this;
	}

	public function getImageSn()
	{
		return $this->_imageSn;
	}

	/****************************/
	public function setDescription($description)
	{
		$this->_description = $description;
		return $this;
	}

	public function getDescription()
	{
		return $this->_description;
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