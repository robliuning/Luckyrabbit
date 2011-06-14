<?php
//updated in 13th June by Rob

class Pment_VerecordController extends Zend_Controller_Action
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
		$this->view->project = $project;	}
	
	public function preDispatch()
	{
		$this -> view ->render("_sidebar.phtml");
	}

	public function indexAction()
	{
		$projectId =$this->getProjectId();
		$verecords = new Vehicle_Models_VerecordMapper();
		$errorMsg = null;
		$condition[0] = $projectId;
		$condition[1] = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayVerecords = array();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition[1] = $formData['condition'];
				$arrayVerecords = $verecords->fetchAllJoin($key,$condition);
				if(count($arrayVerecords) == 0)
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
			$arrayVerecords = $verecords->fetchAllJoin(null,$condition);
		}
		$this->view->arrayVerecords = $arrayVerecords;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "pment";
		$this->view->controller = "verecord";
		$this->view->modelName = "工程用车记录";
		}
	
	public function addAction()
	{
		$projectId =$this->getProjectId();
		$verecords = new Vehicle_Models_VerecordMapper();
		$addForm = new Vehicle_Forms_VerecordSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$verecords->populateVeDd($addForm);
		$addForm = $verecords->formValidator($addForm,0);
		
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			
			if($addForm->isValid($formData))
			{
				$array = $verecords->dataValidator($formData,null,$addForm->getValue('veId'),0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$verecord = new Vehicle_Models_Verecord();
					$verecord->setVeId($addForm->getValue('veId'));
					$verecord->setPrjFlag(1);
					$verecord->setProjectId($projectId);
					$verecord->setStartDate($addForm->getValue('startDate'));
					$verecord->setEndDate($addForm->getValue('endDate'));
					$verecord->setRoute($addForm->getValue('route'));
					$verecord->setMileBf($addForm->getValue('mileBf'));
					$verecord->setMileAf($addForm->getValue('mileAf'));
					$verecord->setPurpose($addForm->getValue('purpose'));
					$verecord->setUser($addForm->getValue('user'));
					$verecord->setMileRef($addForm->getValue('mileRef'));
					$verecord->setContactId($addForm->getValue('contactId'));
					$verecord->setAmount($addForm->getValue('amount'));
					$verecord->setRemark($addForm->getValue('remark'));
					$verecords->save($verecord);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						}
						else
						{
							$this->_redirect('/pment/verecord');
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
		$editForm = new Vehicle_Forms_VerecordSave();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$veId = $editForm->getElement('veId');
		$veId->setAttrib('disabled','disabled');

		$recordId = $this->_getParam('id',0);
		
		$verecords = new Vehicle_Models_VerecordMapper();
		$verecords->populateVeDd($editForm);
		$vId = $verecords->findVeId($recordId);
		
		$editForm = $verecords->formValidator($editForm,1);
		
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$array = $verecords->dataValidator($formData,$recordId,$vId,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$verecord = new Vehicle_Models_verecord();
					$verecord->setrecordId($recordId);
					$verecord->setVeId($vId);
					$verecord->setPrjFlag(1);
					$verecord->setProjectId($projectId);
					$verecord->setStartDate($editForm->getValue('startDate'));
					$verecord->setEndDate($editForm->getValue('endDate'));
					$verecord->setRoute($editForm->getValue('route'));
					$verecord->setMileBf($editForm->getValue('mileBf'));
					$verecord->setMileAf($editForm->getValue('mileAf'));
					$verecord->setPurpose($editForm->getValue('purpose'));
					$verecord->setUser($editForm->getValue('user'));
					$verecord->setMileRef($editForm->getValue('mileRef'));
					$verecord->setContactId($editForm->getValue('contactId'));
					$verecord->setAmount($editForm->getValue('amount'));
					$verecord->setRemark($editForm->getValue('remark'));
					$verecords->save($verecord);
					$this->_redirect('/pment/verecord');
					}
					else
					{
						$editForm->populate($formData);
						$veId->setValue($vId);
						}
				}
				else
				{
					$editForm->populate($formData);
					$veId->setValue($vId);
					}
			}
			else
			{
				if($recordId > 0)
				{
					$arrayVerecord = $verecords->findArrayVerecord($recordId);
					$editForm->populate($arrayVerecord);
					}
					else
					{
						$this->_redirect('/pment/verecord');
						}
				}
		$this->view->errorMsg = $errorMsg;
		$this->view->editForm = $editForm;
		$this->view->id = $recordId;
	}
	
	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$verecords = new Vehicle_Models_VerecordMapper();
		$recordId = $this->_getParam('id',0);
		if($recordId >0)
		{
			$verecord = new Vehicle_Models_Verecord();
			$verecords->findVerecordJoin($recordId,$verecord);
			$this ->view->verecord = $verecord;
			}
			else
			{
				$this->_redirect('/pment/verecord');
				}
		}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$recordId = $this->_getParam('id',0);
		if($recordId > 0)
		{
			$verecords = new Vehicle_Models_VerecordMapper();
			try{
				$verecords->delete($recordId);
				echo "s";
				}
				catch(Exception $e)
				{
					echo "f";
					}
			}
			else
			{
				$this->_redirect('/pment/verecord');
				}
		}

	protected function getProjectId()
	{
		$projectNamespace = new Zend_Session_Namespace('projectNamespace');
		return $projectNamespace->projectId;
		}
}
?>