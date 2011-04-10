<?php
/*
author:mingtingling
date:2011.4.10
vision:2.0
*/
class Contract_SubcontractController  extends Zend_Controller_Action
{
  public function init()
	{
     /*��ʼ��*/
	}
  public function preDisPatch()
	{
     $this->view->render("_sidebar.phtml");
	}
  public function indexAction() /*addAction*/
    {
		$addForm=new Contract_Forms_SubcontractSave();
		$addForm->submit->setLabel("�����½�");
		$addForm->submit2->setAttrib('class','hide');
		$subcontracts=new Contract_Models_SubcontractMapper();
		if($this->getRequest()->isPost())
		   {
			$formData=$this->getRequest()->getPost();
			if($addForm->isValid($formData))
			    {
                $subcontract=new Contract_Models_Subcontract();
			    $subcontract->setProjectId($addForm->getValue('projectId'));
				$subcontract->setScontrType($addForm->getValue('scontrType'));
				$subcontract->setContractorId($addForm->getValue('contractorId'));
				$subcontract->setScontrDetail($addForm->getValue('scontrDetail'));
				$subcontract->setQuality($addForm->getValue('quality'));
				$subcontract->setStartDateExp($addForm->getValue('startDateExp'));
				$subcontract->setEndDateExp($addForm->getValue('endDateExp'));
				$subcontract->setPeriodExp($addForm->getValue('periodExp'));
				$subcontract->setStartDateAct($addForm->getValue('startDateAct'));
				$subcontract->setEndDateAct($addForm->getValue('endDateAct'));
				$subcontract->setPeriodAct($addForm->getValue('periodAct'));
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
				$this->_redirect('/contract');
			             }
				       else
			            {
						   $addForm->populate($formData);
				        }
		   }
		  $this->view->addForm=$addForm;
	}
public function editForm()
	{
	  $editForm=Contract_Forms_SubcontractSave();
	  $editForm->submit->setLabel("�����޸�");
	  $editForm->submit2->setAttrib('class','hide');
	  $subcontracts=new Contract_Models_SubcontractMapper();
	  $scontrId=$this->_getParam('id',0);
	  if($editForm->getRequest()->isPost())
		   {
		      $formData=$this->getRequest()->getPost();
			  if($editForm->isValid($formData))
			      {
                $subcontract=new Contract_Models_Subcontract();
				$subcontract->setScontrId($editForm->getValue('scontrId'));
			    $subcontract->setProjectId($editForm->getValue('projectId'));
				$subcontract->setScontrType($editForm->getValue('scontrType'));
				$subcontract->setContractorId($editForm->getValue('contractorId'));
				$subcontract->setScontrDetail($editForm->getValue('scontrDetail'));
				$subcontract->setQuality($editForm->getValue('quality'));
				$subcontract->setStartDateExp($editForm->getValue('startDateExp'));
				$subcontract->setEndDateExp($editForm->getValue('endDateExp'));
				$subcontract->setPeriodExp($editForm->getValue('periodExp'));
				$subcontract->setStartDateAct($editForm->getValue('startDateAct'));
				$subcontract->setEndDateAct($editForm->getValue('endDateAct'));
				$subcontract->setPeriodAct($editForm->getValue('periodAct'));
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
				$this->_redirect('/contract');
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
				   $arraySubcontract=$subcontracts->findArraySubcontract($scontrId);
				   $editForm->populate($arraySubcontract);
			         }
					 else
			        {
						 $this->_redirect('/contract');
			        }
		   }
	}
	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$scontrId=$this->_getParam('id',0);
		if($scontrId>0)
		   {
			 $subcontracts=new Contract_Models_SubcontractMapper();
			 $subcontracts->delete($scontrId);
		      }
              else
		      {
				  $this->_redirect('/contract');
		      }
	}
	public function ajaxdisplayAction()
	{
		$scontrId=$this->_getParam('id',0);
		if($scontrId>0)
		   {
			  $subcontracts=new Contract_Models_SubcontractMapper();
			  $arraySubcontracts=$subcontracts->fetchAllSubcontracts();
			  $this->view->arraySubcontracts=$arraySubcontracts;
		       }
			   else
		      {
				   $this->_redirect('/contract');
		      }
		   
	}
}