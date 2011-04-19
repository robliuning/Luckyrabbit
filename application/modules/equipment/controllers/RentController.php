<?php
/*
��е�豸���޵���
author:mingtingling
date:2011-4-17
vision:2.0
*/
class Equipment_RentController extends Zend_Controller_Action
{
   public function init()
	{
	}
   public function preDisPatch()
	{
	   $this->view->render("_sidebar.phtml");
	}
	public function indexAction()
	{
		$errorMsg = null;
		$rents=new Equipment_Models_RentMapper();
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayRents = array();
			$key = $formData['key'];
			if($key != null)
			{
				$condition = $formData['condition'];
				$rents->fetchAllJoin($key,$condition);
			
				if(count($arrayRents) == 0)
				{
					$errorMsg = 0;
					//warning will be displayed: "û���ҵ����������Ľ����"
					}
				}
				else
				{
					$errorMsg = 1;
					//warning will be displayed: "�����������ؼ��֡�"
					}
		}
		else
		{
			$arrayRents = $rents->fetchAllJoin();
			}
		
		$this->view->arrayRents = $arrayRents;
		$this->view->errorMsg = $errorMsg;

	}
	public function addAction()
	{
        $addForm=new Equipment_Forms_RentSave();
		$addForm->submit->setLabel("���沢�������");
		$addForm->submit2->setLabel("���沢����");
		$rents=new Equipment_Models_RentMapper();
		$rents->populateRentDb($addForm);
		if($this->getRequest()->isPost())
		{
          $btClicked=$this->getRequest()->getPost('submit');
		  $formData=$this->getRequest()->getPost();
		  if($addForm->isValid($formData))
			{
			     $rent=new Equipment_Models_Rent();
                 $rent->setProjectId($addForm->getValue('projectId'));
				 $rent->setVenId($addForm->getValue('venId'));
				 $rent->setRendRes($addForm->getValue('rendRes'));
				 $rent->setPersonId($addForm->getValue('personId'));
				 $rent->setStartDate($addForm->getValue('startDate'));
				 $rent->setEndDate($addForm->getValue('endDate'));
				 $rent->setPlanType($addForm->getValue('planType'));
				 $rent->setApprovId($addForm->getValue('approvId'));
				 $rent->setApprovDate($addForm->getValue('approvDate'));
				 $rent->setFreight($addForm->getValue('freight'));
				 $rent->setInvoice($addForm->getValue('invoice'));
				 $rent->setTotal($addForm->getValue('total'));
				 $rent->setRemark($addForm->getValue('remark'));
                 if($btClicked=="���沢�������")
				      {
						 $rents->save($rent);
						 $addForm->getElement('projectId')->setValue('');
						 $addForm->getElement('venId')->setValue('');
						 $addForm->getElement('renRes')->setValue('');
						 $addForm->getElement('personId')->setValue('');
						 $addForm->getElement('startDate')->setValue('');
						 $addForm->getElement('endDate')->setValue('');
						 $addForm->getElement('planType')->setValue('');
						 $addForm->getElement('approvId')->setValue('');
						 $addForm->getElement('approvDate')->setValue('');
						 $addForm->getElement('freight')->setValue('');
						 $addForm->getElement('invoice')->setValue('');
						 $addForm->getElement('total')->setValue('');
						 $addForm->getElement('remark')->setValue('');
					     }
					    else
				         {
							$rents->save($rent);
							$this->_redirect('/equipment/rent');
					       }
			}/*end isValid()*/
			else
			{
				$addForm->populate($formData);
			}/*end not isValid()*/
		}/*end isPost()*/
		$this->view->addForm=$addForm;
	}

    public function editAction()
    {
     $editForm=	new Equipment_Forms_RentSave();
	 $editForm->submit->setLabel('�����޸�');
	 $editForm->submit2->setAttrib('class','hide');
     $rents=new Equipment_Models_RentMapper();
	 $rents->populateRentDb($editForm);/*������*/
     $renId=$this->_getParam('id',0);
	 if($editForm->getRequest()->isPost())
		{
		  $btClicked=$this->getRequest()->getPost('submit');
          $formData=$this->getRequest()->getPost();
		  if($addForm->isValid($formData))
			{
			  $rent=new Equipment_Models_Rent();
			  $rent->setRenId($renId);
              $rent->setProjectId($editForm->getValue('projectId'));
			  $rent->setVenId($editForm->getValue('venId'));
			  $rent->setRenRes($editForm->getValue('renRes'));
			  $rent->setPersonId($editForm->getValue('personId'));
			  $rent->setStartDate($editForm->getValue('startDate'));
			  $rent->setEndDate($editForm->getValue('endDate'));
			  $rent->setPlanType($editForm->getValue('planType'));
			  $rent->setApprovId($editForm->getValue('approvId'));
			  $rent->setApprovDate($editForm->getValue('approvDate'));
			  $rent->setFreight($editForm->getValue('freight'));
			  $rent->setInvoice($editForm->getValue('invoice'));
			  $rent->setTotal($editForm->getValue('total'));
			  $rent->setRemark($editForm->getValue('remark'));
              $rents->save($rent);
			  $this->_redirect('/equipment/rent');
			}/*end of isValid()*/
			else
			{
				$editForm->populate($formData);
			}/*not isValid()*/
		}/*end of isPost()*/
		else
		{
			  if($renId>0)
			   {
				  $arrayRent=$rents->findArrayRent($renId);
				  $editForm->populate($arrayRent);
			     }
				 else
        		 {
					 $this->redirect('/equipment/rent');
				 }
		}/*not isPost()*/
		$this->view->editForm=$editForm;
		$this->view->renId=$renId;
    }
    
    public function ajaxdeleteAction()
    {
     $this->_helper->layout()->disableLayout();
	 $this->_helper->viewRenderer->setNoRender(true);
	 $renId=$this->_getParam('id',0);
	 if($renId>0)
		{
		 $rents=new Equipment_Models_RentMapper();
		 $rents->delete($renId);
 		  }/*legal*/
          else
		  {
           $this->_redirect('/equipment/rent');
		  }/*illegal*/
    }
	public function ajaxdisplayAction() 
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$renId=$this->_getParam('id',0);
		if($renId>0)
		{
			$rents=new Equipment_Models_RentMapper();
			$rent=new Equipment_Models_Rent();
			$rents->find($renId,$rent);
			$this->view->rent=$rent;
		}/*legal*/
		else
		{
            $this->_redirect('/equipment/rent');
		}/*illegal*/
	}

}