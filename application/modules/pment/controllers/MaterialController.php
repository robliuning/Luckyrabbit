<?php
//Updated in5th July by rob

class Pment_MaterialController extends Zend_Controller_Action
{

	public function init()
	{
		$projectId = null;
		$projectNamespace = new Zend_Session_Namespace('projectNamespace');
		if(isset($projectNamespace->projectId))
		{
			$projectId = $projectNamespace->projectId;
			}
			else
			{
				$this->_redirect('/');
				}
		$projects = new Project_Models_ProjectMapper();
		$project = new Project_Models_Project();
		$projects->find($projectId,$project);
		$this->view->project = $project;
		$this->view->module = "pment";
		$this->view->controller = "material";
	}
	
	public function preDispatch()
	{
		$this->view->render("_sidebar.phtml");
	}

	public function indexAction()
	{
		$planId = $this->_getParam('id',0);
		$errorMsg = null;
		
		if($planId > 0)
		{
			$projectId = $this->getProjectId();
			$mplans = new Pment_Models_MplanMapper();
			$mplan = new Pment_Models_Mplan();
			$mplans->find($planId,$mplan);
			$materials = new Pment_Models_MaterialMapper();
			$condition = "planId";
			$arrayMaterials = $materials->fetchAllJoin($planId,$condition);
			if($this->getRequest()->isPost())
			{
				$formData = $this->getRequest()->getPost();
				$array = $materials->dataValidator($formData);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$material = new Pment_Models_Material();
					$material->setPlanId($planId);
					$material->setType($formData['type']);
					$material->setMName($formData['mName']);
					$material->setSpec($formData['spec']);
					$material->setUnit($formData['unit']);
					$material->setAmount($formData['amount']);
					$material->setInDate($formData['inDate']);
					$material->setRemark($formData['remark']);
					$materials->save($material);
					$message = General_Models_Text::$text_mplan_material_add_sucess;
					$this->_helper->flashMessenger->addMessage($message);
					$this->_redirect('/pment/material/index/id/'.$planId);
					}
					else
					{
						$this->view->errorMsg = $errorMsg;
						}
				}
			$this->view->mplan = $mplan;
			$this->view->planId = $planId;
			$this->view->modelName = "材料计划材料信息";
			//display material info
			$this->view->arrayMaterials = $arrayMaterials;
			$this->view->messages = $this->_helper->flashMessenger->getMessages();
			}
			else
			{
				$this->_redirect('/pment/mplan');
				}
	}
	
	public function ajaxaddAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$materials = new Pment_Models_MaterialMapper();
		$material = new Pment_Models_Material();
		$material->setPlanId($this->_getParam('planId'));
		$material->setType($this->_getParam('type'));
		$material->setMName($this->_getParam('mName'));
		$material->setSpec($this->_getParam('spec'));
		$material->setUnit($this->_getParam('unit'));
		$material->setAmount(0);
		$material->setAmountc($this->_getParam('amountc'));
		$material->setBudget($this->_getParam('budget'));
		$material->setBudgetTotal($this->_getParam('budgetTotal'));
		$material->setInDate($this->_getParam('inDate'));
		$material->setRemark($this->_getParam('remark'));
		$material->setAmountf($this->_getParam('amountf'));
		$material->setCost($this->_getParam('cost'));
		$material->setCostTotal($this->_getParam('costTotal'));
		$material->setVendorName($this->_getParam('vendorName'));
		$id = $materials->save($material);
		echo $id;
	}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$mtrId = $this->_getParam('id',0);
		if($mtrId > 0)
		{
			$materials = new Pment_Models_MaterialMapper();
			try{
				$materials->delete($mtrId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/pment/mplan');
		}
	}
	
	public function ajaxfindAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		
		$mtrId = $this->_getParam('mtrId',0);
		if($mtrId > 0)
		{
			$materials = new Pment_Models_MaterialMapper();
			$arrayMaterial = $materials->findMaterial($mtrId);
			$json = Zend_Json::encode($arrayMaterial);
			echo $json;
			}
			else
			{
				$this->_redirect('/pment/mplan');
				}
	}

	protected function getProjectId()
	{
		$projectNamespace = new Zend_Session_Namespace('projectNamespace');
		return $projectNamespace->projectId;
		}
	
	protected function getUserId()
	{
		$userNamespace = new Zend_Session_Namespace('userNamespace');
		return $userNamespace->userId;
		}
}
?>