<?php
//Creation date:
//Author:
//Completion date:

class Project_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // Project manager from em_cpp search key:project id = this and post = 000001
        // Present progress from pm_progress search
        // Order by creation date
    }
    
    public function addAction()
    {
    	// fill the structType db
    
    	}
    
    public function editAction()
    {
        // fill the structType db
    	}
    
    public function displayAction()
    {
    //display project info
    //display employees related to this project
    //display relevant project progress
    //display relevant log
    	}
    
    public function ajaxDeleteAction()
    {
    	//check if has log or progress
    	//either one exist, the deletion can not be processed
    	}
    
    public function ajaxContactAction()
    {
    	//Use Object of Contact_Models_DbTable_Contact to find specific contact info
    	}
    
    public function ajaxProgressAction()
    {
    	//use project id and progress stage to find specific progress info
    	}
}

?>