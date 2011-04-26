<?php
//Creation date: Apr.3rd.2011
//Author: Meimo
//Completion date: Apr.3.2011
//Rewritten:Apr.22.2011
class Project_ProgressController extends Zend_Controller_Action
{

	public function init()
	{
		/*Initilze action controller here*/
	}

	public function preDispatch()
	{
		$this -> view ->render('_sidebar.phtml');
	}

	public function indexAction() //check
	{
		//this is an indexAction
    	$addForm = new Project_Forms_ProgressSave();
      	$addForm->submit->setLabel('保存新建');
    	$addForm->submit2->setAttrib('class','hide');
		//populate dd project
		$progresses = new Project_Models_ProgressMapper();			
		$progresses->populateProgressDd($addForm);
		//end    	
    	if($this->getRequest()->isPost())
    	{
    		$btClicked = $this->getRequest()->getPost('submit');
    		$formData = $this->getRequest()->getPost();
    		if($addForm->isValid($formData))
    		{
    			$progress = new Project_Models_Progress;
    			$progress->setProjectId($addForm->getValue('projectId'));
    			$progress->setStage($addForm->getValue('stage'));
    			$progress->setTask($addForm->getValue('task'));
    			$progress->setStartDate($addForm->getValue('startDate'));
    			$progress->setEndDateExp($addForm->getValue('endDateExp'));
    			$progress->setEndDateAct($addForm->getValue('endDateAct'));
    			$progress->setQuality($addForm->getValue('quality'));
				$progress->setRemark($addForm->getValue('remark'));
				$result = $progresses->save($progress);
   				$addForm->getElement('task')->setValue('');
   				$addForm->getElement('startDate')->setValue('');
   				$addForm->getElement('endDateExp')->setValue('');
				$addForm->getElement('endDateAct')->setValue('');
   				$addForm->getElement('quality')->setValue('');
   				$addForm->getElement('remark')->setValue('');
   				$this->view->result = $result;
   				}	
    			else
    			{
    				$addForm->populate($formData);
    				}
    		}
    		$this->view->addForm = $addForm;
	}

	public function ajaxdisplayallAction(){                                                  //显示部分progress信息
		//to show some details of a specific grogress

		$this->_helper->layout()->disableLayout();
   		$id=$this->_getParam('id',0);
    	if($id >0)
    	{
   		  $progresses = new Project_Models_ProgressMapper();
   			$progress = $progresses->fetchInfo($id);
   			$this->view->progress = $progress;
   			}
    		else
    		{
   				$this->_redirect('/project/progress');
   				}
	}

	public function ajaxdisplayAction() //check
	{                                               
		$this->_helper->layout()->disableLayout();
   		$id = $this->_getParam('id',0);
    	if($id > 0)
    	{
   		    $progresses = new Project_Models_ProgressMapper();
   			$progress = new Project_Models_Progress();
   			$progresses->find($id,$progress);
   			$this->view->progress = $progress;
   			}
    		else
    		{
   				$this->_redirect('/project/progress');
   				}
	}        

	public function editAction()
	{
	    $editForm = new Project_Forms_ProgressSave();
    	$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');
    	$editForm->getElement('projectId')->setAttrib('class','hide');
     	$editForm->getElement('projectId')->setLabel('');
   	
    	//$editForm->projectId->setAttrib('class','hide');
		//populate dd project
		$progresses = new Project_Models_ProgressMapper();			
		$progresses->populateProgressDd($editForm);
    	$progressId = $this->_getParam('id',0);
    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$progress = new Project_Models_Progress();
    			$progress->setProgressId($progressId);	
    			$progress->setProjectId($editForm->getValue('projectId'));
    			$progress->setStage($editForm->getValue('stage'));
    			$progress->setTask($editForm->getValue('task'));
    			$progress->setStartDate($editForm->getValue('startDate'));
    			$progress->setEndDateExp($editForm->getValue('endDateExp'));
    			$progress->setEndDateAct($editForm->getValue('endDateAct'));
    			$progress->setQuality($editForm->getValue('quality'));
				$progress->setRemark($editForm->getValue('remark'));
    			$progresses->save($progress);
    			$this->_redirect('/project/index/display/id/'.$progress->getProjectId());
    			}
    			else
    			{
    				$editForm->populate($formData);
    				}
    		}
    		else
    		{
    			if($progressId >0)
    			{
			  		$arrayProgress = $progresses->findArrayProgress($progressId);
					$editForm->populate($arrayProgress);
    				}
    				else
    				{
    					$this->_redirect('/project/progress');
    					}
    			}
    	$projectId = $editForm->getValue('projectId');
    	$this->view->projectId = $projectId;
		$this->view->id = $progressId;  	
		$this->view->editForm = $editForm;
	}
}
?>