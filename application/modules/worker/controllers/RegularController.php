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
				$arrayRegulars = $wages->fetchAllJoin($key,$condition);
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
    }

	public function addAction()
	{
		//
		$addForm = new Worker_Forms_regularSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');

		$regulars = new Worker_Models_RegularMapper();
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
				$regular->setPeriod($addForm->getValue('period'));
				$result = $regulars->save($regular);
				if($btClicked=='保存继续新建')
				{
					$addForm->getElement('projectId')->setValue('');
					$addForm->getElement('item')->setValue('');
					$addForm->getElement('number')->setValue('');
					$addForm->getElement('startDate')->setValue('');
					$addForm->getElement('endDate')->setValue('');
					$addForm->getElement('period')->setValue('');
					}
					else
					{
						$this->_redirect('/regular');
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
		$editForm = new Worker_Forms_wageSave();
		$editForm->submit->setLabel('保存修改');
    $editForm->submit2->setAttrib('class','hide');

		$wages = new Worker_Models_WageMapper();
    $wagId = $this->_getParam('id',0);
    $result = null;

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
    	if($editForm->isValid($formData))
			{
				$wage = new Worker_Models_Wage();
				$wage->setRegularId($regId);
				$wage->setProjectId($editForm->getValue('projectId'));
				$wage->setItem($editForm->getValue('item'));
				$wage->setNumber($editForm->getValue('number'));
				$wage->setStartDate$editForm->getValue('startDate'));
				$wage->setEndDate($editForm->getValue('endDate'));
				$wage->setPeriod($editForm->getValue('period'));
				$result = $wages->save($wage);

			}
			else
    			{
    				$editForm->populate($formData);
    				}
		}
		else
    	{
    		if($wagId >0)
    		{
    			$arrayWage = $wages->findArrayWage($wagId);
    			$editForm->populate($arrayWage);
    			}
    			else
    			{
    				$this->_redirect('/wage');
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
   
   
   		$wagId = $this->_getParam('id',0);
    	if($wagId > 0)
    	{
    		$wages = new Worker_Models_WageMapper();
    		$wages->delete($wagId);
    		echo "1";
    		}
    		else
    		{
    			$this->_redirect('/wage');
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