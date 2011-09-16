<?php
//updated on 24th May By Rob

class Pment_PlogController extends Zend_Controller_Action
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
		$plogs = new Pment_Models_PlogMapper();
		$errorMsg = null;
		$condition[0] = $projectId;
		$condition[1] = null;
		if($this->getRequest()->isPost())
		{
			$arrayPlogs = array();
			$formData = $this->getRequest()->getPost();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition[1] = $formData['condition'];
				$arrayPlogs = $plogs->fetchAllJoin($key,$condition);
				if(count($arrayPlogs) == 0)
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
			$arrayPlogs = $plogs->fetchAllJoin(null,$condition);
		}
		if(count($arrayPlogs) != 0)
		{
			$pageNumber = $this->_getParam('page');
			$arrayPlogs->setCurrentPageNumber($pageNumber);
			$arrayPlogs->setItemCountPerPage('20');
			}
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayPlogs = $arrayPlogs;
		$this->view->errorMsg = $errorMsg;
		}
		
	public function addAction()
	{
		$projectId =$this->_getProjectId();
		$addForm = new Pment_Forms_PlogSave();
		$plogs = new Pment_Models_PlogMapper();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$addForm = $plogs->formValidator($addForm,0);
		
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			$formData['projectId'] = $projectId;
			if($addForm->isValid($formData))
			{
				$array = $plogs->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$userId = $this->_getUserId();
					$users = new System_Models_UserMapper();
					$contactId = $users->getContactId($userId); 
					$plog = new Pment_Models_Plog();
					$plog->setProjectId($projectId);
					$plog->setLogDate($addForm->getValue('logDate'));
					$plog->setWeatherAm($addForm->getValue('weatherAm'));
					$plog->setWeatherPm($addForm->getValue('weatherPm'));
					$plog->setTempHi($addForm->getValue('tempHi'));
					$plog->setTempLo($addForm->getValue('tempLo'));
					$plog->setPart($addForm->getValue('part'));
					$plog->setNumber($addForm->getValue('number'));
					$plog->setOperator($addForm->getValue('operator'));
					$plog->setForeman($addForm->getValue('foreman'));
					$plog->setSafety($addForm->getValue('safety'));
					$plog->setProblem($addForm->getValue('problem'));
					$plog->setResolve($addForm->getValue('resolve'));
					$plog->setRelatedFile($addForm->getValue('relatedFile'));
					$plog->setChangeSig($addForm->getValue('changeSig'));
					$plog->setMaterial($addForm->getValue('material'));
					$plog->setContactId($contactId);
					$plog->setRemark($addForm->getValue('remark'));
					$plogs->save($plog);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						
						}
						else
						{
							$this->_helper->flashMessenger->addMessage('对日志: '.$plog->getLogDate().'的修改成功。');
							$this->_redirect('/pment/plog');
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
		$editForm = new Pment_Forms_PlogSave();
		$plogs = new Pment_Models_PlogMapper();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$plogId = $this->_getParam('id',0);
		$projectId =$this->_getProjectId();
		$editForm = $plogs->formValidator($editForm,1);

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$formData['projectId'] = $projectId;
			if($editForm->isValid($formData))
			{
				$array = $plogs->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$userId = $this->_getUserId();
					$users = new System_Models_UserMapper();
					$contactId = $users->getContactId($userId); 
					$plog = new Pment_Models_Plog();
					$plog->setPlogId($plogId);
					$plog->setProjectId($projectId);
					$plog->setLogDate($editForm->getValue('logDate'));
					$plog->setWeatherAm($editForm->getValue('weatherAm'));
					$plog->setWeatherPm($editForm->getValue('weatherPm'));
					$plog->setTempHi($editForm->getValue('tempHi'));
					$plog->setTempLo($editForm->getValue('tempLo'));
					$plog->setPart($editForm->getValue('part'));
					$plog->setNumber($editForm->getValue('number'));
					$plog->setOperator($editForm->getValue('operator'));
					$plog->setForeman($editForm->getValue('foreman'));
					$plog->setSafety($editForm->getValue('safety'));
					$plog->setProblem($editForm->getValue('problem'));
					$plog->setResolve($editForm->getValue('resolve'));
					$plog->setRelatedFile($editForm->getValue('relatedFile'));
					$plog->setChangeSig($editForm->getValue('changeSig'));
					$plog->setMaterial($editForm->getValue('material'));
					$plog->setContactId($contactId);
					$plog->setRemark($editForm->getValue('remark'));
					$plogs->save($plog); 
					$this->_helper->flashMessenger->addMessage('对日志: '.$plog->getLogDate().'的修改成功。');
					$this->_redirect('/pment/plog/display/id/'.$plog->getPlogId());
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
				if($plogId >0)
				{
					$arrayPlog = $plogs->findarrayPlog($plogId);
					$editForm->populate($arrayPlog);
					}
					else
					{
						$this->_redirect('/pment/plog');
						}
				}
		$this->view->errorMsg = $errorMsg;
		$this->view->editForm = $editForm;
		$this->view->id = $plogId; 
	}

	public function displayAction()
	{
		$plogs = new Pment_Models_PlogMapper();
		$plogId = $this->_getParam('id',0);
		if($plogId >0)
		{
			$plog = new Pment_Models_Plog();
			$plogs->find($plogId,$plog);
			$this ->view->plog = $plog;
			$this->view->messages = $this->_helper->flashMessenger->getMessages();
			}
			else
			{
				$this->_redirect('/pment/plog');
				}
	}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$plogId = $this->_getParam('id',0);
		if($plogId > 0)
		{
			$plogs = new Pment_Models_PlogMapper();
			try{
				$plogs->delete($plogId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/pment/plog');
		}
	}
}
?>