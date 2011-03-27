<?php

/* create by lxj
   2011-03-28   v1.1
   */

class Application_Model_Project
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

	protected $_contactId;	
	protected $_postId;
    protected $_projectId;
    
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

	public function setContactId($contactId)
    {
        $this->_contactId= (int)$contactId;
        return $this;
    } 

    public function getContactId()
    {
        return $this->_contactId;
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

	public function setProjectId($projectId)
    {
        $this->_projectId= (int)$projectId;
        return $this;
    } 

    public function getProjectId()
    {
        return $this->_projectId;
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
?>
