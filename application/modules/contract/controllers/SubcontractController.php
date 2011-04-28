<?php
/*
author:mingtingling
date:2011.4.10
vision:2.0
Modified Meimo
Date :  Apr.15.2011
*/
class Contract_SubcontractController  extends Zend_Controller_Action
{
	public function init()
	{
     /*初始化*/
	}
  	
  	public function preDisPatch()
	{
    	$this->view->render("_sidebar.phtml");
	}
  
  	public function indexAction() /*addAction*/
    {
		$subcontracts = new Contract_Models_SubcontractMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arraySubcontracts = array();
			$key = trim($formData['key']);
			if($key!= null)
			{
				$condition = $formData['condition'];
				$arraySubcontracts = $subcontracts->fetchAllJoin($key,$condition);
				if(count($arraySubcontracts)==0)
				{
					$errorMsg = General_Models_Text::$text_searchErrorNr;
					//waring a message  :  no match result
				}
			}
			else
			{
				$errorMsg = General_Models_Text::$text_searchErrorNi;
				//waring a message  :  please input a key word
			}
		}
		else
		{
			$arraySubcontracts = $subcontracts->fetchAllJoin();
		}
		$this->view->arraySubcontracts = $arraySubcontracts;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "contract";
		$this->view->controller = "subcontract";
		$this->view->modelName = "分包单信息";
	}

	public function addAction()
	{
		$addForm = new Contract_Forms_subcontractSave();
		$addForm->submit->setLabel("保存新建");
		$addForm->submit2->setAttrib('class','hide');
		$errorMsg = null;
		$subcontracts = new Contract_Models_SubcontractMapper();
		
		$subcontracts->populateSubcontractDd($addForm);
		
		if($this->getRequest()->isPost())
	  	{
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
		    {
       			$subcontract = new Contract_Models_Subcontract();
			  	$subcontract->setProjectId($addForm->getValue('projectId'));
				$subcontract->setScontrType($addForm->getValue('scontrType'));
				$subcontract->setContractorId($addForm->getValue('contractorId'));
				$subcontract->setScontrDetail($addForm->getValue('scontrDetail'));
				$subcontract->setQuality($addForm->getValue('quality'));
				$subcontract->setStartDateExp($addForm->getValue('startDateExp'));
				$subcontract->setEndDateExp($addForm->getValue('endDateExp'));
				$subcontract->setStartDateAct($addForm->getValue('startDateAct'));
				$subcontract->setEndDateAct($addForm->getValue('endDateAct'));
				$subcontract->setBrConContr($addForm->getValue('brConContr'));
				$subcontract->setBrResContr($addForm->getValue('brResContr'));
				$subcontract->setBrConSContr($addForm->getValue('brConSContr'));
				$subcontract->setBrResSContr($addForm->getValue('brResSContr'));
				$subcontract->setWarranty($addForm->getValue('warranty'));
				$subcontract->setContrAmt($addForm->getValue('contrAmt'));
				$subcontract->setConsMargin($addForm->getValue('consMargin'));
        		$subcontract->setPrjMargin($addForm->getValue('prjMargin'));
				$subcontract->setPrjWarr($addForm->getValue('prjWarr'));
				$subcontract->setRemark($addForm->getValue('remark'));
				$subcontracts->save($subcontract);
				$errorMsg = General_Models_Text::$text_save_success;
				$this->_redirect('/contract/subcontract');
			}
			else
			{
				$addForm->populate($formData);
			}
		}
		$this->view->errorMsg = $errorMsg;
		$this->view->addForm = $addForm;

	}
	
	public function editAction()
	{
	  	$editForm = new Contract_Forms_subcontractSave();
	  	$editForm->submit->setLabel("保存修改");
	  	$editForm->submit2->setAttrib('class','hide');
	  	
	  	$subcontracts = new Contract_Models_SubcontractMapper();
	  	$scontrId = $this->_getParam('id',0);
	  	
	  	$subcontracts->populateSubcontractDd($editForm);
	  	
	  	if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
        		$subcontract = new Contract_Models_Subcontract();
				$subcontract->setScontrId($scontrId);
			  	$subcontract->setProjectId($editForm->getValue('projectId'));
				$subcontract->setScontrType($editForm->getValue('scontrType'));
				$subcontract->setContractorId($editForm->getValue('contractorId'));
				$subcontract->setScontrDetail($editForm->getValue('scontrDetail'));
				$subcontract->setQuality($editForm->getValue('quality'));
				$subcontract->setStartDateExp($editForm->getValue('startDateExp'));
				$subcontract->setEndDateExp($editForm->getValue('endDateExp'));
				$subcontract->setStartDateAct($editForm->getValue('startDateAct'));
				$subcontract->setEndDateAct($editForm->getValue('endDateAct'));
				$subcontract->setBrConContr($editForm->getValue('brConContr'));
				$subcontract->setBrResContr($editForm->getValue('brResContr'));
				$subcontract->setBrConSContr($editForm->getValue('brConSContr'));
				$subcontract->setBrResSContr($editForm->getValue('brResSContr'));
				$subcontract->setWarranty($editForm->getValue('warranty'));
				$subcontract->setContrAmt($editForm->getValue('contrAmt'));
				$subcontract->setConsMargin($editForm->getValue('consMargin'));
        		$subcontract->setPrjMargin($editForm->getValue('prjMargin'));
				$subcontract->setPrjWarr($editForm->getValue('prjWarr'));
				$subcontract->setRemark($editForm->getValue('remark'));
				$subcontracts->save($subcontract);
				$this->_redirect('/contract/subcontract');
				} 
				else
			    {
					$editForm->populate($formData);
					}
		   	}
			else
		   	{
				if($scontrId>0)
				{
					$arraySubcontract = $subcontracts->findArraySubcontract($scontrId);
					$editForm->populate($arraySubcontract);
					}
					else
			    	{
						$this->_redirect('/contract/subcontract');
			        	}
		   		}
		$this->view->id = $scontrId;
		$this->view->editForm = $editForm;		
	}
	
	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$scontrId = $this->_getParam('id',0);
		if($scontrId>0)
		{
			$subcontracts = new Contract_Models_SubcontractMapper();
			try{
				$subcontracts->delete($scontrId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/contract/subcontract');
			}
	}
	
	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$scontrId = $this->_getParam('id',0);
		if($scontrId > 0)
		{
			$subcontracts = new Contract_Models_SubcontractMapper();
			$subcontract = new Contract_Models_Subcontract();
			$subcontracts->find($scontrId,$subcontract);
			
			$this->view->subcontract = $subcontract;
			}
			else
			{
				$this->_redirect('/contract/subcontract');
				}
	}
}