<?php
//updated on 24th May By Rob

class Project_IndexController extends Zend_Controller_Action
{
	public function init()
	{
		/* Initialize action controller here */
	}
	
	public function preDispatch(){
		$this -> view ->render("_sidebar.phtml");
	}

	public function indexAction() 
	{
		$projects = new Project_Models_ProjectMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$arrayProjects = array();
			$formData = $this->getRequest()->getPost();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition = $formData['condition'];
				$arrayProjects = $projects->fetchAllJoin($key,$condition);
				if(count($arrayProjects) == 0)
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
			$arrayProjects = $projects->fetchAllJoin();
		}

		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayProjects = $arrayProjects;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "project";
		$this->view->controller = "index";
		$this->view->modelName = "工程概况";
		}
		
	public function addAction()
	{
		$addForm = new Project_Forms_ProjectSave();
		$projects = new Project_Models_ProjectMapper();
		$structypes = new General_Models_StructypeMapper();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$structypes->populateStructypeDd($addForm);
		$addForm = $projects->formValidator($addForm,0);
			
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $projects->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$project = new Project_Models_Project();
					$project->setName($addForm->getValue('name'));
					$project->setAddress($addForm->getValue('address'));
					$project->setStatus($addForm->getValue('status'));
					$project->setStructype($addForm->getValue('structype'));
					$project->setLevel($addForm->getValue('level'));
					$project->setPeriod($addForm->getValue('period'));
					$project->setStartDate($addForm->getValue('startDate'));
					$project->setContactId($addForm->getValue('contactId'));
					$project->setConstructor($addForm->getValue('constructor'));
					$project->setContractor($addForm->getValue('contractor'));
					$project->setSupervisor($addForm->getValue('supervisor'));
					$project->setDesigner($addForm->getValue('designer'));
					$project->setLicense($addForm->getValue('license'));
					$project->setAmount($addForm->getValue('amount'));
					$project->setConstrArea($addForm->getValue('constrArea'));
					$project->setRemark($addForm->getValue('remark'));
					$projects->save($project);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						}
						else
						{
							$this->_helper->flashMessenger->addMessage('对工程: '.$project->getName().'的修改成功。');
							$this->_redirect('/project');
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
		$editForm = new Project_Forms_ProjectSave();
		$projects = new Project_Models_ProjectMapper();
		$structypes = new General_Models_StructypeMapper();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$structypes->populateStructypeDd($editForm);
		$projectId = $this->_getParam('id',0);
		$editForm = $projects->formValidator($editForm,1);

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$array = $projects->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$project = new Project_Models_Project();
					$project->setProjectId($projectId);
					$project->setName($editForm->getValue('name'));
					$project->setaddress($editForm->getValue('address'));
					$project->setStatus($editForm->getValue('status'));
					$project->setStructype($editForm->getValue('structype'));
					$project->setLevel($editForm->getValue('level'));
					$project->setPeriod($editForm->getValue('period'));
					$project->setStartDate($editForm->getValue('startDate'));
					$project->setContactId($editForm->getValue('contactId'));
					$project->setConstructor($editForm->getValue('constructor'));
					$project->setContractor($editForm->getValue('contractor'));
					$project->setSupervisor($editForm->getValue('supervisor'));
					$project->setDesigner($editForm->getValue('designer'));
					$project->setLicense($editForm->getValue('license'));
					$project->setAmount($editForm->getValue('amount'));
					$project->setConstrArea($editForm->getValue('constrArea'));
 					$project->setRemark($editForm->getValue('remark'));
					$projects->save($project); 
					$this->_helper->flashMessenger->addMessage('对工程: '.$project->getName().'的修改成功。');
					$this->_redirect('/project');
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
				if($projectId >0)
				{
					$arrayProject = $projects->findArrayProject($projectId);
					$editForm->populate($arrayProject);
					}
					else
					{
						$this->_redirect('/project');
						}
				}
		$this->view->editForm = $editForm;
		$this->view->id = $projectId; 	
	}

	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$projects = new Project_Models_ProjectMapper();
		$projectId = $this->_getParam('id',0);
		if($projectId >0)
		{
			$project = new Project_Models_Project();
			$projects->find($projectId,$project);
			$this ->view->project = $project;
			}
			else
			{
				$this->_redirect('/project');
				}
	}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$projectId = $this->_getParam('id',0);
		if($projectId > 0)
		{
			$projects = new Project_Models_ProjectMapper();
			try{
				$projects->delete($projectId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/project');
		}
	}
}
?>