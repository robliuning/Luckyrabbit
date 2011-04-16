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
			$key = $formData['key'];
			if($key!==null)
			{
				$condition = $formData['condition'];
				$arrayPlans = $plans->fetchAllJoin($key,$condition);
				if(count($arrayPlans)==0)
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
			$arrayPlans = $plans->fetchAllJoin();
		}
		$this->view->arrayPlans = $arrayPlans;
		$this->view->errorMsg = $errorMsg;
    }
    
    public function addAction()
    {
    	$addForm = new Material_Forms_PlanSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$addForm->approvId->setAttrib('class','hide');
		$addForm->approvDate->setAttrib('class','hide');

		$plans = new Material_Models_PlanMapper();
		$plans->populatePlanDd($addForm);

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$plan = new Material_Models_Plan();
				$plan->setPlanType($addForm->getValue('planType'));
				$plan->setDueDate($addForm->getValue('dueDate'));
				$plan->setProjectId($addForm->getValue('projectId'));
				$plan->setApplicId($addForm->getValue('applicId'));
				$plan->setApplicDate($addForm->getValue('applicDate'));
				$plan->setTotal($addForm->getValue('total'));
				$plan->setRemark($addForm->getValue('remark'));
				$plans->save($plan);
				if($btClicked=='保存继续新建')
				{
					$addForm->getElement('planType')->setValue('');
					$addForm->getElement('dueDate')->setValue('');
					$addForm->getElement('projectId')->setValue('');
					$addForm->getElement('applicId')->setValue('');
					$addForm->getElement('applicDate')->setValue('');
					$addForm->getElement('total')->setValue('');
					$addForm->getElement('remark')->setValue('');
					}
					else
					{
						$this->_redirect('/material/plan');
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
    	$editForm = new Material_Forms_planSave();
		$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');

		$plans = new Material_Models_PlanMapper();
    	$planId = $this->_getParam('id',0);

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
			{
				$plan = new Material_Models_Plan();
				$plan->setplanId($planId);
				$plan->setPlanType($editForm->getValue('planType'));
				$plan->setDueDate($editForm->getValue('dueDate'));
				$plan->setProjectId($editForm->getValue('projectId'));
				$plan->setApplicId($editForm->getValue('applicId'));
				$plan->setApplicDate($editForm->getValue('applicDate'));
				$plan->setTotal($editForm->getValue('total'));
				$plan->setApprovId($editForm->getValue('approvId'));
				$plan->setApprovDate($editForm->getValue('approvDate'));
				$plan->setRemark($editForm->getValue('remark'));
				$plans->save($plan);

				$this->_redirect('/material/plan');
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
    		$plans->delete($planId);
    		echo "1";
    		}
    		else
    		{
    			$this->_redirect('/material/plan');
    			}
    }
}

?>