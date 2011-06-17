<?php
//updated in 14th june by Rob

class Pment_CpController extends  Zend_Controller_Action
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
		$errorMsg = null;
		$cps = new Pment_Models_CpMapper();
		$addForm = new Pment_Forms_CpSave();
		$contractors = new Contract_Models_ContractorMapper();
		$addForm->submit->setLabel("添加");
		$contractors->populateContractors($addForm);

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$array = $cps->dataValidator($formData,$projectId);
			$trigger = $array['trigger'];
			$errorMsg = $array['errorMsg'];
			if($trigger == 0)
			{
				$cp = new Pment_Models_Cp();
				$cp->setProjectId($projectId);
				$cp->setContractorId($formData['contractorId']);
				$cps->save($cp);
				$errorMsg = General_Models_Text::$text_save_success;
				}
			}
		$condition = 'projectId';
		$key = $projectId;
		$arrayCps = $cps->fetchAllJoin($key,$condition);
		$this->view->addForm = $addForm;
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayCps = $arrayCps;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "pment";
		$this->view->controller = "cp";
		$this->view->modelName = "工程承包商信息";
	}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$cpId = $this->_getParam('id',0);
		if($cpId > 0)
		{
			$cps = new Pment_Models_CpMapper();
			try{
				$cps->delete($cpId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
		$this->_redirect('/pment/cp');
		}
	}
	
	protected function getProjectId()
	{
		$projectNamespace = new Zend_Session_Namespace('projectNamespace');
		return $projectNamespace->projectId;
		}
}
