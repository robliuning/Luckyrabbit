<?php
//updated in 22th June by Rob

class Pment_SubcontractController extends Zend_Controller_Action
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
	
	public function preDisPatch()
	{
		$this->view->render("_sidebar.phtml");
	}

	public function indexAction()
	{
		$projectId =$this->getProjectId();
		$subcontracts = new Pment_Models_SubcontractMapper();
		$errorMsg = null;
		$condition[0] = $projectId;
		$condition[1] = null;
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arraySubcontracts = array();
			$key = trim($formData['key']);
			if($key!= null)
			{
				$condition[1] = $formData['condition'];
				$arraySubcontracts = $subcontracts->fetchAllJoin($key,$condition);
				if(count($arraySubcontracts)==0)
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
			$arraySubcontracts = $subcontracts->fetchAllJoin(null,$condition);
		}
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arraySubcontracts = $arraySubcontracts;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "pment";
		$this->view->controller = "subcontract";
		$this->view->modelName = "工程分包单信息";
	}

	public function addAction()
	{
		$projectId =$this->getProjectId();
		$addForm = new Pment_Forms_SubcontractSave();
		$addForm->submit->setLabel("保存新建");
		$addForm->submit2->setAttrib('class','hide');
		$errorMsg = null;
		$subcontracts = new Pment_Models_SubcontractMapper();
		$subcontracts->populateSubcontractDd($addForm,$projectId);
		$addForm = $subcontracts->formValidator($addForm,0);
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $subcontracts->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$subcontract = new Pment_Models_Subcontract();
					$subcontract->setProjectId($projectId);
					$subcontract->setScontrType($addForm->getValue('scontrType'));
					$subcontract->setContractorId($addForm->getValue('contractorId'));
					$subcontract->setDetail($addForm->getValue('detail'));
					$subcontract->setContent($addForm->getValue('content'));
					$subcontract->setQuality($addForm->getValue('quality'));
					$subcontract->setStartDateExp($addForm->getValue('startDateExp'));
					$subcontract->setEndDateExp($addForm->getValue('endDateExp'));
					$subcontract->setStartDateAct($addForm->getValue('startDateAct'));
					$subcontract->setEndDateAct($addForm->getValue('endDateAct'));
					$subcontract->setBrConContr($addForm->getValue('brConContr'));
					$subcontract->setBrResContr($addForm->getValue('brResContr'));
					$subcontract->setBrConSContr($addForm->getValue('brConSContr'));
					$subcontract->setBrResSContr($addForm->getValue('brResSContr'));
					$subcontract->setContrAmt($addForm->getValue('contrAmt'));
					$subcontract->setGuarantee($addForm->getValue('guarantee'));
					$subcontract->setPrjMargin($addForm->getValue('prjMargin'));
					$subcontract->setPrjWarr($addForm->getValue('prjWarr'));
					$subcontract->setRemark($addForm->getValue('remark'));
					$subcontracts->save($subcontract);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						}
						else
						{
							$this->_helper->flashMessenger->addMessage('对技术交底信息的修改成功。');
							$this->_redirect('/pment/subcontract');
							}
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
		$projectId =$this->getProjectId();
		$editForm = new Pment_Forms_SubcontractSave();
		$editForm->submit->setLabel("保存修改");
		$editForm->submit2->setAttrib('class','hide');
		$errorMsg = null;
		$subcontracts = new Pment_Models_SubcontractMapper();
		$scontrId = $this->_getParam('id',0);
		
		$subcontracts->populateSubcontractDd($editForm,$projectId);
		$editForm = $subcontracts->formValidator($editForm,1);
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$array = $subcontracts->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$subcontract = new Pment_Models_Subcontract();
					$subcontract->setScontrId($scontrId);
					$subcontract->setProjectId($projectId);
					$subcontract->setScontrType($editForm->getValue('scontrType'));
					$subcontract->setContractorId($editForm->getValue('contractorId'));
					$subcontract->setDetail($editForm->getValue('detail'));
					$subcontract->setContent($editForm->getValue('content'));
					$subcontract->setQuality($editForm->getValue('quality'));
					$subcontract->setStartDateExp($editForm->getValue('startDateExp'));
					$subcontract->setEndDateExp($editForm->getValue('endDateExp'));
					$subcontract->setStartDateAct($editForm->getValue('startDateAct'));
					$subcontract->setEndDateAct($editForm->getValue('endDateAct'));
					$subcontract->setBrConContr($editForm->getValue('brConContr'));
					$subcontract->setBrResContr($editForm->getValue('brResContr'));
					$subcontract->setBrConSContr($editForm->getValue('brConSContr'));
					$subcontract->setBrResSContr($editForm->getValue('brResSContr'));
					$subcontract->setContrAmt($editForm->getValue('contrAmt'));
					$subcontract->setGuarantee($editForm->getValue('guarantee'));
					$subcontract->setPrjMargin($editForm->getValue('prjMargin'));
					$subcontract->setPrjWarr($editForm->getValue('prjWarr'));
					$subcontract->setRemark($editForm->getValue('remark'));
					$subcontracts->save($subcontract);
					$this->_helper->flashMessenger->addMessage('对技术交底信息的修改成功。');
					$this->_redirect('/pment/subcontract');
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
				if($scontrId>0)
				{
					$arraySubcontract = $subcontracts->findArraySubcontract($scontrId);
					$editForm->populate($arraySubcontract);
					}
					else
					{
						$this->_redirect('/pment/subcontract');
						}
				}
		$this->view->errorMsg = $errorMsg;
		$this->view->id = $scontrId;
		$this->view->editForm = $editForm;
	}
	
	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$scontrId = $this->_getParam('id',0);
		if($scontrId>0)
		{
			$subcontracts = new Pment_Models_SubcontractMapper();
			try{
				$subcontracts->delete($scontrId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/pment/subcontract');
			}
	}
	
	public function displayAction()
	{
		$scontrId = $this->_getParam('id',0);
		if($scontrId > 0)
		{
			$subcontracts = new Pment_Models_SubcontractMapper();
			$projectId = $this->getProjectId();
			$subcontract = new Pment_Models_Subcontract();
			$subcontracts->find($scontrId,$subcontract);
			$this ->view->subcontract = $subcontract;
			}
			else
			{
				$this->_redirect('/pment/subcontract');
				}
	}
	
	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$scontrId = $this->_getParam('id',0);
		if($scontrId > 0)
		{
			$subcontracts = new Pment_Models_SubcontractMapper();
			$subcontract = new Pment_Models_Subcontract();
			$subcontracts->find($scontrId,$subcontract);
			
			$this->view->subcontract = $subcontract;
			}
			else
			{
				$this->_redirect('/pment/subcontract');
				}
	}
	
	protected function getProjectId()
	{
		$projectNamespace = new Zend_Session_Namespace('projectNamespace');
		return $projectNamespace->projectId;
		}
}