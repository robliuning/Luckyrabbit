<?php
/*
Created Meimo
Date Apr.17.2011
*/

class Worker_WorkerController extends Zend_Controller_Action
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
			$arrayWorkers = $workers->fetchAllJoin();
		}
		$this->view->arrayWorkers = $arrayWorkers;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "worker";
		$this->view->controller = "worker";
		$this->view->modelName = "工人信息";
    }

	public function addAction()
	{
		//
		$addForm = new Worker_Forms_WorkerSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');

		$workers = new Worker_Models_WorkerMapper();
		$workers->populateWorkerDd($addForm);
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
				$worker->setAddress($addForm->getValue('address'));
				$worker->setCert($addForm->getValue('cert'));
				$worker->setSkill($addForm->getValue('skill'));
				$worker->setRemark($addForm->getValue('remark'));
				$result = $workers->save($worker);
				if($btClicked=='保存继续新建')
				{
					$addForm->getElement('name')->setValue('');
					$addForm->getElement('teamId')->setValue('');
					$addForm->getElement('phoneNo')->setValue('');
					$addForm->getElement('cert')->setValue('');
					}
					else
					{
						$this->_redirect('/worker/worker');
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
		$editForm = new Worker_Forms_WorkerSave();
		$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');

		$workers = new Worker_Models_WorkerMapper();
		$workers->populateWorkerDd($editForm);
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
				$worker->setPhoneNo($editForm->getValue('phoneNo'));
				$worker->setAddress($editForm->getValue('address'));
				$worker->setCert($editForm->getValue('cert'));
				$worker->setSkill($editForm->getValue('skill'));
				$worker->setRemark($editForm->getValue('remark'));
			
				$result = $workers->save($worker);
				$this->_redirect('/worker/worker');
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
    				$this->_redirect('/worker/worker');
    				}
    		}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $workerId; 
    	$this->view->result = $result;
	}

	public function ajaxdeleteAction()
	{
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
    			$this->_redirect('/worker/worker');
    			}
	}
	
	public function displayAction()
	{
   		$id = $this->_getParam('id',0);
    	if($id >0)
    	{
   		    $workers = new Worker_Models_WorkerMapper();
   		    $worker = new Worker_Models_Worker();
   			$workers->find($id,$worker);
   			$wages = new Worker_Models_WageMapper();
   			$bonuses = new Worker_Models_BonusMapper();
   			$penalties = new Worker_Models_PenaltyMapper();
   			$condition = "workerId";
   			$arrayWages = $wages->fetchAllJoin($id,$condition);
   			$arrayBonuses = $bonuses->fetchAllJoin($id,$condition);
   			$arrayPenalties = $penalties->fetchAllJoin($id,$condition);
   			
   			$this->view->worker = $worker;
   			$this->view->arrayWages = $arrayWages;
   			$this->view->arrayBonuses = $arrayBonuses;
   			$this->view->arrayPenalties = $arrayPenalties;
   			
   			}
    		else
    		{
   				$this->_redirect('/worker/worker');
   				}
	}
	
	public function autocompleteAction()
   	{
   	  	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    	$key = $this->_getParam('key');
    	$workers = new Worker_Models_WorkerMapper();
    	$arrayNames = $workers->findWorkerNames($key);
    	$json = Zend_Json::encode($arrayNames);  	
    	echo $json;
   		}
}
?>