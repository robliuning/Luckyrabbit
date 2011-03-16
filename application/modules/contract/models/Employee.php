<?php

class Application_Model_Employee
{
    protected $_ename;
    protected $_email;
    protected $_eid;
    
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

 

    public function setEname($name)

    {

        $this->_ename = (string) $name;

        return $this;

    }

 

    public function getEname()

    {

        return $this->_ename;

    }

 

    public function setEmail($email)

    {

        $this->_email = (string) $email;

        return $this;

    }

 

    public function getEmail()

    {

        return $this->_email;

    }

 

    public function setEid($eid)

    {

        $this->_eid = (int) $eid;

        return $this;

    }

 

    public function getEid()

    {

        return $this->_eid;

    }

}

?>