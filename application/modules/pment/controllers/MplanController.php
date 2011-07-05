<?php
//updated in 1st July by Rob

class Pment_MplanController extends Zend_Controller_Action
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
		$projectId =$this->getProjectId();
		$mplans = new Pment_Models_MplanMapper();
		$errorMsg = null;
		$condition[0] = $projectId;
		$condition[1] = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayMplans = array();
			$key = trim($formData['key']);
			if($key!= null)
			{
				$condition[1] = $formData['condition'];
				$arrayMplans = $mplans->fetchAllJoin($key,$condition);
				if(count($arrayMplans) == 0)
				{
					$errorMsg = General_Models_Text::$text_searchErrorNr;
				}
			}
			else
			{
				$errorMsg = General_Models_Text::$text_searchErrorNi;
			}
		}
		else
		{
			$arrayMplans = $mplans->fetchAllJoin(null,$condition);
		}
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayMplans = $arrayMplans;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "pment";
		$this->view->controller = "mplan";
		$this->view->modelName = "材料月计划信息"; 
	}
	
	public function addAction()
	{
		$projectId =$this->getProjectId();
		$addForm = new Pment_Forms_MplanSave();
		$addForm->submit->setLabel('保存并添加材料');
		$addForm->submit2->setAttrib('class','hide');
		$errorMsg = null;
		$mplans = new Pment_Models_MplanMapper();
		$mplans->populateDd($addForm);
		$addForm = $mplans->formValidator($addForm,0);
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $mplans->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$userId = $this->getUserId();
					$users = new System_Models_UserMapper();
					$contactId = $users->getContactId($userId); 
					$mplan = new Pment_Models_Mplan();
					$mplan->setProjectId($projectId);
					$mplan->setYearNum($addForm->getValue('yearNum'));
					$mplan->setMonNum($addForm->getValue('monNum'));
					$mplan->setPDate($addForm->getValue('pDate'));
					$mplan->setContactId($contactId);
					$mplan->setRemark($addForm->getValue('remark'));
					$mplan->setStatus(0);
					$id = $mplans->save($mplan);
					$this->_redirect('/pment/material/index/id/'.$id);
				}
				else
				{
					$addForm->populate($formData);
					}
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
		$editForm = new Pment_Forms_MplanSave();
		$editForm->submit->setLabel('保存修改返回');
		$editForm->submit2->setLabel('继续修改材料');

		$mplans = new Pment_Models_MplanMapper();
		$mplans->populateDd($editForm);
		$planId = $this->_getParam('id',0);
		$projectId =$this->getProjectId();
		$editForm = $mplans->formValidator($editForm,1);

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$btClicked = $this->getRequest()->getPost('submit');
			if($editForm->isValid($formData))
			{
				$array = $mplans->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$userId = $this->getUserId();
					$users = new System_Models_UserMapper();
					$contactId = $users->getContactId($userId); 
					$mplan = new Pment_Models_Mplan();
					$mplan->setPlanId($planId);
					$mplan->setProjectId($projectId);
					$mplan->setYearNum($editForm->getValue('yearNum'));
					$mplan->setMonNum($editForm->getValue('monNum'));
					$mplan->setPDate($editForm->getValue('pDate'));
					$mplan->setStatus(0);
					$mplan->setContactId($contactId);
					$mplan->setRemark($editForm->getValue('remark'));
					$mplans->save($mplan);
					if($btClicked == '保存修改返回')
					{
						$this->_redirect('/pment/mplan');
						}
						else
						{
							$this->_redirect('/pment/material/index/id/'.$planId);
							}
					}
					else
					{
						$editForm->populate($formData);
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
				$arrayMplan = $mplans->findArrayMplan($planId);
				$editForm->populate($arrayMplan);
				}
				else
				{
					$this->_redirect('pment/mplan');
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
			$mplans = new Pment_Models_MplanMapper();
			try{
				$mplans->delete($planId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('pment/mplan');
		}
	}
	
	/*public function displayAction()
	{
		$id = $this->_getParam('id',0);
		
		if($id > 0)
		{
			//display plan info
			$mplans = new Pment_Models_MplanMapper();
		  	$mplan = new Pment_Models_Mplan();
			$mplans->find($id,$mplan);
			$this->view->plan = $mplan;
			$this->view->id = $id;		
			$this->view->module = "material";
			$this->view->controller = "plan";
			$this->view->modelName = "材料需求计划"; 
			//display material info
			$mtrplans = new Pment_Models_MtrplanMapper();
			$condition = "planId";
			$arrayMtrplans = $mtrplans->fetchAllJoin($id,$condition);
			$this->view->arrayMtrplans = $arrayMtrplans;	
			}
			else
			{
				$this->_redirect('/material/plan');
				}
	}*/
	
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