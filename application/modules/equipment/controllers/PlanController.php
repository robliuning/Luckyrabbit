<?php
/*
�����豸����ƻ�
author:mingtingling
date:2011-4-16
vision:2.0
*/
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
		$plans=new Equipment_Models_PlanMapper();
		$this->view->plans=$plans->fetchAllJoin();
	}
	public function addAction()
	{
		$addForm=new Equipment_Forms_PlanSave();
		$addForm->submit->setLabel("���");
		$addForm->submit2->setLabel("���沢�������");
		$addForm->submit3->setLabel("���沢����");
		$addForm->submit4->setLabel("����");
		$plans=new Equipment_Models_PlanMapper();
        $plans->populatePlanDb($addForm);
		if($this->getRequest()->isPost())
		{
          $btClicked=$this->getRequest()->getPost('submit');
		  $formData=$this->getRequest()->getPost();
		  if($addForm->isValid($formData))
			{
			   $plan=new Equipment_Models_Plan();
			   $plan->setPlanType($addForm->getValue('planType'));
			   $plan->setProjectId($addForm->getValue('projectId'));
			   $plan->setDueDate($addForm->getValue('dueDate'));
			   $plan->setApplicId($addForm->getValue('applicId'));
			   $plan->setApplicDate($addForm->getValue('applicDate'));
			   $plan->setApprovId($addForm->getValue('approvId'));
			   $plan->setApprovDate($addForm->getValue('approvDate'));
			   $plan->setTotal($addForm->getValue('total'));
			   $plan->setRemark($addForm->getValue('remark'));
			   if($btClicked=="���")
				{
				   $addForm->getElement('dueDate').setValue('');
				   $addForm->getElement('applicDate').setValue('');
				   $addForm->getElement('approvDate').setValue('');
				   $addForm->getElement('total').setValue('');
				   $addForm->getElement('remark').setValue('');
				   $plans->populatePlanDb($addForm);/*���ܻ������Ϊ�Ұ����������˵�����������������*/
				    }
				   else if($btClicked=="���沢�������")
				    {
					   $plans->save($plan);
				       $addForm->getElement('dueDate').setValue('');
				       $addForm->getElement('applicDate').setValue('');
				       $addForm->getElement('approvDate').setValue('');
				       $addForm->getElement('total').setValue('');
				       $addForm->getElement('remark').setValue('');
                       $plans->populatePlanDb($addForm);/*���ܻ����*/
					   }
					   else if($btClicked=="���沢����")
				       {
						   $plans->save($plan);
						   $this->_redirect('/equipment/plan');
					      }
						  else
				          {
						   $this->_redirect('/equipment/plan');
						  }
			}/*end isValid()*/
            else
			{
				$addForm->populate($formData);
			}/*end not valid()*/
		}/*end isPost()*/
		$this->view->addForm=$addForm;
	}
	public function editAction()
	{
       $editForm=new Equipment_Forms_PlanSave();
       $editForm->submit->setLabel("���");
	   $editForm->submit2->setLabel("�����޸�");
	   $editForm->submit3->setAttrib('class','hide');
	   $editForm->submit4->setLabel("����");
	   $planId=$this->_getParam('id',0);
	   $plans=new Equipment_Models_PlanMapper();
	   $plans->populatePlanDb($editForm);
       if($this->getRequest()->isPost())
		{
		   $btClicked=$this->getRequest()->getPost('submit');
		   $formData=$this->getRequest()->getPost();
		   if($editForm->isValid($formData))
			{
			   $plan=new Equipment_Models_Plan();
			   $plan->setPlanId($planId);
			   $plan->setPlanType($editForm->getValue('planType'));
			   $plan->setProjectId($editForm->getValue('projectId'));
			   $plan->setDueDate($editForm->getValue('dueDate'));
			   $plan->setApplicId($editForm->getValue('applicId'));
			   $plan->setApplicDate($editForm->getValue('applicDate'));
			   $plan->setApprovId($editForm->getValue('approvId'));
			   $plan->setApprovDate($editForm->getValue('approvDate'));
			   $plan->setTotal($editForm->getValue('total'));
			   $plan->setRemark($editForm->getValue('remark'));
			   if($btClicked=="���")
				{
				   $editForm->getElement('dueDate').setValue('');
				   $editForm->getElement('applicDate').setValue('');
				   $editForm->getElement('approvDate').setValue('');
				   $editForm->getElement('total').setValue('');
				   $editForm->getElement('remark').setValue('');
				   $plans->populatePlanDb($editForm); /*�˴����ܻ����*/
				  }
                  else if($btClicked=="�����޸�")
				  {
					  $plans->save($plan);
					  $this->_redirect('/equipment/plan');
				  }
				  else
				  {
					  $this->_redirect('/equipment/plan');
				  }
			}/*end isValid()*/
			else
			{
				$editForm->populate($formData);
			}/*end not isValid()*/
		}/*end isPost()*/
		else
		{
			if($planId>0)
			{
				$arrayPlan=$plans->findArrayPlan($planId);
				$editForm->populate($arrayPlan);
			}
			else
			{
				$this->_redirect('/equipment/plan');
			}
		}/*end not isPost()*/
      $this->view->editForm=$editForm;
	  $this->view->planId=$planId;
	}
	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$planId=$this->_getParam('id',0);
		if($planId)
		{
			$plans=new Equipment_Models_PlanMapper();
            $plans->delete($planId);
		}
		else
		{
			$this->_redirect('equipment/plan');
		}
	}
}