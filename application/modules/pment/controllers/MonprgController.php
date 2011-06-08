<?php
//updated on 26th May By Rob

class Pment_MonprgController extends Zend_Controller_Action
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
		$monprgs = new Pment_Models_MonprgMapper();
		$errorMsg = null;
		$condition[0] = $projectId;
		$condition[1] = null;
		if($this->getRequest()->isPost())
		{
			$arrayMonprgs = array();
			$formData = $this->getRequest()->getPost();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition[1] = $formData['condition'];
				$arrayYm = $monprgs->fetchAllOrganize($key,$condition);
				if(count($arrayYm) == 0)
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
			$arrayYm = $monprgs->fetchAllOrganize(null,$condition);
		}

		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayYm = $arrayYm;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "pment";
		$this->view->controller = "monprg";
		$this->view->modelName = "工程月进度计划";
		}
		
	public function addAction()
	{
		$projectId =$this->getProjectId();
		$addForm = new Pment_Forms_MonprgSave();
		$monprgs = new Pment_Models_MonprgMapper();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$addForm = $monprgs->formValidator($addForm,0);
		$monprgs->populateMonprgDd($addForm);
		
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $monprgs->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$monprg = new Pment_Models_Monprg();
					$monprg->setProjectId($projectId);
					$monprg->setYearNum($addForm->getValue('yearNum'));
					$monprg->setMonNum($addForm->getValue('monNum'));
					$monprg->setSubTask($addForm->getValue('subTask'));
					$monprg->setStartDate($addForm->getValue('startDate'));
					$monprg->setEndDate($addForm->getValue('endDate'));
					$monprg->setContactId($addForm->getValue('contactId'));
					$monprg->setRemark($addForm->getValue('remark'));
					$monprgs->save($monprg);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						$monprgs->populateMonprgDd($addForm);
						
						}
						else
						{
							$this->_helper->flashMessenger->addMessage('对任务: '.$monprg->getSubTask().'的修改成功。');
							$this->_redirect('/pment/monprg');
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
		$editForm = new Pment_Forms_MonprgSave();
		$monprgs = new Pment_Models_MonprgMapper();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$monprgId = $this->_getParam('id',0);
		$projectId =$this->getProjectId();
		$editForm = $monprgs->formValidator($editForm,1);
		$monprgs->populateMonprgDd($editForm);
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$array = $monprgs->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$monprg = new Pment_Models_Monprg();
					$monprg->setMonprgId($monprgId);
					$monprg->setProjectId($projectId);
					$monprg->setYearNum($editForm->getValue('yearNum'));
					$monprg->setMonNum($editForm->getValue('monNum'));
					$monprg->setSubTask($editForm->getValue('subTask'));
					$monprg->setStartDate($editForm->getValue('startDate'));
					$monprg->setEndDate($editForm->getValue('endDate'));
					$monprg->setContactId($editForm->getValue('contactId'));
					$monprg->setRemark($editForm->getValue('remark'));
					$monprgs->save($monprg); 
					$this->_helper->flashMessenger->addMessage('对任务: '.$monprg->getSubTask().'的修改成功。');
					$this->_redirect('/pment/monprg');
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
				if($monprgId >0)
				{
					$arrayMonprg = $monprgs->findArrayMonprg($monprgId);
					$editForm->populate($arrayMonprg);
					}
					else
					{
						$this->_redirect('/pment/monprg');
						}
				}
		$this->view->errorMsg = $errorMsg;
		$this->view->editForm = $editForm;
		$this->view->id = $monprgId; 
	}

	public function displayAction()
	{
		$monprgs = new Pment_Models_MonprgMapper();
		$images = new Pment_Models_ImageMapper();
		$monprgId = $this->_getParam('id',0);
		$projectId = $this->getProjectId();
		$prgType = 'mon';
		$monprg = new Pment_Models_Monprg();
		$monprgs->find($monprgId,$monprg);
		if($monprgId >0)
		{
		//add upload form
			$errorMsg = null;
			$imageForm = new Pment_Forms_ImageSave();
			$imageForm->setAttrib('enctype', 'multipart/form-data');
			
			if($this->getRequest()->isPost())
			{
				if ($imageForm->isValid($this->getRequest()->getPost()))
				{
					if ($imageForm->imageUpload->receive())
					{
						$locationFile = $imageForm->imageUpload->getFileName();
						$nameFile = time().rand(100,199).'.jpg';
						$fullPathNameFile = 'images/upload/'.$nameFile;
						// Renommage du fichier
						$filterRename = new Zend_Filter_File_Rename(array('target' => $fullPathNameFile, 'overwrite' => true));
						$filterRename->filter($locationFile);
						//make thumbnail
						$this->view->image('uploadImage',$nameFile,null,'280x280');
						//save to db
						$uploadImage = new Pment_Models_Image();
						$uploadImage->setProjectId($projectId);
						$uploadImage->setPrgType($prgType);
						$uploadImage->setPrgId($monprgId);
						$uploadImage->setImageSn($nameFile);
						$uploadImage->setDescription($imageForm->getValue('description'));
						$images->save($uploadImage);
						}
					}
				}
			$condition[0] = $projectId;
			$condition[1] = $prgType;
			$arrayImages = $images->fetchAllJoin($monprgId,$condition);

			$this ->view->monprg = $monprg;
			$this->view->imageForm = $imageForm;
			$this->view->errorMsg = $errorMsg;
			$this->view->arrayImages = $arrayImages;
			}
			else
			{
				$this->_redirect('/pment/monprg');
				}
	}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$monprgId = $this->_getParam('id',0);
		if($monprgId > 0)
		{
			$monprgs = new Pment_Models_MonprgMapper();
			try{
				$monprgs->delete($monprgId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/pment/monprg');
		}
	}

	protected function getProjectId()
	{
		$projectNamespace = new Zend_Session_Namespace('projectNamespace');
		return $projectNamespace->projectId;
		}
}
?>