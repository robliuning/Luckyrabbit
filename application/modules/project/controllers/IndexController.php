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
	   $this -> view ->projects = $project -> getAllInfo();
		// Project manager from em_cpp search key:project id = this and post = 000001
        // Present progress from pm_progress search
        // Order by creation date
    }
    
    public function addAction()                                        //�½�
    {
    	$addForm = new Project_Forms_ProjectSave();
        $addForm->submit->setLabel('��������½�');
        $addForm->submit2->setLabel('���淵����ҳ');
    	$tbId = $addForm->getElement('strucTypesId');
    	$tbId->setValue('���̱���ڱ����½����Զ�����');
		//populate dd structure type
		$projs = new Porject_Models_DbTable_Project();			
		$projs->populateDd($addForm);
		//end
    	$this->view->form = $addForm;
    	
    	if($this->getRequest()->isPost())
    	{
    		$dec = $this->getRequest()->getPost('submit');
    		$formData = $this->getRequest()->getPost();
    		if($addForm->isValid($formData))
    		{
    			$name = $addForm->getValue('name');
    			$address = $addForm->getValue('address');
    			$status = $addForm->getValue('status');
    			$structType = $addForm->getValue('strucTypesId');
    			$level = $addForm->getValue('level');
    			$amount = $addForm->getValue('amount');
    			$purpose = $addForm->getValue('purpose');
    			$constrArea = $addForm->getValue('constrArea');
				$staffNo = $addForm->getValue('staffNo');
				$remark = $addForm->getValue('remark');
    			$projs->addProject($name,$address,$status,$structType,$level,$amount,$purpose,$constrArea,$staffNo,$remark);   
    			if($dec == '��������½�')
    			{
   					$addForm->getElement('name')->setValue('');
   					$addForm->getElement('address')->setValue('');
   					$addForm->getElement('status')->setValue('');
   					$addForm->getElement('structType')->setValue('0');
   					$addForm->getElement('level')->setValue('0');
   					$addForm->getElement('amount')->setValue('');
					$addForm->getElement('purpose')->setValue('');
   					$addForm->getElement('constrArea')->setValue('');
					$addForm->getElement('staffNo')->setValue('');
					$addForm->getElement('remark')->setValue('');
					$addForm->getElement('cTime')->setValue('');
   					}
   					else
    				{
    					$this->_redirect('/project');
    					} 			
    			}
    			else
    			{
    				$addForm->populate($formData);
    				}
    		}
		// fill the structType db
    
    	}
    
    public function editAction()                                //�༭
    {
        $editForm = new Project_Forms_ProjectSave();
    	$editForm->submit->setLabel('�����޸�');
    	$editForm->submit2->setAttrib('class','hide');
		//populate dd structure type
    	$projs = new Project_Models_DbTable_Project();
		$projs->populateDd($editForm);
		//end
    	$this->view->form = $editForm;
    	$this->view->id = $this->_getParam('id');    	
		$proj = new Project_Models_DbTable_Project();

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
    			$projs->updateProject($projectId,$name,$address,$status,$structType,$level,$amount,$purpose,$constrArea,$staffNo,$remark);    					
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
    				$editForm->populate($projs->getProject($id));
    				}
    				else
    				{
    					$this->_redirect('/project');
    					}
    			}
		
		// fill the structType db
    	}
    
   public function displayOneAction()                //���
	                                         
    {  //��ʾproject��Ϣ  ��display project info��
       $displayOne = new Project_Models_ProjectMapper();   
	   $projectId = this->_getParam('id');
	   $this->view->id = $projectId;
	   $this -> view ->projects = $displayOne -> Find($projectId);
       
	    //��ʾ��project�µĸ�λ����Ա��display employees related to this project��
	   $cpp = new Employee_Models_Dbtable_Cpp(); 
	   $condition = "projectId";
	   $this -> view -> cpps = $cpp -> fetchALL($projectId,$condition);   
    
    
    //display relevant project progress
    //display relevant log
    	}
   
    public function ajaxDeleteAction()
    {
		$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$id=$this->_getParam('id',0);
    	if($id >0)
    	{
    		$projects = new Project_Models_DbTable_Project();
    		$projects->deleteProject($id);
    		echo "1";
    		}
    		else
    		{
    			$this->_redirect('/project');
    			}
    	//check if has log or progress
    	//either one exist, the deletion can not be processed
    	}
}
?>