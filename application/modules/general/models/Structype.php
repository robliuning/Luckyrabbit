<?php

/* create by lxj
   2011-04-06  v 0.2
 */

class General_Models_Post
{     
    protected $_structypeId;
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

	public function setStructypeId($structypeId)
    {
        $this->_structypeId = (int)$structypeId;
        return $this;
    } 

    public function getStructypeId()
    {
        return $this->_structypeId;
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
