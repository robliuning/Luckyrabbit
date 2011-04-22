<?php
/*
�̶��ʲ��۾ɱ�
author:mingtingling
date:2011-4-17
vision:2.0
*/
class Asset_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }
    public function preDisPatch()
	{
		$this->view->render("_sidebar.phtml");
	}
    public function indexAction()
    {
		$errorMsg = null;
		$purchases = new Asset_Models_PurchaseMapper();
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayPurchases = array();
			$key = $formData['key'];
			if($key != null)
			{
				$condition = $formData['condition'];
				$purchases->fetchAllJoin($key,$condition);
				
				if(count($arrayPurchases) == 0)
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
			$arrayPurchases = $purchases->fetchAllJoin();
			}
		
		$this->view->arrayPurchases = $arrayPurchases;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "asset";
		$this->view->controller = "index";
		$this->view->modelName = "�̶��ʲ�������Ϣ";
    }
    public function addAction()
    {
           $addForm=new Asset_Forms_PurchaseSave();
		   $addForm->submit->setLabel("���沢�������");
		   $addForm->submit2->setLabel("���沢����");
		   $purchases=new Asset_Models_PurchaseMapper();
		   $purchases->populatePurchaseDb($addForm);/*������*/
	       if($this->getRequest()->isPost())
		     {
			   $btClicked=$this->getRequest()->getPost('submit');
			   $formData=$this->getRequest()->getPost();
			   if($addForm->isValid($formData))
				 {
				   $purchase=new Asset_Models_Purchase();
				   $purchase->setName($addForm->getValue('name'));
				   $purchase->setVenId($addForm->getValue('venId'));
				   $purchase->setType($addForm->getValue('type'));
				   $purchase->setSpec($addForm->getValue('spec'));
				   $purchase->setInvoice($addForm->getValue('invoice'));
				   $purchase->setUnit($addForm->getValue('unit'));
				   $purchase->setPrice($addForm->getValue('price'));
				   $purchase->setQuantity($addForm->getValue('quantity'));
				   $purchase->setAmount($addForm->getValue('amount'));
				   $purchase->setContactId($addForm->getValue('contactId'));
				   $purchase->setPurDate($addForm->getValue('purDate'));
				   $purchase->setApprovId($addForm->getValue('approvId'));
				   $purchase->setApprovDate($addForm->getValue('approvDate'));
				   $purchase->setRemark($addForm->getValue('remark'));
				   if($btClicked=="���沢�������")
					     {
						    $purchases->save($purchase);
							/*������ܻ����*/
							$addForm->getElement('name')->setValue('');
							$addForm->getElement('venId')->setValue('');
							$addForm->getElement('type')->setValue('');
							$addForm->getElement('spec')->setValue('');
							$addForm->getElement('invoice')->setValue('');
							$addForm->getElement('unit')->setValue('');
							$addForm->getElement('price')->setValue('');
							$addForm->getElement('quantity')->setValue('');
							$addForm->getElement('amount')->setValue('');
							$addForm->getElement('contactId')->setValue('');
							$addForm->getElement('purDate')->setValue('');
							$addForm->getElement('approvId')->setValue('');
							$addForm->getElement('approvDate')->setValue('');
							$addForm->getElement('remark')->setValue('');
							$purchases->populatePurchaseDb($addForm);
						    }
							else
					        {
								$purchases->save($purchase);
								$this->_redirect('/asset');
							   }
				 }
				 else
				 {
					 $addForm->populate($formData);
				 }
		     }
		$this->view->addForm=$addForm;
	}  
    
    public function editAction()
    {
     $editForm=	new Asset_Forms_PurchaseSave();
	 $editForm->submit->setLabel('�����޸�');
	 $editForm->submit2->setAttrib('class','hide');
     $purchases=new Asset_Models_PurchaseMapper();
	 $purchases->populatePurchaseDb($editForm);/*������*/
     $purId=$this->_getParam('id',0);
	 if($editForm->getRequest()->isPost())
		{
          $formData=$this->getRequest()->getPost();
		  if($addForm->isValid($formData))
			{
			  $purchase=new Asset_Models_Purchase();
			  $purchase->setPurId($purId);
              $purchase->setName($editForm->getValue('name'));
              $purchase->setType($editForm->getValue('type'));
              $purchase->setSpec($editForm->getValue('spec'));
              $purchase->setInvoice($editForm->getValue('invoice'));
              $purchase->setUnit($editForm->getValue('unit'));
              $purchase->setPrice($editForm->getValue('price'));
              $purchase->setQuantity($editForm->getValue('quantity'));
              $purchase->setAmount($editForm->getValue('amount'));
              $purchase->setPurDate($editForm->getValue('purDate'));
              $purchase->setapprovDate($editForm->getValue('approvDate'));
			  $purchase->setRemark($editForm->getValue('remark'));
              $purchases->save($purchase);
			  $this->_redirect('/asset');

			}/*end of isValid()*/
			else
			{
				$editForm->populate($formData);
			}/*not isValid()*/
		}/*end of isPost()*/
		else
		{
			  if($purId>0)
			   {
				  $arrayPurchase=$purchases->findArrayPurchase($purId);
				  $editForm->populate($arrayPurchase);
			     }
				 else
        		 {
					 $this->redirect('/asset');
				 }
		}/*not isPost()*/
		$this->view->editForm=$editForm;
		$this->view->purId=$purId;
    }
    
    public function ajaxdeleteAction()
    {
     $this->_helper->layout()->disableLayout();
	 $this->_helper->viewRenderer->setNoRender(true);
	 $purId=$this->_getParam('id',0);
	 if($purId>0)
		{
		 $purchases=new Asset_Models_PurchaseMapper();
		 $purchases->delete($purId);
 		  }/*legal*/
          else
		  {
           $this->_redirect('/asset');
		  }/*illegal*/
    }
	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$purId=$this->_getParam('id',0);
		if($purId>0)
		{
			$purchases=new Asset_Models_PurchaseMapper();
			$purchase=new Asset_Models_Purchase();
			$purchases->find($purId,$purchase);
			$this->view->purchase=$purchase;
		}/*legal*/
		else
		{
            $this->_redirect('/asset');
		}/*illegal*/
	}
}