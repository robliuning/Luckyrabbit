<?php
/*
Author: Meimo
Date: 2011.4.14
*/
class Material_MtrplanController extends Zend_Controller_Action
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
		$id = $this->_getParam('id',0);
   		
   		if($id > 0)
   		{
   			//display plan info
   			$plans = new Material_Models_PlanMapper();
   		  	$plan = new Material_Models_Plan();
   			$plans->find($id,$plan);
   			$this->view->plan = $plan;
   			$this->view->id = $id;		
   			$this->view->module = "material";
			$this->view->controller = "mtrplan";
			$this->view->modelName = "材料"; 
   			//display material info
   			$mtrplans = new Material_Models_MtrplanMapper();
   			$condition = "planId";
   			$arrayMtrplans = $mtrplans->fetchAllJoin($id,$condition);
    		$this->view->arrayMtrplans = $arrayMtrplans;	
   		
   			if($this->getRequest()->isPost())
			{
				$formData = $this->getRequest()->getPost();
				$mplan = new Material_Models_Mtrplan();
				$mplan->setPlanId($id);
				$mplan->setMtrId($formData['mtrId']);
				$mplan->setPrice($formData['price']);					
				$mplan->setQuantity($formData['quantity']);
				$mtrplans->save($mplan);
				$this->_redirect('/material/mtrplan/index/id/'.$id);
				}	
   			}
   			else
   			{
   			    $this->_redirect('/material/plan');
   				}
    }
            
    public function ajaxdeleteAction()
    {
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   		$mplanId = $this->_getParam('id',0);
    	if($mplanId > 0)
    	{
    		$mplans = new Material_Models_MtrplanMapper();
			try{
				$mplans->delete($mplanId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
    	}
    	else
    	{
    		$this->_redirect('/material/plan');
    	}
    }
}
?>