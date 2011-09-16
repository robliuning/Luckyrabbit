<?php
//updated on 12 August By Rob

class Pment_ReviewerController extends Zend_Controller_Action
{	
	/*public function init()
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
	}*/

	public function ajaxaddAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$contactId = $this->_getParam('contactId',0);
		$planId = $this->_getParam('planId',0);
		if($contactId > 0)
		{
			$reviewers = new Pment_Models_ReviewerMapper();
			if($reviewers->checkExist($contactId,$planId))
			{
				$reviewer = new Pment_Models_Reviewer();
				$reviewer->setPlanId($planId);
				$reviewer->setContactId($contactId);
				$reviewer->setStatus(0);
				$id = $reviewers->save($reviewer);
				
				echo $id;
				}
				else
				{
					echo "f";
					}
			}
			else
			{
				$this->_redirect('/pment/mplan');
				}
	}
	
	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$reId = $this->_getParam('reId',0);
		if($reId > 0)
		{
			$reviewers = new Pment_Models_ReviewerMapper();
			try{
				$reviewers->delete($reId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
			$this->_redirect('/pment/mplan');
		}
	}
}
?>