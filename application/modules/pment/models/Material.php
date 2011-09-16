<?php
//updated in 5th July by Rob

class Pment_Models_Material
{
	protected $_mtrId;
	protected $_planId;
	protected $_type;
	protected $_mName;
	protected $_unit;
	protected $_spec;
	protected $_amount;
	protected $_amountc;
	protected $_amountf;
	protected $_cost;
	protected $_costTotal;
	protected $_budget;
	protected $_budgetTotal;
	protected $_inDate;
	protected $_remark;
	protected $_vendorName;
	
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
			throw new Exception('Invalid metarial property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid metarial property');
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

	public function setMtrId($mtrId)
	{
		$this->_mtrId = (int)$mtrId;
		return $this;
	} 

	public function getMtrId()
	{
		return $this->_mtrId;
	}
	
	public function setPlanId($planId)
	{
		$this->_planId = $planId;
		return $this;
	} 

	public function getPlanId()
	{
		return $this->_planId;
	}

	public function setType($type)
	{
		$this->_type = $type;
		return $this;
	} 

	public function getType()
	{
		return $this->_type;
	}

	public function setMName($mName)
	{
		$this->_mName = $mName;
		return $this;
	} 

	public function getMName()
	{
		return $this->_mName;
	}
	
	public function setUnit($unit)
	{
		$this->_unit = $unit;
		return $this;
	} 

	public function getUnit()
	{
		return $this->_unit;
	}
	
	public function setSpec($spec)
	{
		$this->_spec = $spec;
		return $this;
	} 

	public function getSpec()
	{
		return $this->_spec;
	}
	
	public function setAmount($amount)
	{
		$this->_amount = $amount;
		return $this;
	} 

	public function getAmount()
	{
		return $this->_amount;
	}
	
	public function setAmountc($amountc)
	{
		$this->_amountc = $amountc;
		return $this;
	} 

	public function getAmountc()
	{
		return $this->_amountc;
	}

	public function setCost($cost)
	{
		$this->_cost = $cost;
		return $this;
	} 

	public function getCost()
	{
		return $this->_cost;
	}
	
	public function setCostTotal($costTotal)
	{
		$this->_costTotal = $costTotal;
		return $this;
	} 

	public function getCostTotal()
	{
		return $this->_costTotal;
	}

	public function setBudget($budget)
	{
		$this->_budget = $budget;
		return $this;
	} 

	public function getBudget()
	{
		return $this->_budget;
	}

	public function setBudgetTotal($budgetTotal)
	{
		$this->_budgetTotal = $budgetTotal;
		return $this;
	} 

	public function getBudgetTotal()
	{
		return $this->_budgetTotal;
	}
	
	public function setAmountf($amountf)
	{
		$this->_amountf = $amountf;
		return $this;
	} 

	public function getAmountf()
	{
		return $this->_amountf;
	}

	public function setInDate($inDate)
	{
		$this->_inDate = $inDate;
		return $this;
	} 

	public function getInDate()
	{
		return $this->_inDate;
	}

	public function setRemark($remark)
	{
		$this->_remark = $remark;
		return $this;
	} 

	public function getRemark()
	{
		return $this->_remark;
	}

	public function setVendorName($vendorName)
	{
		$this->_vendorName = $vendorName;
		return $this;
	} 

	public function getVendorName()
	{
		return $this->_vendorName;
	}
}
?>
