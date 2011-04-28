<?php
/*
Author: Meimo
Date: 2011.4.15
*/
class Material_TransferController extends Zend_Controller_Action
{
	public function init()
	{
		//Initialize action controller here
	}

	public function preDispatch()
	{
         $this->view->render("_sidebar.phtml");
	}

	public function indexAction()
	{
		//
		$transfers = new Material_Models_TransferMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayTransfers = array();
			$key = $formData['key'];
			if($key!==null)
			{
				$condition = $formData['condition'];
				$arrayTransfers = $transfers->fetchAllJoin($key,$condition);
				if(count($arrayTransfers)==0)
				{
					$errorMsg = 2;
					//waring a message  :  no match result
				}
			}
			else
			{
				$errorMsg = 1;
				//waring a message  :  please input a key word
			}
		}
		else
		{
			$arrayTransfers = $transfers->fetchAllJoin();
		}
		$this->view->arrayTransfers = $arrayTransfers;
		$this->view->errorMsg = $errorMsg;
	}

	public function addAction()
	{
		//
		$addForm = new Material_Forms_TransferSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$addForm->approvId->setAttrib('class','hide');
		$addForm->approvDate->setAttrib('class','hide');
		$errorMsg = null;
		$transfers = new Material_Models_TransferMapper();
		$transfers->populateTransferDd($addForm);

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$transfer = new Material_Models_Transfer();
				$transfer->setProjectId($addForm->getValue('projectId'));
				$transfer->setTrsDate($addForm->getValue('trsDate'));
				$transfer->setOrigId($addForm->getValue('origId'));
				$transfer->setDestId($addForm->getValue('destId'));
				$transfer->setApplicId($addForm->getValue('applicId'));
				$transfer->setApplicDate($addForm->getValue('applicDate'));
				$transfer->setPlanType($addForm->getValue('PlanType'));
				$transfer->setTotal($addForm->getValue('total'));
				$transfer->setRemark($addForm->getValue('remark'));
				$transfers->save($transfer);
				$errorMsg = General_Models_Text::$text_save_success;
				if($btClicked=='保存继续新建')
				{
					$addForm->getElement('projectId')->setValue('');
					$addForm->getElement('trsDate')->setValue('');
					$addForm->getElement('origId')->setValue('');
					$addForm->getElement('destId')->setValue('');
					$addForm->getElement('applicId')->setValue('');
					$addForm->getElement('applicDate')->setValue('');
					$addForm->getElement('planType')->setValue('');
					$addForm->getElement('total')->setValue('');
					$addForm->getElement('remark')->setValue('');
					}
					else
					{
						$this->_redirect('/material/transfer');
						}
			}
			else
			{
				$this->populate($formData);
			}
		}
		$this->view->errorMsg = $errorMsg;
		$this->view->addForm = $addForm;
	}

	public function editAction()
	{
		//
		$editForm = new Material_Forms_transferSave();
		$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');

		$transfers = new Material_Models_TransferMapper();
    	$trsId = $this->_getParam('id',0);

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
			{
				$transfer = new Material_Models_Transfer();
				$transfer->settrsId($trsId);
				$transfer->setProjectId($editForm->getValue('projectId'));
				$transfer->setTrsDate($editForm->getValue('trsDate'));
				$transfer->setOrigId($editForm->getValue('origId'));
				$transfer->setDestId($editForm->getValue('destId'));
				$transfer->setApplicId($editForm->getValue('applicId'));
				$transfer->setApplicDate($editForm->getValue('applicDate'));
				$transfer->setPlanType($editForm->getValue('PlanType'));
				$transfer->setApprovId($editForm->getValue('approvId'));
				$transfer->setApprovDate($editForm->getValue('approvDate'));
				$transfer->setTotal($editForm->getValue('total'));
				$transfer->setRemark($editForm->getValue('remark'));
				$transfers->save($transfer);

				$this->_redirect('/material/transfer');
			}
			else
    			{
    				$editForm->populate($formData);
    				}
		}
		else
    	{
    		if($trsId >0)
    		{
    			$arrayTransfer = $transfers->findArrayTransfer($trsId);
    			$editForm->populate($arrayTransfer);
    			}
    			else
    			{
    				$this->_redirect('/material/transfer');
    				}
    		}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $trsId; 

	}

	public function ajaxdeleteAction()
	{
		//
		$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$trsId = $this->_getParam('id',0);
    	if($trsId > 0)
    	{
    		$transfers = new Material_Models_TransferMapper();
			try{
				$transfers->delete($trsId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
    	}
		else
		{
			$this->_redirect('/material/transfer');
		}
	}
}
?>