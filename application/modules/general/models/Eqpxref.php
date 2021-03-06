<?php
class General_Models_Eqpxref
{     
    protected $_parent;
	protected $_child;

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
            throw new Exception('Invalid eXref property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid eXref property');
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

	public function setParent($parent)
    {
        $this->_parent = (int)$parent;
        return $this;
    }
     
    public function getParent()
    {
        return $this->_parent;
    }
    
    public function setChild($child)
    {
        $this->_child = (int)$child;
        return $this;
    } 
    
    public function getChild()
    {
        return $this->_child;
    }
}
?>
