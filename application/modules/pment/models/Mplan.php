<?php
//Updated in 4th July by Rob

class Pment_Models_Mplan
{
	protected $_planId;
	protected $_projectId;
	protected $_projectName;
	protected $_yearNum;
	protected $_monNum;
	protected $_pDate;
	protected $_total;
	protected $_contactId;
	protected $_contactName;
	protected $_approvcId;
	protected $_approvcName;
	protected $_approvcDate;
	protected $_approvcRemark;
	protected $_approvfId;
	protected $_approvfName;
	protected $_approvfDate;
	protected $_approvfRemark;
	protected $_status;
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
			throw new Exception('Invalid mplan property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid plan property');
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

	/*******************************************/
	public function setPlanId($planId)
	{
		$this->_planId = (int)$planId;
		return $this;
	} 

	public function getPlanId()
	{
		return $this->_planId;
	}
	
	/*******************************************/
	public function setProjectId($projectId)
	{
		$this->_projectId = (int)$projectId;
		return $this;
	} 

	public function getProjectId()
	{
		return $this->_projectId;
	}

	/*******************************************/
	public function setProjectName($projectName)
	{
		$this->_projectName = $projectName;
		return $this;
	} 

	public function getProjectName()
	{
		return $this->_projectName;
	}

	/*******************************************/
	public function setYearNum($yearNum)
	{
		$this->_yearNum= $yearNum;
		return $this;
	}

	public function getYearNum()
	{
		return $this->_yearNum;
	}

	/*******************************************/
	public function setMonNum($monNum)
	{
		$this->_monNum= $monNum;
		return $this;
	}

	public function getMonNum()
	{
		return $this->_monNum;
	}

	/*******************************************/
	public function setPDate($pDate)
	{
		$this->_pDate= $pDate;
		return $this;
	}

	public function getPDate()
	{
		return $this->_pDate;
	}

	/*******************************************/
	public function setContactId($contactId)
	{
		$this->_contactId= $contactId;
		return $this;
	}

	public function getContactId()
	{
		return $this->_contactId;
	}

	/*******************************************/
	public function setContactName($contactName)
	{
		$this->_contactName= $contactName;
		return $this;
	}

	public function getContactName()
	{
		return $this->_contactName;
	}

	/*******************************************/
	public function setApprovcId($approvcId)
	{
		$this->_approvcId= $approvcId;
		return $this;
	}

	public function getApprovcId()
	{
		return $this->_approvcId;
	}
	
	/*******************************************/
	public function setApprovcName($approvcName)
	{
		$this->_approvcName= $approvcName;
		return $this;
	}

	public function getApprovcName()
	{
		return $this->_approvcName;
	}
	/*******************************************/
	public function setApprovfName($approvfName)
	{
		$this->_approvfName= $approvfName;
		return $this;
	}

	public function getApprovfName()
	{
		return $this->_approvfName;
	}
	/*******************************************/
	public function setApprovfId($approvfId)
	{
		$this->_approvfId= $approvfId;
		return $this;
	}

	public function getApprovfId()
	{
		return $this->_approvfId;
	}
	
	/*******************************************/
	public function setTotal($total)
	{
		$this->_total= $total;
		return $this;
	}

	public function getTotal()
	{
		return $this->_total;
	}
	
	/*******************************************/
	public function setApprovcDate($approvcDate)
	{
		$this->_approvcDate= $approvcDate;
		return $this;
	}

	public function getApprovcDate()
	{
		return $this->_approvcDate;
	}

	/*******************************************/
	public function setApprovfDate($approvfDate)
	{
		$this->_approvfDate= $approvfDate;
		return $this;
	}

	public function getApprovfDate()
	{
		return $this->_approvfDate;
	}
	
	/*******************************************/
	public function setApprovcRemark($approvcRemark)
	{
		$this->_approvcRemark= $approvcRemark;
		return $this;
	}

	public function getApprovcRemark()
	{
		return $this->_approvcRemark;
	}
	
	/*******************************************/
	public function setApprovfRemark($approvfRemark)
	{
		$this->_approvfRemark= $approvfRemark;
		return $this;
	}

	public function getApprovfRemark()
	{
		return $this->_approvfRemark;
	}

	/*******************************************/
	public function setStatus($status)
	{
		$this->_status= $status;
		return $this;
	}

	public function getStatus()
	{
		return $this->_status;
	}
	
	/*******************************************/
	public function setRemark($remark)
	{
		$this->_remark= $remark;
		return $this;
	}

	public function getRemark()
	{
		return $this->_remark;
	}
	
	/*******************************************/
	public function setCTime($cTime)
	{
		$this->_cTime= $cTime;
		return $this;
	}

	public function getCTime()
	{
		return $this->_cTime;
	}
}
?>
