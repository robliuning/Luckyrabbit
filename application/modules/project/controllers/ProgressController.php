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

	public function preDispatch(){
		$this -> view ->render('_sidebar.phtml');
	}

	public function indexAction(){                                          //新建
		//this is an indexAction
    	$addForm = new Project_Forms_ProgressSave();
      $addForm->submit->setLabel('保存新建');
    	$addForm->submit2->setAttrib('class','hide');
    	$tbId = $addForm->getElement('projectId');
    	$tbId->setValue('工程进度记录在保存新建后自动生成');
		//populate dd project
			$progresses = new Project_Models_ProgressMapper();			
			$progresses->populateDd($addForm);
		//end
    	$this->view->form = $addForm;
    	
    	if($this->getRequest()->isPost())
    	{
    		$btClicked = $this->getRequest()->getPost('submit');
    		$formData = $this->getRequest()->getPost();
    		if($addForm->isValid($formData))
    		{
    			$progress = new Project_Models_Progress;
    			$progress->setProjectId('projectId');
    			$progress->setStage($addForm->getValue('stage'));
    			$progress->setTask($addForm->getValue('task'));
    			$progress->setStartDate($addForm->getValue('startDate'));
    			$progress->setEndDateExp($addForm->getValue('endDateExp'));
    			$progress->setPeriodExp($addForm->getValue('periodExp'));
    			$progress->setEndDateAct($addForm->getValue('endDateAct'));
    			$progress->setPeriodAct($addForm->getValue('periodAct'));
    			$progress->setQuality($addForm->getValue('quality'));
					$progress->setRemark($addForm->getValue('remark'));
					$result = $progresses->save($progress);
				 	if($btClicked=='保存继续新建')
				 	{
   					$addForm->getElement('task')->setValue('');
   					$addForm->getElement('startDate')->setValue('');
   					$addForm->getElement('endDateExp')->setValue('');
   					$addForm->getElement('periodExp')->setValue('');
						$addForm->getElement('endDateAct')->setValue('');
   					$addForm->getElement('periodAct')->setValue('');
   					$addForm->getElement('quality')->setValue('');
   					$addForm->getElement('remark')->setValue('');
   				}	
   				else
   				{
   					$this->_redirect('/project/progress');
   					}
    			}
    		else
    		{
    			$addForm->populate($formData);
    			}
    		}
    	$this->view->addForm = $addForm;
			$this->view->result = $result;
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

	public function ajaxdisplayoneAction(){                                               
		//
		$this->_helper->layout()->disableLayout();
   		$id=$this->_getParam('id',0);
    	if($id >0)
    	{
   		    $progresses = new Project_Models_ProgressMapper();
   			$progress = $progresses->getProgressInfo($id);
   			$this->view->progress = $progress;
   			}
    		else
    		{
   				$this->_redirect('/project/progress');
   				}
	}        

	public function editAction(){
		//to edit a choosen progress
	    $editForm = new Project_Forms_ProgressSave();
    	$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');
		//populate dd project
			$progresses = new Project_Models_ProgressMapper();			
			$progresses->populateDd($editForm);
    	$this->view->form = $editForm;
    	$this->view->id = $this->_getParam('id',0);    	

    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$progress = new Project_Models_Progress();
    			$progress->setProgressId($editForm->getValue('progressId'));	
    			$progress->setProjectId('projectId');
    			$progress->setStage($editForm->getValue('stage'));
    			$progress->setTask($editForm->getValue('task'));
    			$progress->setStartDate($editForm->getValue('startDate'));
    			$progress->setEndDateExp($editForm->getValue('endDateExp'));
    			$progress->setPeriodExp($editForm->getValue('periodExp'));
    			$progress->setEndDateAct($editForm->getValue('endDateAct'));
    			$progress->setPeriodAct($editForm->getValue('periodAct'));
    			$progress->setQuality($editForm->getValue('quality'));
					$progress->setRemark($editForm->getValue('remark'));
    			$progresses->save($progress);
    			$this->_redirect('/project/progress');
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
    				$editForm->populate($progresses->getProgress($id));
    				}
    				else
    				{
    					$this->_redirect('/project/progress');
    					}
    			}
		
	}
}
?>