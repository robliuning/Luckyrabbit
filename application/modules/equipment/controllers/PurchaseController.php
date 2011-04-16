<?php
/*
��е�豸�ɹ�����
author:mingtingling
date:2011-4-16
vision:2.0
*/
class Equipment_PurchaseController extends Zend_Controller_Action
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
		$purchases=new Equipment_Models_PurchaseMapper();
		$this->view->purchases=$purchases->fetchAllJoin();
	}
	public function addAction()
	{
        $addForm=new Equipment_Forms_PurchaseSave();
		$addForm->submit->setLabel("���");
		$addForm->submit2->setLabel("���沢�������");
		$addForm->submit3->setLabel("���沢����");
		$addForm->submit4->setLabel("����");
		$purchases=new Equipment_Models_PurchaseMapper();
		$purchases->populatePurchaseDb($addForm);
		if($this->getRequest()->isPost())
		{
          $btClicked=$this->getRequest()->getPost('submit');
		  $formData=$this->getRequest()->getPost();
		  if($addForm->isValid($formData))
			{
			     $purchase=new Equipment_Models_Purchase();
                 $purchase->setProjectId($addForm->getValue('projectId'));
				 $purchase->setVenId($addForm->getValue('venId'));
				 $purchase->setBuyerId($addForm->getValue('buyerId'));
				 $purchase->setPurDate($addForm->getValue('purDate'));
				 $purchase->setPlanType($addForm->getValue('planType'));
				 $purchase->setApprovId($addForm->getValue('approvId'));
				 $purchase->setApprovDate($addForm->getValue('approvDate'));
				 $purchase->setDestId($addForm->getValue('destId'));
				 $purchase->setFreight($addForm->getValue('freight'));
				 $purchase->setInvoice($addForm->getValue('invoice'));
				 $purchase->setTotal($addForm->getValue('total'));
				 $purchase->setRemark($addForm->getValue('remark'));
				 if($btClicked=="���")
				    {
					  $addForm->getElement('purDate').setValue('');
					  $addForm->getElement('approvDate').setValue('');
					  $addForm->getElement('freight').setValue('');
					  $addForm->getElement('total').setValue('');
					  $addForm->getElement('remark').setValue('');
					  /*���¿����Ǵ����*/
					   $purchases->populatePurchaseDb($addForm);
				      }
					  else if($btClicked=="���沢�������")
				      {
						 $purchases->save($purchase);
						 $addForm->getElement('purDate').setValue('');
						 $addForm->getElement('approvDate').setValue('');
						 $addForm->getElement('freight').setValue('');
						 $addForm->getElement('total').setValue('');
						 $addForm->getElement('remark').setValue('');
						 /*���¿��ܻ����*/
						 $purchases->populatePurchaseDb($addForm);
					     }
					    else if($btClicked=="���沢����")
				         {
							$purchases->save($purchase);
							$this->_redirect('/equipment/purchase');
					       }
						   else
			               {
							   $this->_redirect('/equipment/purchase');
						   }
			}/*end isValid()*/
			else
			{
				$addForm->populate($formData);
			}/*end not isValid()*/
		}/*end isPost()*/
		$this->view->addForm=$addForm;
	}
	/*��������ĵ�*/
}