<?php
//updated on 29th May By Rob

class Pment_WkprgController extends Zend_Controller_Action
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
	
	public function preDispatch(){
		$this -> view ->render("_sidebar.phtml");
	}

	public function indexAction() 
	{
		$projectId =$this->_getProjectId();
		$wkprgs = new Pment_Models_WkprgMapper();
		$errorMsg = null;
		$condition[0] = $projectId;
		$condition[1] = null;
		if($this->getRequest()->isPost())
		{
			$arrayWkprgs = array();
			$formData = $this->getRequest()->getPost();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition[1] = $formData['condition'];
				$arrayWkprgs = $wkprgs->fetchAllJoin($key,$condition);
				if(count($arrayWkprgs) == 0)
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
			$arrayWkprgs = $wkprgs->fetchAllJoin(null,$condition);
		}
		if(count($arrayWkprgs) != 0)
		{
			$pageNumber = $this->_getParam('page');
			$arrayWkprgs->setCurrentPageNumber($pageNumber);
			$arrayWkprgs->setItemCountPerPage('20');
			}
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayWkprgs = $arrayWkprgs;
		$this->view->errorMsg = $errorMsg;
		}
		
	public function addAction()
	{
		$projectId =$this->_getProjectId();
		$addForm = new Pment_Forms_WkprgSave();
		$wkprgs = new Pment_Models_WkprgMapper();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg =null;
		$addForm = $wkprgs->formValidator($addForm,0);
		$wkNum = $wkprgs->calWkNum($projectId);
		$tbWkNum = $addForm->getElement('wkNum');
		$tbWkNum->setValue($wkNum);
		
		$tbWkPlan = $addForm->getElement('wkPlan');
		$wkPlan = null;
		if($wkNum != 1)
		{
				$wkPlan = $wkprgs->findWkPlan($wkNum,$projectId);
				$tbWkPlan->setValue($wkPlan);
				$tbWkPlan->setAttrib('disabled','disabled');
				}
		
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $wkprgs->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$userId = $this->_getUserId();
					$users = new System_Models_UserMapper();
					$contactId = $users->getContactId($userId); 
					$wkprg = new Pment_Models_Wkprg();
					$wkprg->setProjectId($projectId);
					$wkprg->setWkNum($wkNum);
					$wkprg->setStartDate($addForm->getValue('startDate'));
					$wkprg->setEndDate($addForm->getValue('endDate'));
					if($wkNum == 1)
					{
						$wkprg->setWkPlan($addForm->getValue('wkPlan'));
						}
						else
						{
							$wkprg->setWkPlan($wkPlan);
							}
					$wkprg->setWkAct($addForm->getValue('wkAct'));
					$wkprg->setNextPlan($addForm->getValue('nextPlan'));
					$wkprg->setProblem($addForm->getValue('problem'));
					$wkprg->setResolve($addForm->getValue('resolve'));
					$wkprg->setContactId($contactId);
					$wkprg->setRemark($addForm->getValue('remark'));
					$wkprgs->save($wkprg);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						$wkNum = $wkNum + 1;
						$tbWkNum = $addForm->getElement('wkNum');
						$tbWkNum->setValue($wkNum);
						if($wkNum != 1)
						{
							$wkPlan = $wkprgs->findWkPlan($wkNum,$projectId);
							$tbWkPlan->setValue($wkPlan);
							$tbWkPlan->setAttrib('disabled','disabled');
							}
						
						}
						else
						{
							$this->_helper->flashMessenger->addMessage('对计划: 周'.$wkprg->getWkNum().'的修改成功。');
							$this->_redirect('/pment/wkprg');
							}
					}
					else
					{
						$addForm->populate($formData);
						$tbWkNum = $addForm->getElement('wkNum');
						$tbWkNum->setValue($wkNum);
						if($wkNum != 1)
						{
							$wkPlan = $wkprgs->findWkPlan($wkNum,$projectId);
							$tbWkPlan->setValue($wkPlan);
							$tbWkPlan->setAttrib('disabled','disabled');
							}
						}
				}
				else
				{
					$addForm->populate($formData);
					$tbWkNum = $addForm->getElement('wkNum');
					$tbWkNum->setValue($wkNum);
					if($wkNum != 1)
					{
						$wkPlan = $wkprgs->findWkPlan($wkNum,$projectId);
						$tbWkPlan->setValue($wkPlan);
						$tbWkPlan->setAttrib('disabled','disabled');
						}
					}
		}
		
		$this->view->errorMsg = $errorMsg;
		$this->view->addForm = $addForm;
	}

	public function editAction()
	{
		$errorMsg = null;
		$editForm = new Pment_Forms_WkprgSave();
		$wkprgs = new Pment_Models_WkprgMapper();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$wkprgId = $this->_getParam('id',0);
		$projectId =$this->_getProjectId();
		$wkNum = $wkprgs->findWkNum($wkprgId);
		$tbwkNum = $editForm->getElement('wkNum');
		$tbwkNum->setValue($wkNum);
		
		$tbWkPlan = $editForm->getElement('wkPlan');
		$wkPlan = null;
		if($wkNum != 1)
		{
			$tbWkPlan->setAttrib('disabled','disabled');
			$wkPlan = $wkprgs->findWkPlan($wkNum,$projectId);
			$tbWkPlan->setValue($wkPlan);
				}
		
		$editForm = $wkprgs->formValidator($editForm,1);

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$array = $wkprgs->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$userId = $this->_getUserId();
					$users = new System_Models_UserMapper();
					$contactId = $users->getContactId($userId); 
					$wkprg = new Pment_Models_Wkprg();
					$wkprg->setWkprgId($wkprgId);
					$wkprg->setProjectId($projectId);
					$wkprg->setWkNum($wkNum);
					$wkprg->setStartDate($editForm->getValue('startDate'));
					$wkprg->setEndDate($editForm->getValue('endDate'));
					if($wkNum == 1)
					{
						$wkprg->setWkPlan($addForm->getValue('wkPlan'));
						}
						else
						{
							$wkprg->setWkPlan($wkPlan);
							}
					$wkprg->setWkAct($editForm->getValue('wkAct'));
					$wkprg->setNextPlan($editForm->getValue('nextPlan'));
					$wkprg->setProblem($editForm->getValue('problem'));
					$wkprg->setResolve($editForm->getValue('resolve'));
					$wkprg->setContactId($contactId);
					$wkprg->setRemark($editForm->getValue('remark'));
					$wkprgs->save($wkprg); 
					$this->_helper->flashMessenger->addMessage('对计划: 周'.$wkprg->getwkNum().'的修改成功。');
					$this->_redirect('/pment/wkprg');
					}
					else
					{
						$editForm->populate($formData);
						$tbWkNum = $editForm->getElement('wkNum');
						$tbWkNum->setValue($wkNum);
						if($wkNum != 1)
						{
							$wkPlan = $wkprgs->findWkPlan($wkNum,$projectId);
							$tbWkPlan->setValue($wkPlan);
							$tbWkPlan->setAttrib('disabled','disabled');
							}
						}
				}
				else
				{
					$editForm->populate($formData);
					$tbWkNum = $editForm->getElement('wkNum');
					$tbWkNum->setValue($wkNum);
					if($wkNum != 1)
						{
							$wkPlan = $wkprgs->findWkPlan($wkNum,$projectId);
							$tbWkPlan->setValue($wkPlan);
							$tbWkPlan->setAttrib('disabled','disabled');
							}
					}
			}
			else
			{
				if($wkprgId >0)
				{
					$arrayWkprg = $wkprgs->findarrayWkprg($wkprgId);
					$editForm->populate($arrayWkprg);
					}
					else
					{
						$this->_redirect('/pment/wkprg');
						}
				}
		$this->view->errorMsg = $errorMsg;
		$this->view->editForm = $editForm;
		$this->view->id = $wkprgId; 
	}

	public function displayAction()
	{
		$wkprgs = new Pment_Models_WkprgMapper();
		$images = new Pment_Models_ImageMapper();
		$wkprgId = $this->_getParam('id',0);
		$projectId = $this->_getProjectId();
		$prgType = 'wk';
		$wkprg = new Pment_Models_Wkprg();
		$wkprgs->find($wkprgId,$wkprg);
		if($wkprgId >0)
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
						$uploadImage->setPrgId($wkprgId);
						$uploadImage->setImageSn($nameFile);
						$uploadImage->setDescription($imageForm->getValue('description'));
						$images->save($uploadImage);
						}
					}
				}
			$condition[0] = $projectId;
			$condition[1] = $prgType;
			$arrayImages = $images->fetchAllJoin($wkprgId,$condition);

			$this ->view->wkprg = $wkprg;
			$this->view->imageForm = $imageForm;
			$this->view->errorMsg = $errorMsg;
			$this->view->arrayImages = $arrayImages;
			}
			else
			{
				$this->_redirect('/pment/wkprg');
				}
	}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$wkprgId = $this->_getParam('id',0);
		if($wkprgId > 0)
		{
			$wkprgs = new Pment_Models_WkprgMapper();
			try{
				$wkprgs->delete($wkprgId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/pment/wkprg');
		}
	}
}
?>