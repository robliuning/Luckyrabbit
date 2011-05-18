<?php
class Equipment_EqpplanController extends Zend_Controller_Action
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
   			$plans = new Equipment_Models_PlanMapper();
   		  	$plan = new Equipment_Models_Plan();
   			$plans->find($id,$plan);
   			$this->view->plan = $plan;
   			$this->view->id = $id;		
   			$this->view->module = "equipment";
			$this->view->controller = "eqpplan";
			$this->view->modelName = "设备"; 
   			//display material info
   			$eqpplans = new Equipment_Models_EqpplanMapper();
   			$condition = "planId";
   			$arrayEqpplans = $eqpplans->fetchAllJoin($id,$condition);
    		$this->view->arrayEqpplans = $arrayEqpplans;	
   		
   			if($this->getRequest()->isPost())
			{
				$formData = $this->getRequest()->getPost();
				$eplan = new Equipment_Models_Eqpplan();
				$eplan->setPlanId($id);
				$eplan->setEqpId($formData['eqpId']);
				$eplan->setPrice($formData['price']);					
				$eplan->setQuantity($formData['quantity']);
				$eqpplans->save($eplan);
				$this->_redirect('/equipment/eqpplan/index/id/'.$id);
				}	
   			}
   			else
   			{
   			    $this->_redirect('/equipment/plan');
   				}
    }
           
    public function ajaxdeleteAction()
    {
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   		$eplanId = $this->_getParam('id',0);
    	if($eplanId > 0)
    	{
    		$eplans = new Equipment_Models_EqpplanMapper();
			try{
				$eplans->delete($eplanId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
    	}
    	else
    	{
    		$this->_redirect('/equipment/plan');
    	}
    }
}
?>