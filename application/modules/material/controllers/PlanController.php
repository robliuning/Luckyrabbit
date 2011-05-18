<?php
/*
Author: Meimo
Date: 2011.4.14
*/
class Material_PlanController extends Zend_Controller_Action
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
		$plans = new Material_Models_PlanMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayPlans = array();
			$key = trim($formData['key']);
			if($key!= null)
			{
				$condition = $formData['condition'];
				$arrayPlans = $plans->fetchAllJoin($key,$condition);
				if(count($arrayPlans)==0)
				{
					$errorMsg = General_Models_Text::$text_searchErrorNr;
					//waring a message  :  no match result
				}
			}
			else
			{
				$errorMsg = General_Models_Text::$text_searchErrorNi;
				//waring a message  :  please input a key word
			}
		}
		else
		{
			$arrayPlans = $plans->fetchAllJoin();
		}
		$this->view->arrayPlans = $arrayPlans;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "material";
		$this->view->controller = "plan";
		$this->view->modelName = "材料需求计划"; 
    }
    
    public function addAction()
    {
    	$addForm = new Material_Forms_planSave();
		$addForm->submit->setLabel('下一步: 添加材料');
		$addForm->submit2->setAttrib('class','hide');
		$errorMsg = null;
		$plans = new Material_Models_PlanMapper();
		$plans->populatePlanDd($addForm);
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
    		if($addForm->isValid($formData))
			{
				$plan = new Material_Models_Plan();
				$plan->setPlanType($addForm->getValue('planType'));
				$plan->setDueDate($addForm->getValue('dueDate'));
				$plan->setProjectId($addForm->getValue('projectId'));
				$plan->setApplicId($addForm->getValue('applicId'));
				$plan->setApplicDate($addForm->getValue('applicDate'));
				$plan->setRemark($addForm->getValue('remark'));
				$id = $plans->save($plan);
				$this->_redirect('/material/mtrplan/index/id/'.$id);
			}
			else
    			{
    				$addForm->populate($formData);
    				}
		}
		$this->view->errorMsg = $errorMsg;
		$this->view->addForm = $addForm;
	}
    
    public function editAction()
    {
    	$editForm = new Material_Forms_planSave();
		$editForm->submit->setLabel('保存修改返回');
    	$editForm->submit2->setLabel('继续修改材料');

		$plans = new Material_Models_PlanMapper();
		$plans->populatePlanDd($editForm);
    	$planId = $this->_getParam('id',0);

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$btClicked = $this->getRequest()->getPost('submit');
    		if($editForm->isValid($formData))
			{
				$plan = new Material_Models_Plan();
				$plan->setplanId($planId);
				$plan->setPlanType($editForm->getValue('planType'));
				$plan->setDueDate($editForm->getValue('dueDate'));
				$plan->setProjectId($editForm->getValue('projectId'));
				$plan->setApplicId($editForm->getValue('applicId'));
				$plan->setApplicDate($editForm->getValue('applicDate'));
				$plan->setApprovId($editForm->getValue('approvId'));
				$plan->setApprovDate($editForm->getValue('approvDate'));
				$plan->setRemark($editForm->getValue('remark'));
				$plans->save($plan);
				if($btClicked == '保存修改返回')
				{
					$this->_redirect('/material/plan');
					}
					else
					{
						$this->_redirect('/material/mtrplan/index/id/'.$planId);
						} 	
			}
			else
    			{
    				$editForm->populate($formData);
    				}
		}
		else
    	{
    		if($planId >0)
    		{
    			$arrayPlan = $plans->findArrayPlan($planId);
    			$editForm->populate($arrayPlan);
    			}
    			else
    			{
    				$this->_redirect('/material/plan');
    				}
    		}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $planId; 
    }
    
    public function ajaxdeleteAction()
    {
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$planId = $this->_getParam('id',0);
    	if($planId > 0)
    	{
    		$plans = new Material_Models_PlanMapper();
			try{
				$plans->delete($planId);
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
    
    public function displayAction()
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
			$this->view->controller = "plan";
			$this->view->modelName = "材料需求计划"; 
   			//display material info
   			$mtrplans = new Material_Models_MtrplanMapper();
   			$condition = "planId";
   			$arrayMtrplans = $mtrplans->fetchAllJoin($id,$condition);
    		$this->view->arrayMtrplans = $arrayMtrplans;	
    		}
   			else
   			{
   			    $this->_redirect('/material/plan');
   				}
    }
}
?>