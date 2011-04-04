<?php
//Creation date: Apr.3rd.2011
//Author: Meimo
//Completion date: Apr..2011

class Project_ProgressController extends Zend_Controller_Action
{

	public function init()
	{
		/*Initilze action controller here*/
	}

	public function preDispatch(){
		$this -> view ->render('_sidebar.phtml');
	}

	public function addAction(){                                          //新建
		//this is an indexAction
    	$addForm = new Project_Forms_ProgressSave();
        $addForm->submit->setLabel('保存继续新建');
        $addForm->submit2->setLabel('保存返回上页');
    	$tbId = $addForm->getElement('projectId');
    	$tbId->setValue('工程进度记录在保存新建后自动生成');
		//populate dd structure type
		$projs = new Project_Models_DbTable_Progress();			
		$projs->populateDd($addForm);
		//end
    	$this->view->form = $addForm;
    	
    	if($this->getRequest()->isPost())
    	{
    		$dec = $this->getRequest()->getPost('submit');
    		$formData = $this->getRequest()->getPost();
    		if($addForm->isValid($formData))
    		{
    			$stage = $addForm->$this->_getParam('id');
    			$task = $addForm->getValue('task');
    			$startDateExp = $addForm->getValue('startDateExp');
    			$endDateExp = $addForm->getValue('endDateExp');
    			$periodExp = $addForm->getValue('periodExp');
    			$endDateAct = $addForm->getValue('endDateAct');
    			$periodAct = $addForm->getValue('periodAct');
    			$quality = $addForm->getValue('quality');
				$remark = $addForm->getValue('remark');    			$progs->addProgress($task,$startDateExp,$endDateExp,$periodExp,$endDateAct,$periodAct,$quality,$remark);   
    			if($dec == '保存继续新建')
    			{
   					$addForm->getElement('task')->setValue('');
   					$addForm->getElement('startDateExp')->setValue('');
   					$addForm->getElement('endDateExp')->setValue('');
   					$addForm->getElement('periodExp')->setValue('0');
					$addForm->getElement('endDateAct')->setValue('');
   					$addForm->getElement('periodAct')->setValue('');
   					$addForm->getElement('quality')->setValue('0');
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
	}

	public function ajaxDisplayAll(){                                                  //显示部分progress信息
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

/*	public function ajaxDispayOne(){                                               
		//需要显示projectname
		$this->_helper->layout()->disableLayout();
   		$id=$this->_getParam('id',0);
    	if($id >0)
    	{
   		    $progresses = new Project_Models_DbTable_Progress();
   			$progress = $progresses->getProgress($id);
   			$this->view->progress = $progress;
   			}
    		else
    		{
   				$this->_redirect('/project/progress');
   				}
	}        */

	public function editAction(){
		//to edit a choosen progress
	    $editForm = new Project_Forms_ProgressSave();
    	$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');
		//populate dd structure type
    	$this->view->form = $editForm;
    	$this->view->id = $this->_getParam('id');    	
		$prog = new Project_Models_DbTable_Progress();

    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    		
    			$task = $editForm->getValue('task');
    			$startDateExp = $editForm->getValue('startDateExp');
    			$endDateExp = $editForm->getValue('endDateExp');
    			$periodExp = $editForm->getValue('periodExp');
    			$endDateAct = $editForm->getValue('endDateAct');
    			$periodAct = $editForm->getValue('periodAct');
    			$quality = $editForm->getValue('quality');
				$remark = $editForm->getValue('remark');
    			$progs->updateProgress($task,$startDateExp,$endDateExp,$periodExp,$endDateAct,$periodAct,$quality,$remark);    					
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
    				$editForm->populate($progs->getProgress($id));
    				}
    				else
    				{
    					$this->_redirect('/project/progress');
    					}
    			}
		
	}
?>