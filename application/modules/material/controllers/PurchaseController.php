<?php
//Author: Meimo
//Date: 2011.4.14
class Material_PurchaseController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }
    
    public function preDispatch()
	{
		$this->view->render("_sidebar.phtml");
	}

    public function indexAction()
    {
		$purchases = new Material_Models_PurchaseMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayPurchases = array();
			$key = $formData['key'];
			if($key!==null)
			{
				$condition = $formData['condition'];
				$arrayPurchases = $purchases->fetchAllJoin($key,$condition);
				if(count($arrayPurchases)==0)
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
			$arrayPurchases = $purchases->fetchAllJoin();
		}
		$this->view->arrayPurchases = $arrayPurchases;
		$this->view->errorMsg = $errorMsg;
    }
    
    public function addAction()
    {
       	$addForm = new Material_Forms_purchaseSave();
				$addForm->submit->setLabel('保存继续新建');
				$addForm->submit2->setLabel('保存返回上页');
				$addForm->approvId->setAttrib('class','hide');
				$addForm->approvDate->setAttrib('class','hide');
		$errorMsg = null;
		$purchases = new Material_Models_PurchaseMapper();
		$purchases->populatePurchaseDd($addForm);

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$purchase = new Material_Models_Purchase();
				$purchase->setProjectId($addForm->getValue('projectId'));
				$purchase->setVenId($addForm->getValue('venId'));
				$purchase->set	BuyerId($addForm->getValue('buyerId'));
				$purchase->setPurDate($addForm->getValue('purDate'));
				$purchase->setDestId($addForm->getValue('destId'));
				$purchase->setFreight($addForm->getValue('freight'));
				$purchase->setInvoice($addForm->getValue('invoice'));
				$purchase->setRemark($addForm->getValue('remark'));
				$purchases->save($purchase);
				$errorMsg = General_Models_Text::$text_save_success;
				if($btClicked=='保存继续新建')
				{
					$addForm->getElement('projectId')->setValue('');
					$addForm->getElement('venId')->setValue('');
					$addForm->getElement('buyerId')->setValue('');
					$addForm->getElement('purDate')->setValue('');
					$addForm->getElement('destId')->setValue('');
					$addForm->getElement('freight')->setValue('');
					$addForm->getElement('invoice')->setValue('');
					$addForm->getElement('remark')->setValue('');
					}
					else
					{
						$this->_redirect('/material/purchase');
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
        $editForm = new Material_Forms_purchaseSave();
				$editForm->submit->setLabel('保存修改');
    		$editForm->submit2->setAttrib('class','hide');

				$purchases = new Material_Models_PurchaseMapper();
    		$purId = $this->_getParam('id',0);

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
			{
				$purchase = new Material_Models_Purchase();
				$purchase->setPurId($purId);
				$purchase->setProjectId($editForm->getValue('projectId'));
				$purchase->setVenId($editForm->getValue('venId'));
				$purchase->set	BuyerId($editForm->getValue('buyerId'));
				$purchase->setPurDate($editForm->getValue('purDate'));
				$purchase->setDestId($editForm->getValue('destId'));
				$purchase->setFreight($editForm->getValue('freight'));
				$purchase->setInvoice($editForm->getValue('invoice'));
				$purchase->setApprovId($editForm->getValue('approvId'));
				$purchase->setApprovDate($editForm->getValue('approvDate'));
				$purchase->setRemark($editForm->getValue('remark'));
				$purchases->save($purchase);

				$this->_redirect('/material/purchase');
			}
			else
    			{
    				$editForm->populate($formData);
    				}
		}
		else
    	{
    		if($purId >0)
    		{
    			$arrayPurchase = $purchases->findArrayPurchase($purId);
    			$editForm->populate($arrayPurchase);
    			}
    			else
    			{
    				$this->_redirect('/material/purchase');
    				}
    		}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $purId; 
    }
    
    public function ajaxdeleteAction()
    {
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$purId = $this->_getParam('id',0);
    	if($purId > 0)
    	{
    		$purchases = new Material_Models_PurchaseMapper();
    		$purchases->delete($purId);
			try{
				$purchases->delete($purId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
    	}
    	else
    	{
    		$this->_redirect('/material/purchase');
    	}
    }
}
?>