<?php
/*
机械设备采购单表
author:mingtingling
date:2011-4-16
vision:2.0
Modified by MeiMo
Date:Apr.21.2011
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
		$errorMsg = null;
		$purchases=new Equipment_Models_PurchaseMapper();
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
					$errorMsg = General_Models_Text::$text_searchErrorNr;
					//warning will be displayed: "没有找到符合条件的结果。"
					}
				}
				else
				{
					$errorMsg = General_Models_Text::$text_searchErrorNi;
					//warning will be displayed: "请输入搜索关键字。"
					}
		}
		else
		{
			$arrayPurchases = $purchases->fetchAllJoin();
			}
		
		$this->view->arrayPurchases = $arrayPurchases;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "equipment";
		$this->view->controller = "index";
		$this->view->modelName = "机械设备采购单";
	}
	public function addAction()
	{
        $addForm=new Equipment_Forms_PurchaseSave();
				$addForm->submit->setLabel("保存并继续添加");
				$addForm->submit2->setLabel("保存并返回");
				$purchases=new Equipment_Models_PurchaseMapper();
				$purchases->populatePurchaseDb($addForm);
					if($this->getRequest()->isPost())
						{
          		$btClicked=$this->getRequest()->getPost('submit');
		  				$formData=$this->getRequest()->getPost();
		  					if($addForm->isValid($formData))
										{
			   $purchases = new Equipment_Models_Purchase();
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
	             if($btClicked=="保存并继续添加")
				      {
						 $purchases->save($purchase);
						 $addForm->getElement('projectId')->setValue('');
						 $addForm->getElement('venId')->setValue('');
						 $addForm->getElement('buyerId')->setValue('');
						 $addForm->getElement('purDate')->setValue('');
						 $addForm->getElement('planType')->setValue('');
						 $addForm->getElement('approvId')->setValue('');
						 $addForm->getElement('approvDate')->setValue('');
						 $addForm->getElement('destId')->setValue('');
						 $addForm->getElement('freight')->setValue('');
						 $addForm->getElement('invoice')->setValue('');
						 $addForm->getElement('total')->setValue('');
						 $addForm->getElement('remark')->setValue('');
					     }
					    else
				         {
							$purchases->save($purchase);
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

    public function editAction()
    {
     $editForm=	new Equipment_Forms_PurchaseSave();
	 $editForm->submit->setLabel('保存修改');
	 $editForm->submit2->setAttrib('class','hide');
     $purchases=new Equipment_Models_PurchaseMapper();
	 $purchases->populatePurchaseDb($editForm);/*下拉条*/
     $purId=$this->_getParam('id',0);
	 if($editForm->getRequest()->isPost())
		{
		  $btClicked=$this->getRequest()->getPost('submit');
          $formData=$this->getRequest()->getPost();
		  if($addForm->isValid($formData))
			{
			  $purchase=new Equipment_Models_Purchase();
			  $purchase->setPurId($purId);
              $purchase->setProjectId($editForm->getValue('projectId'));
			  $purchase->setVenId($editForm->getValue('venId'));
			  $purchase->setBuyerId($editForm->getValue('buyerId'));
			  $purchase->setPurDate($editForm->getValue('purDate'));
			  $purchase->setPlanType($editForm->getValue('planType'));
			  $purchase->setApprovId($editForm->getValue('approvId'));
			  $purchase->setApprovDate($editForm->getValue('approvDate'));
			  $purchase->setDestId($editForm->getValue('destId'));
			  $purchase->setFreight($editForm->getValue('freight'));
			  $purchase->setInvoice($editForm->getValue('invoice'));
			  $purchase->setTotal($editForm->getValue('total'));
			  $purchase->setRemark($editForm->getValue('remark'));
              $purchases->save($purchase);
			  $this->_redirect('/equipment/purchase');

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
					 $this->redirect('/equipment/purchase');
				 }
		}/*not isPost()*/
		$this->view->editForm=$editForm;
		$this->view->purId=$purId;
    }
    
    public function ajaxdeleteAction()
    {
     $this->_helper->layout()->disableLayout();
	 $this->_helper->viewRenderer->setNoRender(true);
	 $purId = $this->_getParam('id',0);
	 if($purId>0)
		{
		 $purchases = new Equipment_Models_PurchaseMapper();
		 $purchases->delete($purId);
 		  }/*legal*/
          else
		  {
           $this->_redirect('/equipment/purchase');
		  }/*illegal*/
    }
	public function ajaxdisplayAction() /*由于indexAction里面缺少remark这一项，所以需要写这个action*/
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$purId = $this->_getParam('id',0);
		if($purId>0)
		{
			$purchases = new Equipment_Models_PurchaseMapper();
			$purchase = new Equipment_Models_Purchase();
			$purchases->find($purId,$purchase);
			$this->view->purchase = $purchase;
		}/*legal*/
		else
		{
            $this->_redirect('/equipment/purchase');
		}/*illegal*/
	}

}