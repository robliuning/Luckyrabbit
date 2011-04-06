<?php

/* create by lxj
   2011-04-06   v 0.2
 */

class General_Models_Title
{     
    protected $_titleId;
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

	public function setTitleId($titleId)
    {
        $this->_titleId = (int)$titleId;
        return $this;
    } 

    public function getTitleId()
    {
        return $this->_titleId;
    }

    public function setName($Name)
    {
        $this->_Name = (string)$Name;
        return $this;
    } 

    public function getName()
    {
        return $this->_Name;
    }

}
?>
