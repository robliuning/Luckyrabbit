<?php
//updated on 31th May By Rob

class Pment_RecordController extends Zend_Controller_Action
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
		$records = new Pment_Models_RecordMapper();
		$errorMsg = null;
		$condition[0] = $projectId;
		$condition[1] = null;
		if($this->getRequest()->isPost())
		{
			$arrayRecords = array();
			$formData = $this->getRequest()->getPost();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition[1] = $formData['condition'];
				$arrayRecords = $records->fetchAllJoin($key,$condition);
				if(count($arrayRecords) == 0)
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
			$arrayRecords = $records->fetchAllJoin(null,$condition);
		}
		if(count($arrayRecords) != 0)
		{
			$pageNumber = $this->_getParam('page');
			$arrayRecords->setCurrentPageNumber($pageNumber);
			$arrayRecords->setItemCountPerPage('20');
			}
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayRecords = $arrayRecords;
		$this->view->errorMsg = $errorMsg;
		}
		
	public function addAction()
	{
		$projectId =$this->_getProjectId();
		$addForm = new Pment_Forms_RecordSave();
		$records = new Pment_Models_RecordMapper();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$addForm = $records->formValidator($addForm,0);
		
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $records->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$record = new Pment_Models_Record();
					$record->setProjectId($projectId);
					$record->setRecDate($addForm->getValue('recDate'));
					$record->setRecUnit($addForm->getValue('recUnit'));
					$record->setRecNumber($addForm->getValue('recNumber'));
					$record->setContent($addForm->getValue('content'));
					$record->setContactId($addForm->getValue('contactId'));
					$record->setRemark($addForm->getValue('remark'));
					$records->save($record);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						}
						else
						{
							$this->_helper->flashMessenger->addMessage('对工程备案信息的修改成功。');
							$this->_redirect('/pment/record');
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
		$editForm = new Pment_Forms_RecordSave();
		$records = new Pment_Models_RecordMapper();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$recId = $this->_getParam('id',0);
		$projectId =$this->_getProjectId();
		$editForm = $records->formValidator($editForm,1);
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$array = $records->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$record = new Pment_Models_Record();
					$record->setRecId($recId);
					$record->setProjectId($projectId);
					$record->setRecDate($editForm->getValue('recDate'));
					$record->setRecUnit($editForm->getValue('recUnit'));
					$record->setRecNumber($editForm->getValue('recNumber'));
					$record->setContent($editForm->getValue('content'));
					$record->setContactId($editForm->getValue('contactId'));
					$record->setRemark($editForm->getValue('remark'));
					$records->save($record); 
					$this->_helper->flashMessenger->addMessage('对工程备案信息的修改成功。');
					$this->_redirect('/pment/record');
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
				if($recId >0)
				{
					$arrayRecord = $records->findarrayRecord($recId);
					$editForm->populate($arrayRecord);
					}
					else
					{
						$this->_redirect('/pment/record');
						}
				}
		$this->view->errorMsg = $errorMsg;
		$this->view->editForm = $editForm;
		$this->view->id = $recId; 
	}

	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$recId = $this->_getParam('id',0);
		if($recId > 0)
		{
			$records = new Pment_Models_RecordMapper();
			$projectId = $this->_getProjectId();
			$record = new Pment_Models_Record();
			$records->find($recId,$record);
			$this ->view->record = $record;
			}
			else
			{
				$this->_redirect('/pment/record');
				}
	}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$recId = $this->_getParam('id',0);
		if($recId > 0)
		{
			$records = new Pment_Models_RecordMapper();
			try{
				$records->delete($recId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/pment/record');
		}
	}
}
?>