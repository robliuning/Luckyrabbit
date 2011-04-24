<?php
/*
Created Meimo
Date Apr.17.2011
*/

class Worker_ExtraController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

	public function preDispatch()
	{
		$this->view->render('_sidebar.phtml');
	}

    public function indexAction()
    {
        // action body
		$errorMsg = null;
		$extras = new Worker_Models_ExtraMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayExtras = array();
			$key = $formData['key'];
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayExtras = $extras->fetchAllJoin($key,$condition);
				if(count($arrayExtras) == 0)
				{
					$errorMsg = General_Models_Text::$text_searchErrorNr;
					}
				}
				else
				{
					$errorMsg = General_Models_Text::$text_searchErrorNi;
					}
		}
		else
		{
			$arrayExtras = $extras->fetchAllJoin();
		}
		$this->view->arrayExtras = $arrayExtras;
		$this->view->errorMsg = $errorMsg;
    }

	public function addAction()
	{
		//
		$addForm = new Worker_Forms_extraSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');

		$extras = new Worker_Models_ExtraMapper();
		$result = null;

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$extra = new Worker_Models_Extra();
				$extra->setWorkerId($addForm->getValue('workerId'));
				$extra->setProjectId($addForm->getValue('projectId'));
				$extra->setStartDate($addForm->getValue('startDate'));
				$extra->setEndDate($addForm->getValue('endDate'));
				$extra->setPeriod($addForm->getValue('period'));
				$extra->setCost($addForm->getValue('cost'));
				$result = $extras->save($extra);
				if($btClicked=='保存继续新建')
				{
					$addForm->getElement('workerId')->setValue('');
					$addForm->getElement('projectId')->setValue('');
					$addForm->getElement('startDate')->setValue('');
					$addForm->getElement('endDate')->setValue('');
					$addForm->getElement('period')->setValue('');
					$addForm->getElement('cost')->setValue('');
					}
					else
					{
						$this->_redirect('/extra');
						}
			}
			else
			{
				$this->populate($formData);
			}
		}
		 $this->view->addForm = $addForm;
		 $this->view->result = $result;

	}

	public function editAction()
	{
		//
		$editForm = new Worker_Forms_extraSave();
		$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');

		$extras = new Worker_Models_ExtraMapper();
    	$extId = $this->_getParam('id',0);
    	$result = null;

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
			{
				$extra = new Worker_Models_Wage();
				$extra->setExtId($extId);
				$extra->setWorkerId($editForm->getValue('workerId'));
				$extra->setProjectId($editForm->getValue('projectId'));
				$extra->setStartDate($editForm->getValue('startDate'));
				$extra->setEndDate($editForm->getValue('endDate'));
				$extra->setPeriod($editForm->getValue('period'));
				$extra->setCost($editForm->getValue('cost'));
				$result = $extras->save($extra);

			}
			else
    			{
    				$editForm->populate($formData);
    				}
		}
		else
    	{
    		if($extId >0)
    		{
    			$arrayExtras = $extras->findArrayExtra($extId);
    			$editForm->populate($arrayExtras);
    			}
    			else
    			{
    				$this->_redirect('/extra');
    				}
    		}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $extId; 
    	$this->view->result = $result;
	}

	public function ajaxdeleteAction()
	{
		//
		$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$extId = $this->_getParam('id',0);
    	if($extId > 0)
    	{
    		$extras = new Worker_Models_ExtraMapper();
    		$extras->delete($extId);
    		echo "1";
    		}
    		else
    		{
    			$this->_redirect('/extra');
    			}

	}
	
	public function ajaxdisplayAction()              
   	{
   		$this->_helper->layout()->disableLayout();
   		$extId = $this->_getParam('id',0);
    	if($extId >0)
    	{
   		  $extras = new Worker_Models_ExtraMapper();
   		  $extra = new Worker_Models_Extra();
   		  $extras->find($extId,$extra);
   			$this->view->regular = $extra;
   			}
    		else
    		{
   				$this->_redirect('/worker/extra');
   				}
   	}


}

?>