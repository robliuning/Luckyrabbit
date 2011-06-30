<?php
//updated on 31th May By Rob

class Pment_TechController extends Zend_Controller_Action
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
		$techs = new Pment_Models_TechMapper();
		$errorMsg = null;
		$condition[0] = $projectId;
		$condition[1] = null;
		if($this->getRequest()->isPost())
		{
			$arrayTechs = array();
			$formData = $this->getRequest()->getPost();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition[1] = $formData['condition'];
				$arrayTechs = $techs->fetchAllJoin($key,$condition);
				if(count($arrayTechs) == 0)
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
			$arrayTechs = $techs->fetchAllJoin(null,$condition);
		}

		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayTechs = $arrayTechs;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "pment";
		$this->view->controller = "tech";
		$this->view->modelName = "技术交底信息";
		}
		
	public function addAction()
	{
		$projectId =$this->getProjectId();
		$addForm = new Pment_Forms_TechSave();
		$techs = new Pment_Models_TechMapper();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$addForm = $techs->formValidator($addForm,0);
		
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $techs->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$userId = $this->getUserId();
					$users = new System_Models_UserMapper();
					$contactId = $users->getContactId($userId); 
					$tech = new Pment_Models_Tech();
					$tech->setProjectId($projectId);
					$tech->setTechDate($addForm->getValue('techDate'));
					$tech->setContent($addForm->getValue('content'));
					$tech->setName($addForm->getValue('name'));
					$tech->setContactId($contactId);
					$tech->setRemark($addForm->getValue('remark'));
					$techs->save($tech);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						}
						else
						{
							$this->_helper->flashMessenger->addMessage('对技术交底信息的修改成功。');
							$this->_redirect('/pment/tech');
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
		$errorMsg = null;
		$editForm = new Pment_Forms_TechSave();
		$techs = new Pment_Models_TechMapper();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$techId = $this->_getParam('id',0);
		$projectId =$this->getProjectId();
		
		$editForm = $techs->formValidator($editForm,1);

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$array = $techs->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$userId = $this->getUserId();
					$users = new System_Models_UserMapper();
					$contactId = $users->getContactId($userId); 
					$tech = new Pment_Models_Tech();
					$tech->setTechId($techId);
					$tech->setProjectId($projectId);
					$tech->setTechDate($editForm->getValue('techDate'));
					$tech->setContent($editForm->getValue('content'));
					$tech->setName($editForm->getValue('name'));
					$tech->setContactId($contactId);
					$tech->setRemark($editForm->getValue('remark'));
					$techs->save($tech); 
					$this->_helper->flashMessenger->addMessage('对技术交底信息的修改成功。');
					$this->_redirect('/pment/tech');
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
				if($techId >0)
				{
					$arrayTech = $techs->findarrayTech($techId);
					$editForm->populate($arrayTech);
					}
					else
					{
						$this->_redirect('/pment/tech');
						}
				}
		$this->view->errorMsg = $errorMsg;
		$this->view->editForm = $editForm;
		$this->view->id = $techId; 
	}

	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$techId = $this->_getParam('id',0);
		if($techId > 0)
		{
			$techs = new Pment_Models_TechMapper();
			$projectId = $this->getProjectId();
			$tech = new Pment_Models_Tech();
			$techs->find($techId,$tech);
			$this ->view->tech = $tech;
			}
			else
			{
				$this->_redirect('/pment/tech');
				}
	}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$techId = $this->_getParam('id',0);
		if($techId > 0)
		{
			$techs = new Pment_Models_TechMapper();
			try{
				$techs->delete($techId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/pment/tech');
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