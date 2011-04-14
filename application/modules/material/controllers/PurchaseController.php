<?php
//Author: Meimo
//Date: 2011.4.14
class Material_PurchaseController extends Zend_Controller_Action
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
}

?>