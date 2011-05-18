<?php
class Equipment_PlanController extends Zend_Controller_Action
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
		$plans = new Equipment_Models_PlanMapper();
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayPlans = array();
			$key = trim($formData['key']);
			if($key != null)
			{
				$condition = $formData['condition'];
				$arryPlans = $plans->fetchAllJoin($key,$condition);
				
				if(count($arrayPlans) == 0)
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
			$arrayPlans = $plans->fetchAllJoin();
			}
		
		$this->view->arrayPlans = $arrayPlans;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "equipment";
		$this->view->controller = "plan";
		$this->view->modelName = "机械设备需求计划";
	}
	
	public function addAction()
	{
		$addForm = new Equipment_Forms_planSave();
		$addForm->submit->setLabel("下一步: 添加设备");
		$addForm->submit2->setAttrib('class','hide');
		$errorMsg = null;
		
		$plans = new Equipment_Models_PlanMapper();
    	$plans->populatePlanDd($addForm);
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$plan = new Equipment_Models_Plan();
				$plan->setPlanType($addForm->getValue('planType'));
				$plan->setProjectId($addForm->getValue('projectId'));
			    $plan->setDueDate($addForm->getValue('dueDate'));
			    $plan->setApplicId($addForm->getValue('applicId'));
			    $plan->setApplicDate($addForm->getValue('applicDate'));
			    $plan->setRemark($addForm->getValue('remark'));
				$id = $plans->save($plan);
				$this->_redirect('/equipment/eqpplan/index/id/'.$id);
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
		$editForm = new Equipment_Forms_PlanSave();
		$editForm->submit->setLabel('保存修改返回');
    	$editForm->submit2->setLabel('继续修改材料');
	   	$planId=$this->_getParam('id',0);
	   	$plans = new Equipment_Models_PlanMapper();
	  	$plans->populatePlanDd($editForm);
      	if($this->getRequest()->isPost())
		{
		   $btClicked = $this->getRequest()->getPost('submit');
		   $formData = $this->getRequest()->getPost();
		   if($editForm->isValid($formData))
			{
			   	$plan = new Equipment_Models_Plan();
			   	$plan->setPlanId($planId);
			   	$plan->setPlanType($editForm->getValue('planType'));
			   	$plan->setProjectId($editForm->getValue('projectId'));
			   	$plan->setDueDate($editForm->getValue('dueDate'));
			   	$plan->setApplicId($editForm->getValue('applicId'));
			   	$plan->setApplicDate($editForm->getValue('applicDate'));
			   	$plan->setRemark($editForm->getValue('remark'));
				$plans->save($plan);
				if($btClicked == '保存修改返回')
				{
					$this->_redirect('/equipment/plan');
					}
					else
					{
						$this->_redirect('/equipment/eqpplan/index/id/'.$planId);
						} 				}/*end isValid()*/
			else
			{
				$editForm->populate($formData);
			}/*end not isValid()*/
		}/*end isPost()*/
		else
		{
			if($planId>0)
			{
				$arrayPlan = $plans->findArrayPlan($planId);
				$editForm->populate($arrayPlan);
			}
			else
			{
				$this->_redirect('/equipment/plan');
			}
		}/*end not isPost()*/
      $this->view->editForm = $editForm;
	  $this->view->planId = $planId;
	}
	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$planId = $this->_getParam('id',0);
		if($planId)
		{
			$plans = new Equipment_Models_PlanMapper();
      $plans->delete($planId);
		}
		else
		{
			$this->_redirect('equipment/plan');
		}
	}
	public function ajaxdisplay()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$planId = $this->_getParam('id',0);
		if($planId>0)
		{
			$plans = new Equipment_Models_PlanMapper();
			$plan = new Equipment_Models_Plan();
			$plans->find($planId,$plan);
			$this->view->plan = $plan;
		}
		else
		{
            $this->_redirect('/equipment/plan');
		}
		}
}