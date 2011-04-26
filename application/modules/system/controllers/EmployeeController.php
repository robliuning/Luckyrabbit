<?php

class Project_EmployeeController extends Zend_Controller_Action
{
    public function indexAction()
    {
        // action body
        $employee = new Application_Model_EmployeeMapper();
        $this->view->entries = $employee->fetchAll();
    }


}

