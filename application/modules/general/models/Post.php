<?php

/* create by lxj
   2011-04-06  v 0.2
 */

class General_Models_Post
{     
    protected $_postId;
	protected $_name;
    
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
        $this->_postId = (int)$postId;
        return $this;
    } 

    public function getPostId()
    {
        return $this->_postId;
    }

    public function setName($name)
    {
        $this->_name = (string)$name;
        return $this;
    } 

    public function getName()
    {
        return $this->_name;
    }

}
?>
