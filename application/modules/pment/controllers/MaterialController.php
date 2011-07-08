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
			
			$this->view->mplan = $mplan;
			$this->view->planId = $planId;
			$this->view->module = "pment";
			$this->view->controller = "material";
			$this->view->modelName = "月计划材料信息"; 
			//display material info
			$this->view->arrayMaterials = $arrayMaterials;	
		
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
					$material->setUnit($formData['unit']);
					$material->setSpec($formData['spec']);
					$material->setAmount($formData['amount']);
					$material->setWeight($formData['weight']);
					$material->setLimitation($formData['limitation']);
					$material->setInDate($formData['inDate']);
					$material->setRemark($formData['remark']);
					$materials->save($material);
					$this->_redirect('/pment/material/index/id/'.$planId);
					}
					else
					{
						$this->view->errorMsg = $errorMsg;
						}
				}
			}
			else
			{
				$this->_redirect('/pment/mplan');
				}
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