<?php
/*
机械设备采购单表
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
		$addForm->submit->setLabel("清空");
		$addForm->submit2->setLabel("保存并继续添加");
		$addForm->submit3->setLabel("保存并返回");
		$addForm->submit4->setLabel("返回");
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
				 if($btClicked=="清空")
				    {
					  $addForm->getElement('purDate').setValue('');
					  $addForm->getElement('approvDate').setValue('');
					  $addForm->getElement('freight').setValue('');
					  $addForm->getElement('total').setValue('');
					  $addForm->getElement('remark').setValue('');
					  /*以下可能是错误的*/
					   $purchases->populatePurchaseDb($addForm);
				      }
					  else if($btClicked=="保存并继续添加")
				      {
						 $purchases->save($purchase);
						 $addForm->getElement('purDate').setValue('');
						 $addForm->getElement('approvDate').setValue('');
						 $addForm->getElement('freight').setValue('');
						 $addForm->getElement('total').setValue('');
						 $addForm->getElement('remark').setValue('');
						 /*以下可能会出错*/
						 $purchases->populatePurchaseDb($addForm);
					     }
					    else if($btClicked=="保存并返回")
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
	/*明天继续的点*/
}