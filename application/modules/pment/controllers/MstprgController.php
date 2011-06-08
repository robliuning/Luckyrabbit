<?php
//updated on 24th May By Rob

class Pment_MstprgController extends Zend_Controller_Action
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
	
	public function preDispatch(){
		$this -> view ->render("_sidebar.phtml");
	}

	public function indexAction() 
	{
		$projectId =$this->getProjectId();
		$mstprgs = new Pment_Models_MstprgMapper();
		$errorMsg = null;
		$condition[0] = $projectId;
		$condition[1] = null;
		if($this->getRequest()->isPost())
		{
			$arrayMstprgs = array();
			$formData = $this->getRequest()->getPost();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition[1] = $formData['condition'];
				$arrayMstprgs = $mstprgs->fetchAllJoin($key,$condition);
				if(count($arrayMstprgs) == 0)
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
			$arrayMstprgs = $mstprgs->fetchAllJoin(null,$condition);
		}

		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayMstprgs = $arrayMstprgs;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "pment";
		$this->view->controller = "mstprg";
		$this->view->modelName = "工程总进度计划";
		}
		
	public function addAction()
	{
		$projectId =$this->getProjectId();
		$addForm = new Pment_Forms_MstprgSave();
		$mstprgs = new Pment_Models_MstprgMapper();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$addForm = $mstprgs->formValidator($addForm,0);
		$stage = $mstprgs->calStage($projectId);
		$tbStage = $addForm->getElement('stage');
		$tbStage->setValue($stage);
		
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $mstprgs->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$mstprg = new Pment_Models_Mstprg();
					$mstprg->setProjectId($projectId);
					$mstprg->setStage($stage);
					$mstprg->setTask($addForm->getValue('task'));
					$mstprg->setStartDate($addForm->getValue('startDate'));
					$mstprg->setEndDate($addForm->getValue('endDate'));
					$mstprg->setContactId($addForm->getValue('contactId'));
					$mstprg->setRemark($addForm->getValue('remark'));
					$mstprgs->save($mstprg);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						$stage = $stage + 1;
						$tbStage = $addForm->getElement('stage');
						$tbStage->setValue($stage);
						
						}
						else
						{
							$this->_helper->flashMessenger->addMessage('对任务: '.$mstprg->getTask().'的修改成功。');
							$this->_redirect('/pment/mstprg');
							}
					}
					else
					{
						$addForm->populate($formData);
						$tbStage = $addForm->getElement('stage');
						$tbStage->setValue($stage);
						}
				}
				else
				{
					$addForm->populate($formData);
					$tbStage = $addForm->getElement('stage');
					$tbStage->setValue($stage);
					}
		}
		
		$this->view->errorMsg = $errorMsg;
		$this->view->addForm = $addForm;
	}

	public function editAction()
	{
		$errorMsg = null;
		$editForm = new Pment_Forms_MstprgSave();
		$mstprgs = new Pment_Models_MstprgMapper();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$mstprgId = $this->_getParam('id',0);
		$projectId =$this->getProjectId();
		$stage = $mstprgs->findStage($mstprgId);
		$tbStage = $editForm->getElement('stage');
		$tbStage->setValue($stage);
		$editForm = $mstprgs->formValidator($editForm,1);

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$array = $mstprgs->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$mstprg = new Pment_Models_Mstprg();
					$mstprg->setMstprgId($mstprgId);
					$mstprg->setProjectId($projectId);
					$mstprg->setStage($stage);
					$mstprg->setTask($editForm->getValue('task'));
					$mstprg->setStartDate($editForm->getValue('startDate'));
					$mstprg->setEndDate($editForm->getValue('endDate'));
					$mstprg->setContactId($editForm->getValue('contactId'));
					$mstprg->setRemark($editForm->getValue('remark'));
					$mstprgs->save($mstprg); 
					$this->_helper->flashMessenger->addMessage('对任务: '.$mstprg->getTask().'的修改成功。');
					$this->_redirect('/pment/mstprg');
					}
					else
					{
						$editForm->populate($formData);
						$tbStage = $editForm->getElement('stage');
						$tbStage->setValue($stage);
						}
				}
				else
				{
					$editForm->populate($formData);
					$tbStage = $editForm->getElement('stage');
					$tbStage->setValue($stage);
					}
			}
			else
			{
				if($mstprgId > 0)
				{
					$arrayMstprg = $mstprgs->findArrayMstprg($mstprgId);
					$editForm->populate($arrayMstprg);
					}
					else
					{
						$this->_redirect('/pment/mstprg');
						}
				}
		$this->view->errorMsg = $errorMsg;
		$this->view->editForm = $editForm;
		$this->view->id = $mstprgId; 
	}

	public function displayAction()
	{
		$mstprgs = new Pment_Models_MstprgMapper();
		$mstprgId = $this->_getParam('id',0);
		if($mstprgId >0)
		{
			$mstprg = new Pment_Models_Mstprg();
			$mstprgs->find($mstprgId,$mstprg);
			$this ->view->mstprg = $mstprg;
			}
			else
			{
				$this->_redirect('/pment/mstprg');
				}
	}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$mstprgId = $this->_getParam('id',0);
		if($mstprgId > 0)
		{
			$mstprgs = new Pment_Models_MstprgMapper();
			try{
				$mstprgs->delete($mstprgId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/pment/mstprg');
		}
	}

	protected function getProjectId()
	{
		$projectNamespace = new Zend_Session_Namespace('projectNamespace');
		return $projectNamespace->projectId;
		}
}
?>