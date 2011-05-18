<?php
/*
Created Meimo
Date Apr.17.2011
*/

class Worker_RegularController extends Zend_Controller_Action
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
		$regulars = new Worker_Models_RegularMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayRegulars = array();
			$key = $formData['key'];
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayRegulars = $regulars->fetchAllJoin($key,$condition);
				if(count($arrayRegulars) == 0)
				{
					$errorMsg = General_Models_Text::$test_SearchErrorNr;
					}
				}
				else
				{
					$errorMsg = General_Models_Text::$test_SearchErrorNi;
					}
		}
		else
		{
			$arrayRegulars = $regulars->fetchAllJoin();
		}
		$this->view->arrayRegulars = $arrayRegulars;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "worker";
		$this->view->controller = "regular";
		$this->view->modelName = "计划派工信息";
    }

	public function addAction()
	{
		$addForm = new Worker_Forms_regularSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');

		$regulars = new Worker_Models_RegularMapper();
		$regulars->populateRegularDd($addForm);
		$result = null;

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$regular = new Worker_Models_Regular();
				$regular->setProjectId($addForm->getValue('projectId'));
				$regular->setItem($addForm->getValue('item'));
				$regular->setNumber($addForm->getValue('number'));
				$regular->setStartDate($addForm->getValue('startDate'));
				$regular->setEndDate($addForm->getValue('endDate'));
				$regular->setBudget($addForm->getValue('budget'));
				$regular->setCost($addForm->getValue('cost'));
				$regular->setRemark($addForm->getValue('remark'));			
				$result = $regulars->save($regular);
				if($btClicked=='保存继续新建')
				{
					$addForm->getElement('projectId')->setValue('');
					$addForm->getElement('item')->setValue('');
					$addForm->getElement('number')->setValue('');
					$addForm->getElement('startDate')->setValue('');
					$addForm->getElement('endDate')->setValue('');
					$addForm->getElement('remark')->setValue('');
					$addForm->getElement('budget')->setValue('');
					$addForm->getElement('cost')->setValue('');
					}
					else
					{
						$this->_redirect('worker/regular');
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

	public function editAction()
	{
		//
		$editForm = new Worker_Forms_regularSave();
		$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');

		$regulars = new Worker_Models_RegularMapper();
		$regulars->populateRegularDd($editForm);
    	$regId = $this->_getParam('id',0);
    	$result = null;

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
			{
				$regular = new Worker_Models_Regular();
				$regular->setRegularId($regId);
				$regular->setProjectId($editForm->getValue('projectId'));
				$regular->setItem($editForm->getValue('item'));
				$regular->setNumber($editForm->getValue('number'));
				$regular->setStartDate($editForm->getValue('startDate'));
				$regular->setEndDate($editForm->getValue('endDate'));
				$regular->setBudget($editForm->getValue('budget'));
				$regular->setCost($editForm->getValue('cost'));
				$result = $regulars->save($regular);
			}
			else
    			{
    				$editForm->populate($formData);
    				}
		}
		else
    	{
    		if($regId >0)
    		{
    			$arrayRegular = $regulars->findArrayRegular($regId);
    			$editForm->populate($arrayRegular);
    			}
    			else
    			{
    				$this->_redirect('/worker/regular');
    				}
    		}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $regId; 
    	$this->view->result = $result;
	}

	public function ajaxdeleteAction()
	{
		//
		$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$regId = $this->_getParam('id',0);
    	if($regId > 0)
    	{
    		$regulars = new Worker_Models_RegularMapper();
    		try{
    			$regulars->delete($regId);
    			echo "s";
    			}
    			catch(Exception $e)
    			{
    				echo "f";
    				}
    		}
    		else
    		{
    			$this->_redirect('/worker/regular');
    			}

	}
	public function ajaxdisplayAction()              
   	{
   		$this->_helper->layout()->disableLayout();
   		$regId = $this->_getParam('id',0);
    	if($regId >0)
    	{
   			$regulars = new Worker_Models_RegularMapper();
   			$regular = new Worker_Models_Regular();
   			$regulars->find($regId,$regular);
   			$this->view->regular = $regular;
   		}
    	else
    	{
   			$this->_redirect('/worker/regular');
   		}
   	}


}

?>