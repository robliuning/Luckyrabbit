<?php
//updated in 13th June by Rob

class Admin_Models_Message
{
	protected $_msgId;
	protected $_fromId;
	protected $_fromCid;
	protected $_fromCname;
	protected $_toId;
	protected $_toCid;
	protected $_toCname;
	protected $_title;
	protected $_content;
	protected $_sendTime;
	protected $_status;
	
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
			throw new Exception('Invalid message property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid mesage property');
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

	public function setMsgId($msgId)
	{
		$this->_msgId = (int)$msgId;
		return $this;
	} 

	public function getMsgId()
	{
		return $this->_msgId;
	}

	public function setFromId($fromId)
	{
		$this->_fromId = (int)$fromId;
		return $this;
	} 

	public function getFromId()
	{
		return $this->_fromId;
	}

	
	public function setFromCid($fromCid)
	{
		$this->_fromCid= (int) $fromCid;
		return $this;
	} 

	public function getFromCid()
	{
		return $this->_fromCid;
	}
 
 	public function setFromCname($fromCname)
	{
		$this->_fromCname= $fromCname;
		return $this;
	}

	public function getFromCname()
	{
		return $this->_fromCname;
	} 

 	public function setToId($toId)
	{
		$this->_toId = $toId;
		return $this;
	}

	public function getToId()
	{
		return $this->_toId;
	}

	public function setToCid($toCid)
	{
		$this->_toCid = $toCid;
		return $this;
	}

	public function getToCid()
	{
		return $this->_toCid;
	}

 	public function setToCname($toCname)
	{
		$this->_toCname = $toCname;
		return $this;
	}

	public function getToCname()
	{
		return $this->_toCname;
	}

 	public function setTitle($title)
	{
		$this->_title= $title;
		return $this;
	}

 	public function getTitle()
	{
		return $this->_title;
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
 	
	public function setSendTime($sendTime)
	{
		$this->_sendTime = $sendTime;
		return $this;
	}

	public function getSendTime()
	{
		return $this->_sendTime;
	}

	public function setStatus($status)
	{
		$this->_status = $status;
		return $this;
	}

	public function getStatus()
	{
		return $this->_status;
	}
}
?>
