<?php
//updated in 9th june by Rob

class Pment_CppController extends  Zend_Controller_Action
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

	public function preDispatch()
	{
		$this->view->render("_sidebar.phtml");
	}
	public function indexAction()
	{
		$projectId =$this->_getProjectId();
		$errorMsg = null;
		$cpps = new Pment_Models_CppMapper();
		$condition[0] = $projectId;
		$condition[1] = null;
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayCpps = array();
			$key = trim($formData['key']);
			if($key != null)
			{
				$condition[1] = $formData['condition'];
				$arrayCpps = $cpps->fetchAllJoin($key,$condition);
				if(count($arrayCpps) == 0)
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
			$arrayCpps = $cpps->fetchAllJoin(null,$condition);
			}
		if(count($arrayCpps) != 0)
		{
			$pageNumber = $this->_getParam('page');
			$arrayCpps->setCurrentPageNumber($pageNumber);
			$arrayCpps->setItemCountPerPage('20');
			}
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayCpps = $arrayCpps;
		$this->view->errorMsg = $errorMsg;
		$this->view->projectId = $projectId;
	}

	public function addAction()
	{
		$projectId =$this->_getProjectId();
		$addForm=new Pment_Forms_CppSave();
		$addForm->submit->setLabel("保存继续新建");
		$addForm->submit2->setLabel("保存返回上页");
		$errorMsg = null;
		$cpps = new Pment_Models_CppMapper();
		$cpps->populateCppDd($addForm);
		$addForm = $cpps->formValidator($addForm,0);
		
	 	if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $cpps->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$cpp = new Pment_Models_Cpp();
					$cpp->setPostId($addForm->getValue('postId'));
					$cpp->setContactId($addForm->getValue('contactId'));
					$cpp->setProjectId($projectId);
					$cpp->setCertId($addForm->getValue('certId'));
					$cpp->setQualif($addForm->getValue('qualif'));
					$cpp->setStartDate($addForm->getValue('startDate'));
					$cpp->setResponsi($addForm->getValue('responsi'));
					$cpp->setRemark($addForm->getValue('remark'));
					$cpps->save($cpp); 
					$errorMsg = General_Models_Text::$text_save_success;	
					if($btClicked=="保存继续新建")
					{
						$addForm->reset();
						}
						else
						{
							$this->_helper->flashMessenger->addMessage('对工程岗位信息的修改成功。');
							$this->_redirect('/pment/cpp');
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
		$editForm = new Pment_Forms_CppSave();
		$cpps = new Pment_Models_CppMapper();
		$editForm->submit->setLabel("保存修改");
		$editForm->submit2->setAttrib('class','hide');
		$projectId =$this->_getProjectId();
		$cppId = $this->_getParam('id',0);
		$cpps->populateCppDd($editForm);
		$editForm = $cpps->formValidator($editForm,1);

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$array = $cpps->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$cpp = new Pment_Models_Cpp();
					$cpp->setCppId($cppId);
					$cpp->setPostId($editForm->getValue('postId'));
					$cpp->setContactId($editForm->getValue('contactId'));
					$cpp->setProjectId($projectId);
					$cpp->setCertId($editForm->getValue('certId'));
					$cpp->setQualif($editForm->getValue('qualif'));
					$cpp->setStartDate($editForm->getValue('startDate'));
					$cpp->setResponsi($editForm->getValue('responsi'));
					$cpp->setRemark($editForm->getValue('remark'));
					$cpps->save($cpp);
					$this->_redirect('/pment/cpp');
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
			if($cppId > 0)
			{
				$arrayCpp = $cpps->findArrayCpp($cppId);
				$editForm->populate($arrayCpp);
				}
			else
			{
				$this->_redirect('/pment/cpp');
				}
			}
	$this->view->errorMsg = $errorMsg;
	$this->view->editForm = $editForm;
	$this->view->id = $cppId;
	}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$cppId = $this->_getParam('id',0);
		if($cppId > 0)
		{
			$cpps = new Pment_Models_CppMapper();
			try{
				$cpps->delete($cppId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
		$this->_redirect('/pment/cpp');
		}
	}
	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$cppId = $this->_getParam('id',0);
		if($cppId >0)
		{
			$projectId = $this->_getProjectId();
			$cpps = new Pment_Models_CppMapper();
			$cpp = new Pment_Models_Cpp();
			$cpps->find($cppId,$cpp);
			$this->view->cpp = $cpp;
			}
			else
			{
				$this->_redirect('/pment/cpp');
				}
		}
}
