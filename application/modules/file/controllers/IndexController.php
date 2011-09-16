<?php
//updated in 22th June by Rob

class File_IndexController extends Zend_Controller_Action
{
	public function init()
	{
		//init...
		}
	
	public function indexAction()
	{
		$specId = $this->_getParam('id',0);
		$files = new File_Models_FileMapper();
		$errorMsg = null;
		$condition[0] = $specId;
		$condition[1] = null;
		$specs = new General_Models_SpecMapper();
		$arraySpecs = $specs->fetchAll();
		$spec = new General_Models_Spec();
		$specs->findSpec($specId,$spec);
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayFiles = array();
			$key = trim($formData['key']);
			if($key!= null)
			{
				$condition[1] = $formData['condition'];
				$arrayFiles = $files->fetchAllJoin($key,$condition);
				if(count($arrayFiles)==0)
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
			$arrayFiles = $files->fetchAllJoin(null,$condition);
		}
		$pageNumber = $this->_getParam('page');
		$arrayFiles->setCurrentPageNumber($pageNumber);
		$arrayFiles->setItemCountPerPage('20');
		$this->view->spec = $spec;
		$this->view->specId = $specId;
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arraySpecs = $arraySpecs;
		$this->view->arrayFiles = $arrayFiles;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "file";
		$this->view->controller = "index";
		$this->view->modelName = "工程文件管理";
	}

	public function addAction()
	{
		$specId = $this->_getParam('id',0);
		$files = new File_Models_FileMapper();
		$errorMsg = null;
		$fileForm = new File_Forms_FileSave();
		$fileForm->setAttrib('enctype', 'multipart/form-data');
		
		$specs = new General_Models_SpecMapper();
		$arraySpecs = $specs->fetchAll();
		$spec = new General_Models_Spec();
		$specs->findSpec($specId,$spec);
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($fileForm->isValid($formData))
			{
				if($fileForm->fileUpload->receive())
				{
					$file = new File_Models_File();
					$files = new File_Models_FileMapper();
					
					$size = $fileForm->fileUpload->getFileSize(); //size
					$fullName = $fileForm->fileUpload->getFileName();//name
					$arr = explode('/',$fullName);
					$fileName = end($arr);
					$arr2 = explode('.',$fileName);
					$fName = $arr2[0]; //displayName
					$type = $arr2[1];
					$userId = $this->getUserId();
					$users = new System_Models_UserMapper();
					$contactId = $users->getContactId($userId); //contactId
					
					$file->setName($fullName);
					$file->setDisplay($fName);
					$file->setSize($size);
					$file->setSpecId($specId);
					$file->setEdition($fileForm->getValue('edition'));
					$file->setContactId($contactId);
					$file->setInFlag($fileForm->getValue('inFlag'));
					$file->setProjFlag(0);
					$file->setProjectId(0);
					$file->setStatus($fileForm->getValue('status'));
					$file->setParent($fileForm->getValue('parent'));
					$file->setRemark($fileForm->getValue('remark'));
					$file->setType($type);
					$files->save($file);
					$this->_helper->flashMessenger->addMessage('文件上传成功。');
					$this->_redirect('/file/index/index/id/'.$specId);
					}
				}
			}
		$this->view->spec = $spec;
		$this->view->specId = $specId;
		$this->view->arraySpecs = $arraySpecs;
		$this->view->errorMsg = $errorMsg;
		$this->view->fileForm = $fileForm;
	}
	
	public function editAction()
	{

	}
	
	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$fileId = $this->_getParam('id',0);
		if($fileId>0)
		{
			$files = new File_Models_FileMapper();
			try{
				$files->delete($fileId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/file/index/index/id/1');
			}
	}
	
	public function displayAction()
	{

	}
	
	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$fileId = $this->_getParam('id',0);
		if($fileId > 0)
		{
			$files = new File_Models_FileMapper();
			$file = new File_Models_File();
			$files->find($fileId,$file);
			
			$this->view->file = $file;
			}
			else
			{
				$this->_redirect('/file/index/index/id/1');
				}
	}
	
	protected function getUserId()
	{
		$userNamespace = new Zend_Session_Namespace('userNamespace');
		return $userNamespace->userId;
		}
}