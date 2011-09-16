<?php
//updated on 24th May by Rob

class Pment_Models_Plog
{
	protected $_plogId;
	protected $_projectId;
	protected $_logDate;
	protected $_weatherAm;
	protected $_weatherPm;
	protected $_tempHi;
	protected $_tempLo;
	protected $_part;
	protected $_number;
	protected $_operator;
	protected $_foreman;
	protected $_safety;
	protected $_problem;
	protected $_resolve;
	protected $_relatedFile;
	protected $_changeSig;
	protected $_material;
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
			throw new Exception('Invalid mst property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid mst property');
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
	
	public function setPlogId($plogId)
	{
		$this->_plogId = $plogId;
		return $this;
	}

	public function getPlogId()
	{
		return $this->_plogId;
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
	public function setLogDate($logDate)
	{
		$this->_logDate = $logDate;
		return $this;
	}

	public function getLogDate()
	{
		return $this->_logDate;
	}

	/****************************/
	public function setWeatherAm($weatherAm)
	{
		$this->_weatherAm = $weatherAm;
		return $this;
	}

	public function getWeatherAm()
	{
		return $this->_weatherAm;
	}

	/****************************/
	public function setWeatherPm($weatherPm)
	{
		$this->_weatherPm = $weatherPm;
		return $this;
	}

	public function getWeatherPm()
	{
		return $this->_weatherPm;
	}

	/****************************/
	public function setTempHi($tempHi)
	{
		$this->_tempHi = $tempHi;
		return $this;
	}

	public function getTempHi()
	{
		return $this->_tempHi;
	}

	/****************************/
	public function setTempLo($tempLo)
	{
		$this->_tempLo = $tempLo;
		return $this;
	}

	public function getTempLo()
	{
		return $this->_tempLo;
	}

	/****************************/
	public function setPart($part)
	{
		$this->_part = $part;
		return $this;
	}

	public function getPart()
	{
		return $this->_part;
	}

	/****************************/
	public function setNumber($number)
	{
		$this->_number = $number;
		return $this;
	}

	public function getNumber()
	{
		return $this->_number;
	}

	/****************************/
	public function setOperator($operator)
	{
		$this->_operator = $operator;
		return $this;
	}

	public function getOperator()
	{
		return $this->_operator;
	}

	/****************************/
	public function setForeman($foreman)
	{
		$this->_foreman = $foreman;
		return $this;
	}

	public function getForeman()
	{
		return $this->_foreman;
	}

	/****************************/
	public function setSafety($safety)
	{
		$this->_safety = $safety;
		return $this;
	}

	public function getSafety()
	{
		return $this->_safety;
	}

	/****************************/
	public function setProblem($problem)
	{
		$this->_problem = $problem;
		return $this;
	}

	public function getProblem()
	{
		return $this->_problem;
	}

	/****************************/
	public function setResolve($resolve)
	{
		$this->_resolve = $resolve;
		return $this;
	}

	public function getResolve()
	{
		return $this->_resolve;
	}

	/****************************/
	public function setRelatedFile($relatedFile)
	{
		$this->_relatedFile = $relatedFile;
		return $this;
	}

	public function getRelatedFile()
	{
		return $this->_relatedFile;
	}

	/****************************/
	public function setChangeSig($changeSig)
	{
		$this->_changeSig = $changeSig;
		return $this;
	}

	public function getChangeSig()
	{
		return $this->_changeSig;
	}

	/****************************/
	public function setMaterial($material)
	{
		$this->_material = $material;
		return $this;
	}

	public function getMaterial()
	{
		return $this->_material;
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