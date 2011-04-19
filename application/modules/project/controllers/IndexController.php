<?php
//Author: Meimo
//Date: 2011.4.1
//Reviewed: Rob
//Date: 2011.4.6
//Modified : Meimo
//Date :  Apr.15.2011

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
		$projects = new	 Project_Models_ProjectMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$arrayProjects = array();
			$formData = $this->getRequest()->getPost();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition = $formData['condition'];
				$arrayProjects = $projects->fetchAllJoin($key,$condition);
				if(count($arrayProjects)==0)
				{
					$errorMsg = General_Models_Text::$text_searchErrorNr;
					//waring a message  :  no match result
				}
			}
			else
			{
				$errorMsg = General_Models_Text::$text_searchErrorNi;
				//waring a message  :  please input a key word
			}
		}
		else
		{
			$arrayProjects = $projects->fetchAllJoin();
		}
		$this->view->arrayProjects = $arrayProjects;
		$this->view->errorMsg = $errorMsg;    
		}
    
    public function addAction()                                        
    {
    	$addForm = new Project_Forms_ProjectSave();
        $addForm->submit->setLabel('保存继续新建');
        $addForm->submit2->setLabel('保存返回上页');
        
		$projects = new Project_Models_ProjectMapper();
		$projects->populateDd($addForm);
	    	
    	if($this->getRequest()->isPost())
    	{
    		$btClicked = $this->getRequest()->getPost('submit');
    		$formData = $this->getRequest()->getPost();
    		if($addForm->isValid($formData))
    		{
    			$project = new Project_Models_Project();
    			$project->setName($addForm->getValue('name'));
    			$project->setAddress($addForm->getValue('address'));
    			$project->setStatus($addForm->getValue('status'));
    			$project->setStructype($addForm->getValue('structype'));
    			$project->setLevel($addForm->getValue('level'));
    			$project->setAmount($addForm->getValue('amount'));
    			$project->setPurpose($addForm->getValue('purpose'));
    			$project->setConstrArea($addForm->getValue('constrArea'));
    			$project->setStaffNo($addForm->getValue('staffNo'));
     			$project->setRemark($addForm->getValue('remark'));
    			$projects->save($project);   
    			
    			if($btClicked == '保存继续新建')
    			{
   					$addForm->getElement('name')->setValue('');
   					$addForm->getElement('address')->setValue('');
   					$addForm->getElement('status')->setValue('');
   					$addForm->getElement('structype')->setValue('0');
   					$addForm->getElement('level')->setValue('0');
   					$addForm->getElement('amount')->setValue('');
					$addForm->getElement('purpose')->setValue('');
   					$addForm->getElement('constrArea')->setValue('');
					$addForm->getElement('staffNo')->setValue('');
					$addForm->getElement('remark')->setValue('');
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
		    $this->view->addForm = $addForm;
    	}
    
    public function editAction()                                //编辑
    {
        $editForm = new Project_Forms_ProjectSave();
    	$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');

		$projects = new Project_Models_ProjectMapper();
		$projects->populateDd($editForm);
		
		$projectId = $this->_getParam('id',0); 
   	
    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$project = new Project_Models_Project();
    			$project->setProjectId($projectId);
       			$project->setName($editForm->getValue('name'));
    			$project->setaddress($editForm->getValue('address'));
    			$project->setStatus($editForm->getValue('status'));
    			$project->setStructype($editForm->getValue('structype'));
    			$project->setLevel($editForm->getValue('level'));
    			$project->setAmount($editForm->getValue('amount'));
    			$project->setPurpose($editForm->getValue('purpose'));
    			$project->setConstrArea($editForm->getValue('constrArea'));
    			$project->setStaffNo($editForm->getValue('staffNo'));
     			$project->setRemark($editForm->getValue('remark'));
    			$projects->save($project); 
    			 
    			$this->_redirect('/project');
    			}
    			else
    			{
    				$editForm->populate($formData);
    				}
    		}
    		else
    		{
    			if($projectId >0)
    			{
    			    $arrayProject = $projects->findArrayProject($projectId);
    				$editForm->populate($arrayProject);
    				}
    				else
    				{
    					$this->_redirect('/project');
    					}
    			}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $projectId;     	
    }
    
   public function displayAction()                                                    
    {  
       $projects = new Project_Models_ProjectMapper();
	   $projectId = $this->_getParam('id',0);
	   if($projectId >0)
       {
       		$project = new Project_Models_Project();
       		$projects->find($projectId,$project);   
	   		$this ->view->project = $project;      		
    		}
    		else
    		{
    			$this->_redirect('/project');
    			}
	    //显示该project下的岗位及人员（display employees related to this project?   
    	//display relevant project progress
    	//display relevant log
    	}
   
    public function ajaxdeleteAction()
    {
		$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   		$projectId = $this->_getParam('id',0);
    	if($projectId > 0)
    	{
    		$projects = new Project_Models_ProjectMapper();
    		$projects->delete($projectId);
    		echo "1";
    		}
    		else
    		{
    			$this->_redirect('/project');
    			}
    	}
}
?>