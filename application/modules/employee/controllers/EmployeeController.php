<?php
/*created: 2011.3.26
author: mingtingling
version: v0.1
*/

class Employee_EmployeeController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }
    
    public function preDispatch()
	{
		$this->view->render("_sidebar.phtml");
	}

    public function indexAction()
    {
    	$employees = new Application_Model_EmployeeMapper();
      	$this->view->entries = $employees->fetchAll();
    }

}

