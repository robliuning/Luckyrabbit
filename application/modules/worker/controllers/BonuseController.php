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
		$bonuses = new Worker_Models_BonuseMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayBonuses = array();
			$key = $formData['key'];
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayBonuses = $bonuses->fetchAllJoin($key,$condition);
				if(count($arrayBonuses) == 0)
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
			$arrayBonuses = $bonuses->fetchAllJoin();
		}
		$this->view->arrayBonuses = $arrayBonuses;
		$this->view->errorMsg = $errorMsg;
    }

	public function addAction()
	{
		//
		$addForm = new Worker_Forms_bonuseSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');

		$bonuses = new Worker_Models_BonuseMapper();
		$result = null;

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$bonuse = new Worker_Models_Bonuse();
				$bonuse->setWorkerId($addForm->getValue('workerId'));
				$bonuse->setProjectId($addForm->getValue('projectId'));
				$bonuse->setBonDate($addForm->getValue('bonDate'));
				$bonuse->setAmount($addForm->getValue('amount'));
				$bonuse->setTypeId($addForm->getValue('typeId'));
				$bonuse->setDetail($addForm->getValue('detail'));
				$result = $bonuses->save($bonuse);
				if($btClicked=='保存继续新建')
				{
					$addForm->getElement('workerId')->setValue('');
					$addForm->getElement('projectId')->setValue('');
					$addForm->getElement('bonDate')->setValue('');
					$addForm->getElement('amount')->setValue('');
					$addForm->getElement('typeId')->setValue('');
					$addForm->getElement('detail')->setValue('');
					}
					else
					{
						$this->_redirect('/bonuse');
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
		$editForm = new Worker_Forms_bonuseSave();
		$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');

		$bonuses = new Worker_Models_BonuseMapper();
    	$bonId = $this->_getParam('id',0);
    	$result = null;

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
			{
				$bonuse = new Worker_Models_Wage();
				$bonuse->setBonId($bonId);
				$bonuse->setWorkerId($editForm->getValue('workerId'));
				$bonuse->setProjectId($editForm->getValue('projectId'));
				$bonuse->setBonDate$editForm->getValue('bonDate'));
				$bonuse->setAmount($editForm->getValue('amount'));
				$bonuse->setTypeId($editForm->getValue('typeId'));
				$bonuse->setDetail($editForm->getValue('detail'));
				$result = $bonuses->save($bonuse);

			}
			else
    			{
    				$editForm->populate($formData);
    				}
		}
		else
    	{
    		if($bonId >0)
    		{
    			$arrayBonuses = $bonuses->findArrayBonuse($bonId);
    			$editForm->populate($arrayBonuses);
    			}
    			else
    			{
    				$this->_redirect('/bonuse');
    				}
    		}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $bonId; 
    	$this->view->result = $result;
	}

	public function ajaxdeleteAction()
	{
		//
		$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$bonId = $this->_getParam('id',0);
    	if($bonId > 0)
    	{
    		$bonuses = new Worker_Models_BonuseMapper();
    		$bonuses->delete($bonId);
    		echo "1";
    		}
    		else
    		{
    			$this->_redirect('/bonuse');
    			}

	}


}

?>