<?php
//updated in 1st July by Rob

class Pment_ValidationController extends Zend_Controller_Action
{
	public function init()
	{
	
	}

	public function indexAction()
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