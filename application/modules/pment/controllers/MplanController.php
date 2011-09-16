<?php
//updated in 1st July by Rob

class Pment_MplanController extends Zend_Controller_Action
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
				if($this->_request->getActionName() != "validation")
				{
					$this->_redirect('/');
					}
				}
		$projects = new Project_Models_ProjectMapper();
		$project = new Project_Models_Project();
		$projects->find($projectId,$project);
		$this->view->project = $project;
		
		$this->view->module = $this->_request->getModuleName();
		$this->view->controller = $this->_request->getControllerName();
	}
	
	public function preDispatch()
	{
		$this->view->render("_sidebar.phtml");
	}

	public function indexAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		//$projectId = $this->getProjectId();
		$groupId = $this->getGroupId();
		if($groupId == 3 || $groupId == 1)
		{
			$this->_redirect('/pment/mplan/pindex');
			}
			elseif($groupId == 4)
			{
				$this->_redirect('/pment/mplan/bindex');
				}
				elseif($groupId == 5)
				{
					$this->_redirect('/pment/mplan/mindex');
					}
	}
	
	public function pindexAction()
	{
		$groupId = $this->getGroupId();
		if($groupId != 3) //for test purpose
		{
			$this->_redirect('/pment/cpp');
			}
			else
			{
				$projectId =$this->getProjectId();
				$mplans = new Pment_Models_MplanMapper();
				$errorMsg = null;
				$condition[0] = $projectId;
				$condition[1] ="status";
				$status1 = 'a';
				$status2 = 'b';
				$status3 = 'i';
				
			/*	if($this->getRequest()->isPost())
				{
					$formData = $this->getRequest()->getPost();
					$arrayMplans = array();
					$key = trim($formData['key']);
					if($key!= null)
					{
						$condition[1] = $formData['condition'];
						$arrayMplans = $mplans->fetchAllJoin($key,$condition);
						if(count($arrayMplans) == 0)
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
					{*/
				$arrayMplans1 = $mplans->fetchAllJoin($status1,$condition);
				$arrayMplans2 = $mplans->fetchAllJoin($status2,$condition);
				$arrayMplans3 = $mplans->fetchAllJoin($status3,$condition);
				if(count($arrayMplans1) != 0)
				{
					$pageNumber = $this->_getParam('page');
					$arrayMplans1->setCurrentPageNumber($pageNumber);
					$arrayMplans1->setItemCountPerPage('20');
					}
				if(count($arrayMplans2) != 0)
				{
					$pageNumber = $this->_getParam('page');
					$arrayMplans2->setCurrentPageNumber($pageNumber);
					$arrayMplans2->setItemCountPerPage('20');
					}
				if(count($arrayMplans3) != 0)
				{
					$pageNumber = $this->_getParam('page');
					$arrayMplans3->setCurrentPageNumber($pageNumber);
					$arrayMplans3->setItemCountPerPage('20');
					}
				$this->view->messages = $this->_helper->flashMessenger->getMessages();
				$this->view->arrayMplans1 = $arrayMplans1;
				$this->view->arrayMplans2 = $arrayMplans2;
				$this->view->arrayMplans3 = $arrayMplans3;
				$this->view->errorMsg = $errorMsg;
				$this->view->modelName = "项目部材料计划信息";
				}
	}

	public function bindexAction()
	{
		$groupId = $this->getGroupId();
		if($groupId != 4) //for test purpose
		{
			$this->_redirect('/pment/cpp');
			}
			else
			{
				$projectId =$this->getProjectId();
				$mplans = new Pment_Models_MplanMapper();
				$errorMsg = null;
				$condition[0] = $projectId;
				$condition[1] ="status";
				$status1 = 'c';
				$status2 = 'd';
				$status3 = 'e';
				$status4 = 'f';
				$status5 = 'i';
				
			/*	if($this->getRequest()->isPost())
				{
					$formData = $this->getRequest()->getPost();
					$arrayMplans = array();
					$key = trim($formData['key']);
					if($key!= null)
					{
						$condition[1] = $formData['condition'];
						$arrayMplans = $mplans->fetchAllJoin($key,$condition);
						if(count($arrayMplans) == 0)
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
					{*/
				$arrayMplans1 = $mplans->fetchAllJoin($status1,$condition);
				$arrayMplans2 = $mplans->fetchAllJoin($status2,$condition);
				$arrayMplans3 = $mplans->fetchAllJoin($status3,$condition);
				$arrayMplans4 = $mplans->fetchAllJoin($status4,$condition);
				$arrayMplans5 = $mplans->fetchAllJoin($status5,$condition);

				if(count($arrayMplans1) != 0)
				{
					$pageNumber = $this->_getParam('page');
					$arrayMplans1->setCurrentPageNumber($pageNumber);
					$arrayMplans1->setItemCountPerPage('20');
					}
				if(count($arrayMplans2) != 0)
				{
					$pageNumber = $this->_getParam('page');
					$arrayMplans2->setCurrentPageNumber($pageNumber);
					$arrayMplans2->setItemCountPerPage('20');
					}
				if(count($arrayMplans3) != 0)
				{
					$pageNumber = $this->_getParam('page');
					$arrayMplans3->setCurrentPageNumber($pageNumber);
					$arrayMplans3->setItemCountPerPage('20');
					}
				if(count($arrayMplans4) != 0)
				{
					$pageNumber = $this->_getParam('page');
					$arrayMplans4->setCurrentPageNumber($pageNumber);
					$arrayMplans4->setItemCountPerPage('20');
					}
				if(count($arrayMplans5) != 0)
				{
					$pageNumber = $this->_getParam('page');
					$arrayMplans5->setCurrentPageNumber($pageNumber);
					$arrayMplans5->setItemCountPerPage('20');
					}
				$this->view->messages = $this->_helper->flashMessenger->getMessages();
				$this->view->arrayMplans1 = $arrayMplans1;
				$this->view->arrayMplans2 = $arrayMplans2;
				$this->view->arrayMplans3 = $arrayMplans3;
				$this->view->arrayMplans4 = $arrayMplans4;
				$this->view->arrayMplans5 = $arrayMplans5;

				$this->view->errorMsg = $errorMsg;
				$this->view->modelName = "预算部材料计划信息";
				}
	}

	public function mindexAction()
	{
		$groupId = $this->getGroupId();
		if($groupId != 5) //for test purpose
		{
			$this->_redirect('/pment/cpp');
			}
			else
			{
				$projectId =$this->getProjectId();
				$mplans = new Pment_Models_MplanMapper();
				$errorMsg = null;
				$condition[0] = $projectId;
				$condition[1] ="status";
				$status1 = 'g';
				$status2 = 'h';
				$status3 = 'e';
				$status4 = 'i';
				
			/*	if($this->getRequest()->isPost())
				{
					$formData = $this->getRequest()->getPost();
					$arrayMplans = array();
					$key = trim($formData['key']);
					if($key!= null)
					{
						$condition[1] = $formData['condition'];
						$arrayMplans = $mplans->fetchAllJoin($key,$condition);
						if(count($arrayMplans) == 0)
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
					{*/
				$arrayMplans1 = $mplans->fetchAllJoin($status1,$condition);
				$arrayMplans2 = $mplans->fetchAllJoin($status2,$condition);
				$arrayMplans3 = $mplans->fetchAllJoin($status3,$condition);
				$arrayMplans4 = $mplans->fetchAllJoin($status4,$condition);
				if(count($arrayMplans1) != 0)
				{
					$pageNumber = $this->_getParam('page');
					$arrayMplans1->setCurrentPageNumber($pageNumber);
					$arrayMplans1->setItemCountPerPage('20');
					}
				if(count($arrayMplans2) != 0)
				{
					$pageNumber = $this->_getParam('page');
					$arrayMplans2->setCurrentPageNumber($pageNumber);
					$arrayMplans2->setItemCountPerPage('20');
					}
				if(count($arrayMplans3) != 0)
				{
					$pageNumber = $this->_getParam('page');
					$arrayMplans3->setCurrentPageNumber($pageNumber);
					$arrayMplans3->setItemCountPerPage('20');
					}
				if(count($arrayMplans4) != 0)
				{
					$pageNumber = $this->_getParam('page');
					$arrayMplans4->setCurrentPageNumber($pageNumber);
					$arrayMplans4->setItemCountPerPage('20');
					}
				$this->view->messages = $this->_helper->flashMessenger->getMessages();
				$this->view->arrayMplans1 = $arrayMplans1;
				$this->view->arrayMplans2 = $arrayMplans2;
				$this->view->arrayMplans3 = $arrayMplans3;
				$this->view->arrayMplans4 = $arrayMplans4;
				$this->view->errorMsg = $errorMsg;
				$this->view->modelName = "材料部材料计划信息";
				}	}
	
	public function addAction()
	{
		$groupId = $this->getGroupId();
		if($groupId != 3) //for test purpose
		{
			$this->_redirect('/pment/cpp');
			}
		$projectId =$this->getProjectId();
		$addForm = new Pment_Forms_MplanSave();
		$addForm->submit->setLabel('保存计划并添加材料');
		$addForm->submit2->setAttrib('class','hide');
		$errorMsg = null;
		$mplans = new Pment_Models_MplanMapper();
		$mplans->populateDd($addForm);
		$addForm = $mplans->formValidator($addForm,0);
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $mplans->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$userId = $this->getUserId();
					$users = new System_Models_UserMapper();
					$contactId = $users->getContactId($userId); 
					$mplan = new Pment_Models_Mplan();
					$mplan->setProjectId($projectId);
					$mplan->setPlanName($addForm->getValue('planName'));
					$mplan->setTypeId($addForm->getValue('typeId'));
					$mplan->setYearNum($addForm->getValue('yearNum'));
					$mplan->setMonNum($addForm->getValue('monNum'));
					$mplan->setPDate($addForm->getValue('pDate'));
					$mplan->setContactId($contactId);
					$mplan->setRemark($addForm->getValue('remark'));
					$mplan->setStatus(0);
					$id = $mplans->save($mplan);
					$this->_redirect('/pment/material/index/id/'.$id);
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
		$groupId = $this->getGroupId();
		if($groupId != 3) //for test purpose
		{
			$this->_redirect('/pment/cpp');
			}
		$editForm = new Pment_Forms_MplanSave();
		$editForm->submit->setLabel('保存修改返回');
		$editForm->submit2->setLabel('继续修改材料');

		$mplans = new Pment_Models_MplanMapper();
		$mplans->populateDd($editForm);
		$planId = $this->_getParam('id',0);
		$projectId =$this->getProjectId();
		$editForm = $mplans->formValidator($editForm,1);

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$btClicked = $this->getRequest()->getPost('submit');
			if($editForm->isValid($formData))
			{
				$array = $mplans->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$userId = $this->getUserId();
					$users = new System_Models_UserMapper();
					$contactId = $users->getContactId($userId); 
					$mplan = new Pment_Models_Mplan();
					$mplan->setPlanId($planId);
					$mplan->setProjectId($projectId);
					$mplan->setPlanName($editForm->getValue('planName'));
					$mplan->setTypeId($editForm->getValue('typeId'));
					$mplan->setYearNum($editForm->getValue('yearNum'));
					$mplan->setMonNum($editForm->getValue('monNum'));
					$mplan->setPDate($editForm->getValue('pDate'));
					$mplan->setStatus(0);
					$mplan->setContactId($contactId);
					$mplan->setRemark($editForm->getValue('remark'));
					$mplans->save($mplan);
					if($btClicked == '保存修改返回')
					{
						$this->_redirect('/pment/mplan');
						}
						else
						{
							$this->_redirect('/pment/material/index/id/'.$planId);
							}
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
			if($planId >0)
			{
				$arrayMplan = $mplans->findArrayMplan($planId);
				$editForm->populate($arrayMplan);
				}
				else
				{
					$this->_redirect('pment/mplan');
					}
			}
		$this->view->editForm = $editForm;
		$this->view->id = $planId; 
	}
	
	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);


		$planId = $this->_getParam('id',0);
		if($planId > 0)
		{
			$mplans = new Pment_Models_MplanMapper();
			try{
				$mplans->delete($planId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('pment/mplan');
		}
	}
	
	public function displayAction()
	{
		$groupId = $this->getGroupId();
		if($groupId > 5)
		{
			$this->_redirect('/');
			}
		$planId = $this->_getParam('id',0);
		
		if($planId > 0)
		{
			//display plan info
			$mplans = new Pment_Models_MplanMapper();
			$mplan = new Pment_Models_Mplan();
			$mplans->find($planId,$mplan);
			$status = $mplan->getStatus();
			$arrayReviewers = null;
				//get reviewer
			$reviewers = new Pment_Models_ReviewerMapper();
			$arrayReviewers = $reviewers->fetchAllNames($planId);
			$this->view->mplan = $mplan;
			$this->view->groupId = $groupId;
			$this->view->id = $planId;
			$this->view->status = $status;
			$this->view->arrayReviewers = $arrayReviewers;
			$this->view->module = "pment";
			$this->view->controller = "mplan";
			$this->view->modelName = "材料计划信息"; 
			//display material info
			$materials = new Pment_Models_MaterialMapper();
			$condition = "planId";
			$arrayMaterials = $materials->fetchAllOrganize($planId,$condition);
			$this->view->arrayMaterials = $arrayMaterials;
			}
			else
			{
				$this->_redirect('/pment/mplan');
				}
	}
	
	public function applyAction()
	{
		$groupId = $this->getGroupId();
		if($groupId != 3) //for test purpose
		{
			$this->_redirect('/pment/mplan');
			}
		$id = $this->_getParam('id',0);
		
		if($id > 0)
		{	
			$errorMsg = null;
			//display plan info
			$mplans = new Pment_Models_MplanMapper();
			$mplan = new Pment_Models_Mplan();
			$mplans->find($id,$mplan);
			$materials = new Pment_Models_MaterialMapper();
			//display material info
			$condition = "planId";
			$arrayMaterials = $materials->fetchAllOrganize($id,$condition);
			if($this->getRequest()->isPost())
			{
				$btClicked = $this->getRequest()->getPost('btMapply');
				//add default manager to the reviewer team.
				if($btClicked == '确认并提交审批')
				{
					
					if(count($arrayMaterials) != 0)
					{
						$contactId = General_Models_ServerInfo::$default_reviewer;
						$reviewers = new Pment_Models_ReviewerMapper();
						$reviewer = new Pment_Models_Reviewer();
						$reviewer->setPlanId($mplan->getPlanId());
						$reviewer->setContactId($contactId);
						//$reviewer->setAddDate(date('Y-m-d,H:i'));
						$reviewer->setStatus(0);
						$reviewers->save($reviewer);
						$mplan->setStatus('1');
						//Add default manager ends
						$mplans->save($mplan);
						$message = General_Models_Text::$text_mplan_apply_sucess;
						$this->_helper->flashMessenger->addMessage($message);
						$this->_redirect('/pment/mplan');
						}
						else
						{
							$errorMsg = General_Models_Text::$text_mplan_apply_failed;
							
							}
					}
					else
					{
						$this->_redirect('/pment/mplan');
						}
			}
			$this->view->mplan = $mplan;
			$this->view->id = $id;
			$this->view->modelName = "材料计划信息"; 
			$this->view->arrayMaterials = $arrayMaterials;
			$this->view->errorMsg = $errorMsg;
			}
			else
			{
				$this->_redirect('/pment/mplan');
				}
	}
	
	public function bapproveAction()
	{
		$groupId = $this->getGroupId();
		if($groupId != 4) 
		{
			$this->_redirect('/pment/mplan');
			}
		$id = $this->_getParam('id',0);
		
		if($id > 0)
		{
			//display plan info
			$mplans = new Pment_Models_MplanMapper();
			$mplan = new Pment_Models_Mplan();
			$errorMsg = null;
			$mplans->find($id,$mplan);
			$status = $mplan->getStatus();
			$materials = new Pment_Models_MaterialMapper();
			$condition = "planId";
			$arrayMaterials = $materials->fetchAllOrganize($id,$condition);
			$bhistories = new Pment_Models_BhistoryMapper();
			$arrayBhistories = $bhistories->fetchAllBhistories($id,0);
			$reviewers = new Pment_Models_ReviewerMapper();
			$arrayReviewers = $reviewers->fetchAllNames($id);
			
			if($this->getRequest()->isPost())
			{
				$btClicked = $this->getRequest()->getPost('btSub');
				$formData = $this->getRequest()->getPost();
				$array = $materials->bapprovcValidator($formData);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$bhistory = new Pment_Models_Bhistory();
					$arrayMtrIds = $materials->fetchArryMtrIds($id);
					foreach($arrayMtrIds as $mtrId)
					{
						$material = new Pment_Models_Material();
						$materials->find($mtrId,$material);
						$material->setSpec($formData['spec_'.$mtrId]);
						$material->setAmountc($formData['amountc_'.$mtrId]);
						$material->setBudget($formData['budget_'.$mtrId]);
						$material->setBudgetTotal($formData['budgetTotal_'.$mtrId]);
						$material->setRemark($formData['remark_'.$mtrId]);
						$materials->save($material);
						}
					if($btClicked == "临时保存")
					{
						if($mplan->getStatus() == 1)
						{
							$mplan->setStatus(2);
							$bhistory->setEditType('材料计划首次审批');
							}
							else
							{
								$bhistory->setEditType('材料计划继续审批');
								}
						}
						elseif($btClicked =="确认并提交材料部审批")
						{
							$userId = $this->getUserId();
							$users = new System_Models_UserMapper();
							$approvcId = $users->getContactId($userId);
							$mplan->setStatus(3);
							$mplan->setApprovcId($approvcId);
							$mplan->setApprovcDate(date('Y-m-d,H:i'));
							
							//Send Email notifications to reviewers
							$reviewers = new Pment_Models_ReviewerMapper();
							$messages = new Admin_Models_MessageMapper();
							$message = new Admin_Models_Message();
							$arrayIds = $reviewers->fetchAllIds($mplan->getPlanId());
							$message->setFromId($this->getUserId());
							$message->setTitle(General_Models_Text::$text_mplan_validation_message_title);
							$message->setContent(General_Models_Text::$text_mplan_validation_message_content);
							$message->setSendTime(date("Y-m-d,H:i"));
							$message->setStatus(0);
							foreach($arrayIds as $userId)
							{
								$message->setToId($userId);
								$messages->sendByUserId($message);
								}
							$bhistory->setEditType('材料计划提交材料部');
							}
					$mplan->setApprovcRemark($formData['approvcRemark']);
					$mplans->save($mplan);
					$bhistory->setPlanId($id);
					$bhistory->setStatus(0);
					$userId = $this->getUserId();
					$users = new System_Models_UserMapper();
					$contactId = $users->getContactId($userId);
					$bhistory->setContactId($contactId);
					$bhistory->setEditDate(date('Y-m-d,H:i'));
					$bhistories->save($bhistory);
					$this->_redirect('/pment/mplan/bindex');
					}
				}
			$this->view->errorMsg = $errorMsg;
			$this->view->mplan = $mplan;
			$this->view->arrayReviewers = $arrayReviewers;
			$this->view->id = $id;
			$this->view->status = $status;
			$this->view->modelName = "预算部材料计划信息"; 
			$this->view->arrayBhistories = $arrayBhistories;
			//display material info
			$this->view->arrayMaterials = $arrayMaterials;
			}
			else
			{
				$this->_redirect('/pment/mplan');
				}
		}
		
	public function validationAction() //相关负责人核验
	{
		$userId = $this->getUserId();
		$planId = $this->_getParam('planId',0);
		$errorMsg = null;
		if($planId > 0)
		{
			$mplans = new Pment_Models_MplanMapper();
			$mplan = new Pment_Models_Mplan();
			$mplans->find($planId,$mplan);
			$reviewers = new Pment_Models_ReviewerMapper();
			$arrayIds = $reviewers->fetchAllIds($planId);
			$trueUser = false;
			foreach($arrayIds as $id)
			{
				if($id == $userId)
				{
					$trueUser = true;
						}
					}
			if($trueUser)
			{
				$materials = new Pment_Models_MaterialMapper();
				$condition = "planId";
				$arrayMaterials = $materials->fetchAllOrganize($planId,$condition);
				if($this->getRequest()->isPost())
				{
					$users = new System_Models_UserMapper();
					$formData = $this->getRequest()->getPost();
					$password = $formData['tbPassword'];
					if($users->checkPassword($password,$userId))
					{
						$reviewer = $reviewers->findReviewer($planId,$userId);
						$reviewer->setStatus(1);
						$reviewer->setAddDate(date('Y-m-d,H:i'));
						$reviewers->save($reviewer);
						$message = General_Models_Text::$text_mplan_validation_sucess;
						$this->_helper->flashMessenger->addMessage($message);
						$this->_redirect('/');
						}
						else
						{
							$errorMsg = General_Models_Text::$text_mplan_validation_wrong_password;
							}
				}
				$this->view->errorMsg = $errorMsg;
				$this->view->arrayMaterials = $arrayMaterials;
				$this->view->mplan = $mplan;
				}
				else
				{
					$this->_redirect('/pment/mplan');
					}
			}
			else
			{
				$this->_redirect('/pment/mplan');
				}
	}
	
	public function mapproveAction()
	{
		$userId = $this->getUserId();
		$groupId = $this->getGroupId();
		if($groupId != 5) 
		{
			$this->_redirect('/pment/mplan');
			}
		$id = $this->_getParam('id',0);
		
		if($id > 0)
		{
			//display plan info
			$mplans = new Pment_Models_MplanMapper();
			$mplan = new Pment_Models_Mplan();
			$errorMsg = null;
			$mplans->find($id,$mplan);
			$materials = new Pment_Models_MaterialMapper();
			$condition = "planId";
			$arrayMaterials = $materials->fetchAllOrganize($id,$condition);
			//MISS:load history of modification
			$bhistories = new Pment_Models_BhistoryMapper();
			$arrayBhistories = $bhistories->fetchAllBhistories($id,1);
			
			//MISS:load reviewers info
			$reviewers = new Pment_Models_ReviewerMapper();
			$arrayReviewers = $reviewers->fetchAllNames($id);
			
			if($this->getRequest()->isPost())
			{
				$redirect = true;
				$btClicked = $this->getRequest()->getPost('btSub');
				$formData = $this->getRequest()->getPost();
				$bhistory = new Pment_Models_Bhistory();
				if($btClicked == "临时保存")
				{
					if($mplan->getStatus() == 3)
					{
						$mplan->setStatus(5);
						$bhistory->setEditType('材料计划首次审批');
						}
						else
						{
							$bhistory->setEditType('材料计划继续审批');
						}
					}
					else
					{
						$reviewers = new Pment_Models_ReviewerMapper();
						//$messages = new Admin_Models_MessageMapper();
						//$message = new Admin_Models_Message();
						if($btClicked =="完成审批")
						{
							if($reviewers->checkAllValidated($id))
							{
								$mplan->setStatus(6);
								//$message->setTitle(General_Models_Text::$text_mplan_mapprove_complete_message_title);
								//$message->setContent(General_Models_Text::$text_mplan_mapprove_complete_message_content);
								$bhistory->setEditType('材料计划审批完成');
								}
								else
								{
									$errorMsg = General_Models_Text::$text_mplan_mapprove_validate_reviewer;
									$redirect = false;
									}
							}
							elseif($btClicked =="退回预算部重审")
							{
								$mplan->setStatus(4);
								$reviewers->resetAllReviewers($id);
								$bhistory->setEditType('材料计划退回重审');
							//	$message->setTitle(General_Models_Text::$text_mplan_mapprove_return_message_title);
							//	$message->setContent(General_Models_Text::$text_mplan_mapprove_return_message_content);
								}
						if($redirect)
						{
							$users = new System_Models_UserMapper();
							$approvfId = $users->getContactId($userId);
							$mplan->setApprovfId($approvfId);
							$mplan->setApprovfDate(date('Y-m-d,H:i'));
							//$message->setSendTime(date("Y-m-d,H:i"));
							//$message->setStatus(0);
							//$message->setFromId($this->getUserId());
							//$mapprovcId = $users->getUserIdById($mplan->getApprovcId());
							//$mcontactId = $users->getUserIdById($mplan->getContactId());
							//$message->setToId($mcontactId);
							//$messages->sendByUserId($message);
							//$message->setToId($mapprovcId);
							//$messages->sendByUserId($message);
							}
						}
					if($redirect)
					{
						$mplan->setApprovfRemark($formData['approvfRemark']);
						$mplans->save($mplan);
						$bhistory->setPlanId($id);
						$bhistory->setStatus(1);
						$users = new System_Models_UserMapper();
						$contactId = $users->getContactId($userId);
						$bhistory->setContactId($contactId);
						$bhistory->setEditDate(date('Y-m-d,H:i'));
						$bhistories->save($bhistory);
						$this->_redirect('/pment/mplan/mindex');
						}
					}
			$this->view->errorMsg = $errorMsg;
			$this->view->mplan = $mplan;
			$this->view->arrayReviewers = $arrayReviewers;
			$this->view->id = $id;
			$this->view->modelName = "材料部材料计划信息"; 
			$this->view->arrayBhistories = $arrayBhistories;
			//display material info
			$this->view->arrayMaterials = $arrayMaterials;
			}
			else
			{
				$this->_redirect('/pment/mplan');
				}
		}
	
	public function mfinalAction()
	{
		$userId = $this->getUserId();
		$groupId = $this->getGroupId();
		if($groupId != 5) 
		{
			$this->_redirect('/pment/mplan');
			}
		$id = $this->_getParam('id',0);
		
		if($id > 0)
		{
			//display plan info
			$mplans = new Pment_Models_MplanMapper();
			$mplan = new Pment_Models_Mplan();
			$errorMsg = null;
			$mplans->find($id,$mplan);
			$materials = new Pment_Models_MaterialMapper();
			$condition = "planId";
			$arrayMaterials = $materials->fetchAllOrganize($id,$condition);
			//load history of modification
			$bhistories = new Pment_Models_BhistoryMapper();
			$arrayBhistories = $bhistories->fetchAllBhistories($id,1);
			
			//load reviewers info
			$reviewers = new Pment_Models_ReviewerMapper();
			$arrayReviewers = $reviewers->fetchAllNames($id);
			
			if($this->getRequest()->isPost())
			{
				$redirect = true;
				$formData = $this->getRequest()->getPost();
				$array = $materials->mfinalValidator($formData);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$arrayMtrIds = $materials->fetchArryMtrIds($id);
					foreach($arrayMtrIds as $mtrId)
					{
						$material = new Pment_Models_Material();
						$materials->find($mtrId,$material);
						$material->setVendorName($formData['vendorName_'.$mtrId]);
						$material->setAmountf($formData['amountf_'.$mtrId]);
						$material->setCost($formData['cost_'.$mtrId]);
						$material->setCostTotal($formData['costTotal_'.$mtrId]);
						$materials->save($material);
						}
					$bhistory = new Pment_Models_Bhistory();
					$bhistory->setPlanId($id);
					$bhistory->setStatus(1);
					$userId = $this->getUserId();
					$users = new System_Models_UserMapper();
					$contactId = $users->getContactId($userId);
					$bhistory->setContactId($contactId);
					$bhistory->setEditDate(date('Y-m-d,H:i'));
					$bhistory->setEditType('添加采购信息');
					$bhistories->save($bhistory);
					$message = General_Models_Text::$text_mplan_mfinal_sucess;
					$this->_helper->flashMessenger->addMessage($message);
					$this->_redirect('/pment/mplan/mindex');
					}
				}
			$this->view->errorMsg = $errorMsg;
			$this->view->mplan = $mplan;
			$this->view->arrayReviewers = $arrayReviewers;
			$this->view->id = $id;
			$this->view->modelName = "材料部材料计划信息"; 
			$this->view->arrayBhistories = $arrayBhistories;
			//display material info
			$this->view->arrayMaterials = $arrayMaterials;
			}
			else
			{
				$this->_redirect('/pment/mplan');
				}
		}

	protected function getProjectId()
	{
		$projectNamespace = new Zend_Session_Namespace('projectNamespace');
		return $projectNamespace->projectId;
		}
	
	protected function getUserId()
	{
		$userNamespace = new Zend_Session_Namespace('userNamespace');
		return $userNamespace->userId;
		}
	
	protected function getGroupId()
	{
		$userId = $this->getUserId();
		$users = new System_Models_UserMapper();
		$groupId = $users->getGroupId($userId);
		return $groupId;
	}
}
?>