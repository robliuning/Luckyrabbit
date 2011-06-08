<?php
//updated on 31th May By Rob

class Pment_TrainingController extends Zend_Controller_Action
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
		$trainings = new Pment_Models_TrainingMapper();
		$errorMsg = null;
		$condition[0] = $projectId;
		$condition[1] = null;
		if($this->getRequest()->isPost())
		{
			$arrayTrainings = array();
			$formData = $this->getRequest()->getPost();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition[1] = $formData['condition'];
				$arrayTrainings = $trainings->fetchAllJoin($key,$condition);
				if(count($arrayTrainings) == 0)
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
			$arrayTrainings = $trainings->fetchAllJoin(null,$condition);
		}

		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayTrainings = $arrayTrainings;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "pment";
		$this->view->controller = "training";
		$this->view->modelName = "安全培训信息";
		}
		
	public function addAction()
	{
		$projectId =$this->getProjectId();
		$addForm = new Pment_Forms_TrainingSave();
		$trainings = new Pment_Models_TrainingMapper();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$addForm = $trainings->formValidator($addForm,0);
		
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $trainings->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$training = new Pment_Models_Training();
					$training->setProjectId($projectId);
					$training->setTraDate($addForm->getValue('traDate'));
					$training->setContent($addForm->getValue('content'));
					$training->setName($addForm->getValue('name'));
					$training->setContactId($addForm->getValue('contactId'));
					$training->setRemark($addForm->getValue('remark'));
					$trainings->save($training);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						}
						else
						{
							$this->_helper->flashMessenger->addMessage('对安全培训信息的修改成功。');
							$this->_redirect('/pment/training');
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
		$editForm = new Pment_Forms_TrainingSave();
		$trainings = new Pment_Models_TrainingMapper();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$traId = $this->_getParam('id',0);
		$projectId =$this->getProjectId();
		$editForm = $trainings->formValidator($editForm,1);
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$array = $trainings->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$training = new Pment_Models_Training();
					$training->setTraId($traId);
					$training->setProjectId($projectId);
					$training->setTraDate($editForm->getValue('traDate'));
					$training->setContent($editForm->getValue('content'));
					$training->setName($editForm->getValue('name'));
					$training->setContactId($editForm->getValue('contactId'));
					$training->setRemark($editForm->getValue('remark'));
					$trainings->save($training); 
					$this->_helper->flashMessenger->addMessage('对安全培训信息的修改成功。');
					$this->_redirect('/pment/training');
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
				if($traId >0)
				{
					$arrayTraining = $trainings->findarrayTraining($traId);
					$editForm->populate($arrayTraining);
					}
					else
					{
						$this->_redirect('/pment/training');
						}
				}
		$this->view->errorMsg = $errorMsg;
		$this->view->editForm = $editForm;
		$this->view->id = $traId; 
	}

	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$traId = $this->_getParam('id',0);
		if($traId > 0)
		{
			$trainings = new Pment_Models_TrainingMapper();
			$projectId = $this->getProjectId();
			$training = new Pment_Models_Training();
			$trainings->find($traId,$training);
			$this ->view->training = $training;
			}
			else
			{
				$this->_redirect('/pment/training');
				}
	}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$traId = $this->_getParam('id',0);
		if($traId > 0)
		{
			$trainings = new Pment_Models_TrainingMapper();
			try{
				$trainings->delete($traId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/pment/training');
		}
	}

	protected function getProjectId()
	{
		$projectNamespace = new Zend_Session_Namespace('projectNamespace');
		return $projectNamespace->projectId;
		}
}
?>