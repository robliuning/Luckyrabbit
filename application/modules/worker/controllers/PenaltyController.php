<?php
/*
Created Meimo
Date Apr.17.2011
*/

class Worker_PenaltyController extends Zend_Controller_Action
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
		$penaltys = new Worker_Models_PenaltyMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayPenaltys = array();
			$key = $formData['key'];
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayPenaltys = $penaltys->fetchAllJoin($key,$condition);
				if(count($arrayPenaltys) == 0)
				{
					$errorMsg = General_Models_Text::$text_searchErrorNr;
					}
				}
				else
				{
					$errorMsg = General_Models_Text::$tex_searchErrorNi;
					}
		}
		else
		{
			$arrayPenaltys = $penaltys->fetchAllJoin();
		}
		$this->view->arrayPenalties = $arrayPenaltys;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "worker";
		$this->view->controller = "penalty";
		$this->view->moduleName = "工人扣款";
    }

	public function addAction()
	{
		//
		$addForm = new Worker_Forms_penaltySave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');

		$penaltys = new Worker_Models_PenaltyMapper();
		$penaltys->populatePenaltyDd($addForm);
		$result = null;

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$penalty = new Worker_Models_Bonus();
				$penalty->setWorkerId($addForm->getValue('workerId'));
				$penalty->setProjectId($addForm->getValue('projectId'));
				$penalty->setBonDate($addForm->getValue('penDate'));
				$penalty->setAmount($addForm->getValue('amount'));
				$penalty->setTypeId($addForm->getValue('typeId'));
				$penalty->setDetail($addForm->getValue('detail'));
				$penalty->setRemark($addForm->getValue('remark'));
				$result = $penaltys->save($penalty);
				if($btClicked=='保存继续新建')
				{
					$addForm->getElement('workerId')->setValue('');
					$addForm->getElement('projectId')->setValue('');
					$addForm->getElement('penDate')->setValue('');
					$addForm->getElement('amount')->setValue('');
					$addForm->getElement('typeId')->setValue('');
					$addForm->getElement('detail')->setValue('');
					$addForm->getElement('remark')->setValue('');
					}
					else
					{
						$this->_redirect('worker/penalty');
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
		$editForm = new Worker_Forms_penaltySave();
		$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');

		$penaltys = new Worker_Models_PenaltyMapper();
		$penaltys->populatePenaltyDd($editForm);
    	$penId = $this->_getParam('id',0);
    	$result = null;

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
			{
				$penalty = new Worker_Models_Penalty();
				$penalty->setPenId($penId);
				$penalty->setWorkerId($editForm->getValue('workerId'));
				$penalty->setProjectId($editForm->getValue('projectId'));
				$penalty->setPenDate($editForm->getValue('penDate'));
				$penalty->setAmount($editForm->getValue('amount'));
				$penalty->setTypeId($editForm->getValue('typeId'));
				$penalty->setDetail($editForm->getValue('detail'));
				$result = $penaltys->save($penalty);

			}
			else
    			{
    				$editForm->populate($formData);
    				}
		}
		else
    	{
    		if($penId >0)
    		{
    			$arrayPenaltys = $penaltys->findArrayPenalty($penId);
    			$editForm->populate($arrayPenaltys);
    			}
    			else
    			{
    				$this->_redirect('worker/penalty');
    				}
    		}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $penId; 
    	$this->view->result = $result;
	}

	public function ajaxdeleteAction()
	{
		//
		$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$penId = $this->_getParam('id',0);
    	if($penId > 0)
    	{
    		$penaltys = new Worker_Models_PenaltyMapper();
    		try{
    			$penaltys->delete($penId);
    			echo "s";
    			}
    			catch(Exception $e)
    			{
    				echo "f";
    				}
    		}
    		else
    		{
    			$this->_redirect('worker/penalty');
    			}
    }
    
    public function ajaxdisplayAction()              
   	{
   		$this->_helper->layout()->disableLayout();
   		$penId = $this->_getParam('id',0);
    	if($penId >0)
    	{
   			$penalties = new Worker_Models_PenaltyMapper();
   			$penalty = new Worker_Models_Penalty();
   			$penalties->find($penId,$penalty);
   			$this->view->penalty = $penalty;
   		}
    	else
    	{
   			$this->_redirect('/worker/penalty');
   		}
   	}


}

?>