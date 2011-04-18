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
		$workers = new Worker_Models_WorkerMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayWorkers = array();
			$key = $formData['key'];
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayWorkers = $workers->fetchAllJoin($key,$condition);
				if(count($arrayWorkers) == 0)
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
			$arrayWorkers = $workers->fetchAllJoin();
		}
		$this->view->arrayWorkers = $arrayWorkers;
		$this->view->errorMsg = $errorMsg;
    }

	public function addAction()
	{
		//
		$addForm = new Worker_Forms_WorkerSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');

		$workers = new Worker_Models_WorkerMapper();
		$result = null;

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$worker = new Worker_Models_Worker();
				$worker->setName($addForm->getValue('name'));
				$worker->setTeamId($addForm->getValue('teamId'));
				$worker->setPhoneNo($addForm->getValue('phoneNo'));
				$worker->setCert($addForm->getValue('cert'));
				$result = $workers->save($worker);
				if($btClicked=='保存继续新建')
				{
					$addForm->getElement('name')->setValue('');
					$addForm->getElement('teamtId')->setValue('');
					$addForm->getElement('phoneNo')->setValue('');
					$addForm->getElement('cert')->setValue('');
					}
					else
					{
						$this->_redirect('/worker');
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
		$editForm = new Worker_Forms_WorkerSave();
		$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');

		$workers = new Worker_Models_WorkerMapper();
    	$workerId = $this->_getParam('id',0);
    	$result = null;

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
			{
				$worker = new Worker_Models_Worker();
				$worker->setWorkerId($workerId);
				$worker->setName($editForm->getValue('name'));
				$worker->setTeamId($editForm->getValue('teamId'));
				$worker->setPhoneNo$editForm->getValue('phoneNo'));
				$worker->setCert($editForm->getValue('cert'));
				$result = $workers->save($worker);

			}
			else
    			{
    				$editForm->populate($formData);
    				}
		}
		else
    	{
    		if($workerId >0)
    		{
    			$arrayWorkers = $workers->findArrayWorker($workerId);
    			$editForm->populate($arrayWorkers);
    			}
    			else
    			{
    				$this->_redirect('/worker');
    				}
    		}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $workerId; 
    	$this->view->result = $result;
	}

	public function ajaxdeleteAction()
	{
		//
		$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$workerId = $this->_getParam('id',0);
    	if($workerId > 0)
    	{
    		$workers = new Worker_Models_WorkerMapper();
    		$workers->delete($workerId);
    		echo "1";
    		}
    		else
    		{
    			$this->_redirect('/worker');
    			}

	}


}

?>