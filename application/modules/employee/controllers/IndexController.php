<?php

class Employee_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$employee = new Application_Model_EmployeeMapper();
        $this->view->entries = $employee->fetchAll();
    }


}

?>