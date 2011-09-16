<?php
//updated on 12 August By Rob

class Pment_CommentController extends Zend_Controller_Action
{
	public function init()
	{
		$groupId = $this->getGroupId();
		if($groupId != 4 ) 
		{
			if($groupId != 5)
			{
				$this->_redirect('/pment/mplan');
				}
			}
	}

	public function ajaxaddAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$mtrId = $this->_getParam('mtrId',0);
		$cmt = $this->_getParam('comment',0);
		if($mtrId != null)
		{
			$userId = $this->getUserId();
			$users = new System_Models_UserMapper();
			$contactId = $users->getContactId($userId);
			$comments = new Pment_Models_CommentMapper();
			$comment = new Pment_Models_Comment();
			$comment->setMtrId($mtrId);
			$comment->setComment($cmt);
			$comment->setContactId($contactId);
			$comment->setAddDate(date('Y-m-d,H:i'));
			$id = $comments->save($comment);
			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findContactName($contactId);
			$json['addDate'] = $comment->getAddDate();
			$json['contactId'] = $comment->getContactId();
			$json['contactName'] = $contactName;
			$json['cId'] = $id;
			$json = Zend_Json::encode($json);
			echo $json;
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

		$cId = $this->_getParam('cId',0);
		if($cId > 0)
		{
			$comments = new Pment_Models_CommentMapper();
			try{
				$comments->delete($cId);
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
	
	public function ajaxfetchallAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		
		$mtrId = $this->_getParam('mtrId',0);
		if($mtrId > 0)
		{
			$comments = new Pment_Models_CommentMapper();
			$arrayComments = $comments->fetchAllComments($mtrId);
			$json = Zend_Json::encode($arrayComments);
			echo $json;
			}
			else
			{
				$this->_redirect('/pment/mplan');
				}
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