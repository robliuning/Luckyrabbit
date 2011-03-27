<?php

/* create by lxj
   2011-03-28   v1.1
   */

class Application_Model_Post
{
  /*protected $_empId;
	protected $_name;
	protected $_age;
	protected $_deptName;
	protected $_dutyName;
	protected $_titleName;
	protected $_otherContact;
	protected $_address;
	protected $_status;
	protected $_remark;*/
     
    protected $_postId;
	protected $_name;
	protected $_type;
	protected $_cardId;
	protected $_certId;
	protected $_remark;
    
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
            throw new Exception('Invalid employee property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid employee property');
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

	public function setPostId($postId)
    {
        $this->_postId= (int)$postId;
        return $this;
    } 

    public function getPostId()
    {
        return $this->_postId;
    }

    public function setName($name)
    {
        $this->_name= (string)$name;
        return $this;
    } 

    public function getName()
    {
        return $this->_name;
    }

	
    public function setType($type)
    {
        $this->_type= (string) $type;
        return $this;
    } 

    public function getType()
    {
        return $this->_type;
    }
 
     public function setCardId($cardId)
    {
        $this->_cardId= (int) $cardId;
        return $this;
    }

	public function getCardId()
    {
        return $this->_cardId;
    }

     public function setCertId($certId)
    {
        $this->_certId= (int) $certId;
        return $this;
    }

    public function getCertId()
    {
        return $this->_certId;
	}

	public function setRemark($remark)
	{
		$this->_remark= (string) $remark;
		return $this;
	}

	public function getRemark()
	{
		return $this->_remark;
	}
}
?>
