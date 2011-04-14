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
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			
			$key = $formData['key'];
			$condition = $formData['condition'];
			$arrayPurchases = $purchases->fetchAllJoin($key,$condition);
		}
		else
		{
			$arrayPurchases = $purchases->fetchAllJoin();
			}
		
		$this->view->arrayPurchases = $arrayPurchases;
    }
    
    public function addAction()
    {
       	$addForm = new Material_Forms_purchaseSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');

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
				$purchase->setDate($addForm->getValue('date'));
				$purchase->setDestId($addForm->getValue('destId'));
				$purchase->setFreight($addForm->getValue('freight'));
				$purchase->setInvoice($addForm->getValue('invoice'));
				$purchase->setRemark($addForm->getValue('remark'));
				$purchases->save($purchase);
				if($btClicked=='保存继续新建')
				{
					$addFrom->getElement('projectId')->setValue('');
					$addFrom->getElement('venId')->setValue('');
					$addFrom->getElement('buyerId')->setValue('');
					$addFrom->getElement('date')->setValue('');
					$addFrom->getElement('destId')->setValue('');
					$addFrom->getElement('freight')->setValue('');
					$addFrom->getElement('invoice')->setValue('');
					$addFrom->getElement('remark')->setValue('');
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
				$purchase->setProjectId($editForm->getValue('projectId'));
				$purchase->setVenId($editForm->getValue('venId'));
				$purchase->set	BuyerId($editForm->getValue('buyerId'));
				$purchase->setDate($editForm->getValue('date'));
				$purchase->setDestId($editForm->getValue('destId'));
				$purchase->setFreight($editForm->getValue('freight'));
				$purchase->setInvoice($editForm->getValue('invoice'));
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
    			$arraypurchase = $purchases->findArrayPurchase($purId);
    			$editForm->populate($arraypurchase);
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
    		echo "1";
    		}
    		else
    		{
    			$this->_redirect('/material/purchase');
    			}
    }
}

?>