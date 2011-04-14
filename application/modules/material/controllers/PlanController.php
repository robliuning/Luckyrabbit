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
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			
			$key = $formData['key'];
			$condition = $formData['condition'];
			$arrayPlans = $plans->fetchAllJoin($key,$condition);
		}
		else
		{
			$arrayPlans = $plans->fetchAllJoin();
			}
		
		$this->view->arrayPlans = $arrayPlans;
    }
    
    public function addAction()
    {
    	$addForm = new Material_Forms_PlanSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');

		$plans = new Material_Models_PlanMapper();
		$plans->populatePlanDd($addForm);

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$plan = new Material_Models_Plan();
				$plan->setType($addForm->getValue('type'));
				$plan->setDueDate($addForm->getValue('dueDate'));
				$plan->setProjectId($addForm->getValue('projectId'));
				$plan->setApplicId($addForm->getValue('applicId'));
				$plan->setApplicDate($addForm->getValue('applicDate'));
				$plan->setRemark($addForm->getValue('remark'));
				$plans->save($plan);
				if($btClicked=='保存继续新建')
				{
					$addFrom->getElement('type')->setValue('');
					$addFrom->getElement('dueDate')->setValue('');
					$addFrom->getElement('projectId')->setValue('');
					$addFrom->getElement('applicId')->setValue('');
					$addFrom->getElement('applicDate')->setValue('');
					$addFrom->getElement('remark')->setValue('');
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
				$plan->setName($editForm->getValue('name'));
				$plan->setTypeId($editForm->getValue('typeId'));
				$plan->setSpec($editForm->getValue('spec'));
				$plan->setUnit($editForm->getValue('unit'));
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