<?php
//updated on 31th May By Rob

class Pment_SealController extends Zend_Controller_Action
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
		$seals = new Pment_Models_SealMapper();
		$errorMsg = null;
		$condition[0] = $projectId;
		$condition[1] = null;
		if($this->getRequest()->isPost())
		{
			$arraySeals = array();
			$formData = $this->getRequest()->getPost();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition[1] = $formData['condition'];
				$arraySeals = $seals->fetchAllJoin($key,$condition);
				if(count($arraySeals) == 0)
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
			$arraySeals = $seals->fetchAllJoin(null,$condition);
		}
		if(count($arraySeals) != 0)
		{
			$pageNumber = $this->_getParam('page');
			$arraySeals->setCurrentPageNumber($pageNumber);
			$arraySeals->setItemCountPerPage('20');
			}
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arraySeals = $arraySeals;
		$this->view->errorMsg = $errorMsg;
		}
		
	public function addAction()
	{
		$projectId =$this->_getProjectId();
		$addForm = new Pment_Forms_SealSave();
		$seals = new Pment_Models_SealMapper();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$addForm = $seals->formValidator($addForm,0);
		
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $seals->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$seal = new Pment_Models_Seal();
					$seal->setProjectId($projectId);
					$seal->setName($addForm->getValue('name'));
					$seal->setSealFile($addForm->getValue('sealFile'));
					$seal->setSealUser($addForm->getValue('sealUser'));
					$seal->setReason($addForm->getValue('reason'));
					$seal->setSealDate($addForm->getValue('sealDate'));
					$seal->setReturnDate($addForm->getValue('returnDate'));
					$seal->setCopy($addForm->getValue('copy'));
					$seal->setTakeOut($addForm->getValue('takeOut'));
					$seal->setContactId($addForm->getValue('contactId'));
					$seal->setRemark($addForm->getValue('remark'));
					$seals->save($seal);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						}
						else
						{
							$this->_helper->flashMessenger->addMessage('对印章使用信息的修改成功。');
							$this->_redirect('/pment/seal');
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
		$editForm = new Pment_Forms_SealSave();
		$seals = new Pment_Models_SealMapper();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$seaId = $this->_getParam('id',0);
		$projectId =$this->_getProjectId();
		$editForm = $seals->formValidator($editForm,1);
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$array = $seals->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$seal = new Pment_Models_Seal();
					$seal->setSeaId($seaId);
					$seal->setProjectId($projectId);
					$seal->setName($editForm->getValue('name'));
					$seal->setSealFile($editForm->getValue('sealFile'));
					$seal->setSealUser($editForm->getValue('sealUser'));
					$seal->setReason($editForm->getValue('reason'));
					$seal->setSealDate($editForm->getValue('sealDate'));
					$seal->setSealDate($editForm->getValue('returnDate'));
					$seal->setCopy($editForm->getValue('copy'));
					$seal->setTakeOut($editForm->getValue('takeOut'));
					$seal->setContactId($editForm->getValue('contactId'));
					$seal->setRemark($editForm->getValue('remark'));
					$seals->save($seal); 
					$this->_helper->flashMessenger->addMessage('对印章使用信息的修改成功。');
					$this->_redirect('/pment/seal');
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
				if($seaId >0)
				{
					$arraySeal = $seals->findarraySeal($seaId);
					$editForm->populate($arraySeal);
					}
					else
					{
						$this->_redirect('/pment/seal');
						}
				}
		$this->view->errorMsg = $errorMsg;
		$this->view->editForm = $editForm;
		$this->view->id = $seaId; 
	}

	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$seaId = $this->_getParam('id',0);
		if($seaId > 0)
		{
			$seals = new Pment_Models_SealMapper();
			$projectId = $this->_getProjectId();
			$seal = new Pment_Models_Seal();
			$seals->find($seaId,$seal);
			$this ->view->seal = $seal;
			}
			else
			{
				$this->_redirect('/pment/seal');
				}
	}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$seaId = $this->_getParam('id',0);
		if($seaId > 0)
		{
			$seals = new Pment_Models_SealMapper();
			try{
				$seals->delete($seaId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/pment/seal');
		}
	}
}
?>