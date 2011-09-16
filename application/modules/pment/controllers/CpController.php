<?php
//updated in 14th june by Rob

class Pment_CpController extends  Zend_Controller_Action
{
	public function init()
	{
		$this->_loadProject();
		$this->_pushLocations();
		$this->_loadMenu();
		$this->_loadSidebar();
		$this->_userAccess();
		$this->_pushFuncs();
		}

	public function preDispatch()
	{
		$this->view->render("_sidebar.phtml");
	}
	
	public function indexAction()
	{
		$projectId =$this->_getProjectId();
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
				$errorMsg = "添加成功";
				}
			}
		$condition = 'projectId';
		$key = $projectId;
		$arrayCps = $cps->fetchAllJoin($key,$condition);
		if(count($arrayCps) != 0)
		{
			$pageNumber = $this->_getParam('page');
			$arrayCps->setCurrentPageNumber($pageNumber);
			$arrayCps->setItemCountPerPage('20');
			}
		$this->view->addForm = $addForm;
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayCps = $arrayCps;
		$this->view->errorMsg = $errorMsg;
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
}
