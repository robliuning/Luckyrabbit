<?php

class Material_IndexController extends Zend_Controller_Action
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
        // action body
    }
    
    public function addAction()
    {
    
    }
    
    public function editAction()
    {
    
    }
    
    public function ajaxdeleteAction()
    {
    
    }
    
    public function searchAction()
    {
    	//key => user input 
    	//conditon => material name,type and spc
    }
}

?>