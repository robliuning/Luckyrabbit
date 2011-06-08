<?php
//updated on 31th May By Rob

class Pment_MeasureController extends Zend_Controller_Action
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
		$measures = new Pment_Models_MeasureMapper();
		$errorMsg = null;
		$condition[0] = $projectId;
		$condition[1] = null;
		if($this->getRequest()->isPost())
		{
			$arrayMeasures = array();
			$formData = $this->getRequest()->getPost();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition[1] = $formData['condition'];
				$arrayMeasures = $measures->fetchAllJoin($key,$condition);
				if(count($arrayMeasures) == 0)
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
			$arrayMeasures = $measures->fetchAllJoin(null,$condition);
		}

		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayMeasures = $arrayMeasures;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "pment";
		$this->view->controller = "measure";
		$this->view->modelName = "安全措施信息";
		}
		
	public function addAction()
	{
		$projectId =$this->getProjectId();
		$addForm = new Pment_Forms_MeasureSave();
		$measures = new Pment_Models_MeasureMapper();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$addForm = $measures->formValidator($addForm,0);
		
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $measures->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$measure = new Pment_Models_Measure();
					$measure->setProjectId($projectId);
					$measure->setMeaDate($addForm->getValue('meaDate'));
					$measure->setProblem($addForm->getValue('problem'));
					$measure->setMeasure($addForm->getValue('measure'));
					$measure->setContactId($addForm->getValue('contactId'));
					$measure->setRemark($addForm->getValue('remark'));
					$measures->save($measure);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						}
						else
						{
							$this->_helper->flashMessenger->addMessage('对安全措施信息的修改成功。');
							$this->_redirect('/pment/measure');
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
		$editForm = new Pment_Forms_MeasureSave();
		$measures = new Pment_Models_MeasureMapper();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$meaId = $this->_getParam('id',0);
		$projectId =$this->getProjectId();
		$editForm = $measures->formValidator($editForm,1);
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$array = $measures->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$measure = new Pment_Models_Measure();
					$measure->setMeaId($meaId);
					$measure->setProjectId($projectId);
					$measure->setMeaDate($editForm->getValue('meaDate'));
					$measure->setProblem($editForm->getValue('problem'));
					$measure->setMeasure($editForm->getValue('measure'));
					$measure->setContactId($editForm->getValue('contactId'));
					$measure->setRemark($editForm->getValue('remark'));
					$measures->save($measure); 
					$this->_helper->flashMessenger->addMessage('对安全措施信息的修改成功。');
					$this->_redirect('/pment/measure');
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
				if($meaId >0)
				{
					$arrayMeasure = $measures->findarrayMeasure($meaId);
					$editForm->populate($arrayMeasure);
					}
					else
					{
						$this->_redirect('/pment/measure');
						}
				}
		$this->view->errorMsg = $errorMsg;
		$this->view->editForm = $editForm;
		$this->view->id = $meaId; 
	}

	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$meaId = $this->_getParam('id',0);
		if($meaId > 0)
		{
			$measures = new Pment_Models_MeasureMapper();
			$projectId = $this->getProjectId();
			$measure = new Pment_Models_Measure();
			$measures->find($meaId,$measure);
			$this ->view->measure = $measure;
			}
			else
			{
				$this->_redirect('/pment/measure');
				}
	}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$meaId = $this->_getParam('id',0);
		if($meaId > 0)
		{
			$measures = new Pment_Models_MeasureMapper();
			try{
				$measures->delete($meaId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/pment/measure');
		}
	}

	protected function getProjectId()
	{
		$projectNamespace = new Zend_Session_Namespace('projectNamespace');
		return $projectNamespace->projectId;
		}
}
?>