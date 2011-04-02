<?php
//Creation date: Apr.1st.2011
//Author: Meimo
//Completion date:

class Project_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }
	public function preDispatch(){
	     $this -> view ->render("_sidebar.phtml");
	 }

    public function indexAction()
    {
       $project  = new Project_Models_ProjectMapper();
	   $this -> view ->projects = $project -> fetchAll();
		

		
		// Project manager from em_cpp search key:project id = this and post = 000001
        // Present progress from pm_progress search
        // Order by creation date
    }
    
    public function addAction()
    {
    	$editForm = new Project_Forms_ProjectSave();
        $editForm->submit->setLabel('保存继续新建');
        $editForm->submit2->setLabel('保存返回上页');
    	$tbId = $editForm->getElement('projectId');
    	$tbId->setValue('工程编号在保存新建后自动生成');
    	$this->view->form = $editForm;
    	
    	if($this->getRequest()->isPost())
    	{
    		$dec = $this->getRequest()->getPost('submit');
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$name = $editForm->getValue('name');
    			$address = $editForm->getValue('address');
    			$status = $editForm->getValue('status');
    			$structType = $editForm->getValue('structType');
    			$level = $editForm->getValue('level');
    			$amount = $editForm->getValue('amount');
    			$purpose = $editForm->getValue('purpose');
    			$constrArea = $editForm->getValue('constrArea');
				$staffNo = $editForm->getValue('staffNo');
				$remark = $editForm->getValue('remark');
                $cTime = $editForm->getValue('cTime');
    			    			
    			$contacts = new Project_Models_DbTable_Project();
    			$contacts->addContact($name,$address,$status,$structType,$level,$amount,$purpose,$constrArea,$staffNo,$remark,$cTime);   
    			if($dec == '保存继续新建')
    			{
   					$editForm->getElement('name')->setValue('');
   					$editForm->getElement('address')->setValue('');
   					$editForm->getElement('status')->setValue('');
   					$editForm->getElement('structType')->setValue('0');
   					$editForm->getElement('level')->setValue('0');
   					$editForm->getElement('amount')->setValue('');
					$editForm->getElement('purpose')->setValue('');
   					$editForm->getElement('constrArea')->setValue('');
					$editForm->getElement('staffNo')->setValue('');
					$editForm->getElement('remark')->setValue('');
					$editForm->getElement('cTime')->setValue('');
   					}
   					else
    				{
    					$this->_redirect('/project');
    					} 			
    			}
    			else
    			{
    				$editForm->populate($formData);
    				}
    		}
		// fill the structType db
    
    	}
    
    public function editAction()
    {
        $editForm = new Project_Forms_ProjectSave();
    	$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');
    	$this->view->form = $editForm;
    	$this->view->id = $this->_getParam('id');
    	
    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$projectId = $this->_getParam('id');
    			$name = $editForm->getValue('name');	
    			$address = $editForm->getValue('address');
    			$status = $editForm->getValue('status');
    			$structType = $editForm->getValue('structType');
    			$level = $editForm->getValue('level');
    			$amount = $editForm->getValue('amount');
    			$purpose = $editForm->getValue('purpose');
    			$constrArea = $editForm->getValue('constrArea');
				$staffNo = $editForm->getValue('staffNo');
				$remark = $editForm->getValue('remark');
				$cTime = $editForm->getValue('cTime');
    			$prjs = new Project_Models_DbTable_Project();
    			$prjs->updateContact($projectId,$name,$address,$status,$structType,$level,$amount,$purpose,$constrArea,$staffNo,$remark,$cTime);    			
    			
    			
    			
    			$this->_redirect('/project');
    			}
    			else
    			{
    				$editForm->populate($formData);
    				}
    		}
    		else
    		{
    			$id=$this->_getParam('id',0);
    			if($id >0)
    			{
    			    $prjs = new Project_Models_DbTable_Project();
    				$editForm->populate($prjs->getContact($id));
    				}
    				else
    				{
    					$this->_redirect('/project');
    					}
    			}
		
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