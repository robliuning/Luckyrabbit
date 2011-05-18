<?php

/* create by lxj
   modified by rob
   2011-03-31   v2.0
   rewrite by lxj
   2011-04-03   v2.0
   */

class Employee_Models_Cpp
{    
	protected $_cppId;
    protected $_contactId;
    protected $_contactName;
	protected $_postId;
	protected $_postName;
	protected $_projectId;
	protected $_projectName;
	protected $_postType;
	protected $_postCardId;
	protected $_certId;
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
            throw new Exception('Invalid cpp property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid cpp property');
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

	public function setCppId($cppId)
	{
		$this->_cppId = (int)$cppId;
		return $this;
	}

	public function getCppId()
	{
		return $this->_cppId;
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

    public function setContactName($contactName)
    {
        $this->_contactName= (string)$contactName;
        return $this;
    } 

    public function getContactName()
    {
        return $this->_contactName;
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

    public function setPostName($postName)
    {
        $this->_postName= (string)$postName;
        return $this;
    } 

    public function getPostName()
    {
        return $this->_postName;
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

    public function setProjectName($projectName)
    {
        $this->_projectName= (string)$projectName;
        return $this;
    } 

    public function getProjectName()
    {
        return $this->_projectName;
    }
	
    public function setPostType($postType)
    {
        $this->_postType= (string)$postType;
        return $this;
    } 

    public function getPostType()
    {
        return $this->_postType;
    }
 
     public function setPostCardId($postCardId)
    {
        $this->_postCardId= $postCardId;
        return $this;
    }

	public function getPostCardId()
    {
        return $this->_postCardId;
    }

     public function setCertId($certId)
    {
        $this->_certId= $certId;
        return $this;
    }

    public function getCertId()
    {
        return $this->_certId;
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
