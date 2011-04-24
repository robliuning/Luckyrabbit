<?php
/*
Created Meimo
Date Apr.17.2011
*/

class Worker_BonusController extends Zend_Controller_Action
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
		$bonuses = new Worker_Models_BonusMapper();
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
			$arrayBonuses = $bonuses->fetchAllJoin();
		}
		$this->view->arrayBonuses = $arrayBonuses;
		$this->view->errorMsg = $errorMsg;
    }

	public function addAction()
	{
		//
		$addForm = new Worker_Forms_bonusSave();
		$addForm->submit->setLabel('��������½�');
		$addForm->submit2->setLabel('���淵����ҳ');

		$bonuses = new Worker_Models_BonusMapper();
		$result = null;

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$bonus = new Worker_Models_Bonus();
				$bonus->setWorkerId($addForm->getValue('workerId'));
				$bonus->setProjectId($addForm->getValue('projectId'));
				$bonus->setBonDate($addForm->getValue('bonDate'));
				$bonus->setAmount($addForm->getValue('amount'));
				$bonus->setTypeId($addForm->getValue('typeId'));
				$bonus->setDetail($addForm->getValue('detail'));
				$result = $bonuses->save($bonus);
				if($btClicked=='��������½�')
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
						$this->_redirect('/bonus');
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
		$editForm = new Worker_Forms_bonusSave();
		$editForm->submit->setLabel('�����޸�');
    	$editForm->submit2->setAttrib('class','hide');

		$bonuses = new Worker_Models_BonusMapper();
    	$bonId = $this->_getParam('id',0);
    	$result = null;

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
			{
				$bonus = new Worker_Models_Wage();
				$bonus->setBonId($bonId);
				$bonus->setWorkerId($editForm->getValue('workerId'));
				$bonus->setProjectId($editForm->getValue('projectId'));
				$bonus->setBonDate($editForm->getValue('bonDate'));
				$bonus->setAmount($editForm->getValue('amount'));
				$bonus->setTypeId($editForm->getValue('typeId'));
				$bonus->setDetail($editForm->getValue('detail'));
				$result = $bonuses->save($bonus);

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
    			$arrayBonuses = $bonuses->findArrayBonus($bonId);
    			$editForm->populate($arrayBonuses);
    			}
    			else
    			{
    				$this->_redirect('/bonus');
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
    		$bonuses = new Worker_Models_BonusMapper();
    		$bonuses->delete($bonId);
    		echo "1";
    		}
    		else
    		{
    			$this->_redirect('/bonus');
    			}

	}
	
	public function ajaxdisplayAction()              
   	{
   		$this->_helper->layout()->disableLayout();
   		$bonId = $this->_getParam('id',0);
    	if($bonId >0)
    	{
   			$bonuses = new Worker_Models_BonusMapper();
   			$bonus = new Worker_Models_Bonus();
   			$bonuses->find($bonId,$bonus);
   			$this->view->bonus = $bonus;
   		}
    	else
    	{
   			$this->_redirect('/worker/bonus');
   		}
   	}


}

?>