<?php
//updated in 21th June by Rob

class Pment_Models_Subcontract
{
	protected $_scontrId;
	protected $_projectId;
	protected $_scontrType;
	protected $_contractorId;
	protected $_contractorName;
	protected $_content;
	protected $_detail;
	protected $_quality;
	protected $_startDateExp;
	protected $_endDateExp;
	protected $_periodExp;
	protected $_startDateAct;
	protected $_endDateAct;
	protected $_periodAct;
	protected $_brConContr;
	protected $_brResContr;
	protected $_brConSContr;
	protected $_brResSContr;
	protected $_contrAmt;
	protected $_guarantee;
	protected $_prjMargin;
	protected $_prjWarr;
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
			throw new Exception('Invalid  Subcontract property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid Subcontract property');
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

	public function setScontrId($scontrId)
	{
		$this->_scontrId = (int)$scontrId;
		return $this;
	} 

	public function getScontrId()
	{
		return $this->_scontrId;
	}
	
	public function setProjectId($projectId)
	{
		$this->_projectId = $projectId;
		return $this;
	} 

	public function getProjectId()
	{
		return $this->_projectId;
	}
	

	public function setScontrType($scontrType)
	{
		$this->_scontrType = $scontrType;
		return $this;
	} 

	public function getScontrType()
	{
		return $this->_scontrType;
	}

	
	public function setContractorId($contractorId)
	{
		$this->_contractorId= $contractorId;
		return $this;
	} 

	public function getContractorId()
	{
		return $this->_contractorId;
	}
	
	public function setContractorName($contractorName)
	{
		$this->_contractorName = $contractorName;
		return $this;
	} 

	public function getContractorName()
	{
		return $this->_contractorName;
	}

	public function setContent($content)
	{
		$this->_content = $content;
		return $this;
	} 

	public function getContent()
	{
		return $this->_content;
	}

	public function setDetail($detail)
	{
		$this->_detail= (string) $detail;
		return $this;
	} 

	public function getDetail()
	{
		return $this->_detail;
	}
	
	public function setQuality($quality)
	{
		$this->_quality = $quality;
		return $this;
	} 

	public function getQuality()
	{
		return $this->_quality;
	}

	public function setStartDateExp($startDateExp)
	{
		$this->_startDateExp= $startDateExp;
		return $this;
	}

	public function getStartDateExp()
	{
		return $this->_startDateExp;
	}

		public function setEndDateExp($endDateExp)
	{
		$this->_endDateExp = $endDateExp;
		return $this;
	} 

	public function getEndDateExp()
	{
		return $this->_endDateExp;
	}
	
	public function setPeriodExp($periodExp)
	{
		$this->_periodExp = $periodExp;
		return $this;
	} 

	public function getPeriodExp()
	{
		return $this->_periodExp;
	}

	public function setStartDateAct($startDateAct)
	{
		$this->_startDateAct = $startDateAct;
		return $this;
	} 

	public function getStartDateAct()
	{
		return $this->_startDateAct;
	}

	
	public function setEndDateAct($endDateAct)
	{
		$this->_endDateAct= $endDateAct;
		return $this;
	} 

	public function getEndDateAct()
	{
		return $this->_endDateAct;
	}
	
	public function setPeriodAct($periodAct)
	{
		$this->_periodAct= $periodAct;
		return $this;
	} 

	public function getPeriodAct()
	{
		return $this->_periodAct;
	}
	
	public function setBrConContr($brConContr)
	{
		$this->_brConContr = $brConContr;
		return $this;
	} 

	public function getBrConContr()
	{
		return $this->_brConContr;
	}
 
 	public function setBrResContr($brResContr)
	{
		$this->_brResContr= $brResContr;
		return $this;
	}

	public function getBrResContr()
	{
		return $this->_brResContr;
	}

	 public function setBrConSContr($brConSContr)
	{
		$this->_brConSContr= $brConSContr;
		return $this;
	}

	public function getBrConSContr()
	{
		return $this->_brConSContr;
	}

	public function setBrResSContr($brResSContr)
	{
		$this->_brResSContr = $brResSContr;
		return $this;
	} 

	public function getBrResSContr()
	{
		return $this->_brResSContr;
	}

	public function setContrAmt($contrAmt)
	{
		$this->_contrAmt = $contrAmt;
		return $this;
	} 

	public function getContrAmt()
	{
		return $this->_contrAmt;
	}

	public function setGuarantee($guarantee)
	{
		$this->_guarantee = $guarantee;
		return $this;
	} 

	public function getGuarantee()
	{
		return $this->_guarantee;
	}

	public function setPrjMargin($prjMargin)
	{
		$this->_prjMargin= $prjMargin;
		return $this;
	} 

	public function getPrjMargin()
	{
		return $this->_prjMargin;
	}
	
	public function setPrjWarr($prjWarr)
	{
		$this->_prjWarr = $prjWarr;
		return $this;
	} 

	public function getPrjWarr()
	{
		return $this->_prjWarr;
	}
 
	public function setRemark($remark)
	{
		$this->_remark= $remark;
		return $this;
	}

	public function getRemark()
	{
		return $this->_remark;
	}
	
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
