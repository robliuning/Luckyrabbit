<?php
/*
Created Meimo
Date Apr.17.2011
*/

class Worker_IndexController extends Zend_Controller_Action
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
		$wages = new Worker_Models_WageMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayWages = array();
			$key = $formData['key'];
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayWages = $wages->fetchAllJoin($key,$condition);
				if(count($arrayWages) == 0)
				{
					$errorMsg = 2;
					}
				}
				else
				{
					$errorMsg = 1;
					}
		}
		else
		{
			$arrayWages = $wages->fetchAllJoin();
		}
		$this->view->arrayWages = $arrayWages;
		$this->view->errorMsg = $errorMsg;
    }

	public function addAction()
	{
		//
		$addForm = new Worker_Forms_wageSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');

		$wages = new Worker_Models_WageMapper();
		$result = null;

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$wage = new Worker_Models_Wage();
				$wage->setName($addForm->getValue('name'));
				$wage->setAmount($addForm->getValue('amount'));
				$wage->setStartDate($addForm->getValue('startDate'));
				$wage->setEndDate($addForm->getValue('endDate'));
				$result = $wages->save($wage);
				if($btClicked=='保存继续新建')
				{
					$addForm->getElement('name')->setValue('');
					$addForm->getElement('amount')->setValue('');
					$addForm->getElement('startDate')->setValue('');
					$addForm->getElement('endDate')->setValue('');
					}
					else
					{
						$this->_redirect('/wage');
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

	public function editAction(0
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
				$wage->setWagId($wagId);
				$wage->setName($editForm->getValue('name'));
				$wage->setAmunt($editForm->getValue('amount'));
				$wage->setStartDate$editForm->getValue('startDate'));
				$wage->setEndDate($editForm->getValue('endDate'));
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
    			$arrayWages = $wages->findArrayWage($wageId);
    			$editForm->populate($arrayWages);
    			}
    			else
    			{
    				$this->_redirect('/worker/wage');
    				}
    		}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $wagrId; 
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
    			$this->_redirect('/worker/wage');
    			}
	}

	  public function ajaxdisplayAction()              
   	{
   		$this->_helper->layout()->disableLayout();
   		$wageId = $this->_getParam('id',0);
    	if($wageId >0)
    	{
   		    $wages = new Worker_Models_WageMapper();
   		    $wage = new Worker_Models_Wage();
   			$wages->find($wageId,$wage);
   			$this->view->wage = $wage;
   			}
    		else
    		{
   				$this->_redirect('/worker/wage');
   				}
   	}
}

?>