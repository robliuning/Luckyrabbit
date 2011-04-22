<?php
/*
Created Meimo
Date Apr.17.2011
reviewed rob
Date 4.19
*/

class Worker_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

		public function preDispatch()
		{
		$this->view->render('_sidebar.phtml');
		}

    public function indexAction()
    {
        // action body
		$errorMsg = null;
		$teams = new Worker_Models_TeamMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayTeams = array();
			$key = $formData['key'];
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayTeams = $teams->fetchAllJoin($key,$condition);
				if(count($arrayTeams) == 0)
				{
					$errorMsg = General_Models_Text::$text_searchErrorNr;
					}
				}
				else
				{
					$errorMsg = General_Models_Text::$tex_searchErrorNi;
					}
		}
		else
		{
			$arrayTeams = $teams->fetchAllJoin();
		}
		$this->view->arrayTeams = $arrayTeams;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "worker";
		$this->view->controller = "index";
		$this->view->modelName = "班组信息";
    }

	public function addAction()
	{
		//
		$addForm = new Worker_Forms_teamSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');

		$teams = new Worker_Models_TeamMapper();
		$result = null;

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$team = new Worker_Models_Team();
				$team->setName($addForm->getValue('name'));
				$team->setContactId($addForm->getValue('contactId'));
				$team->setRemark($addForm->getValue('remark'));
				$result = $teams->save($team);
				if($btClicked=='保存继续新建')
				{
					$addForm->getElement('name')->setValue('');
					$addForm->getElement('contactName')->setValue('');
					$addForm->getElement('remark')->setValue('');
					}
					else
					{
						$this->_redirect('/worker');
						}
			}
			else
			{
				$this->populate($formData);
			}
		}
		 $this->view->addForm = $addForm;
		 $this->view->result = $result;
	}

	public function editAction()
	{
		//
		$editForm = new Worker_Forms_teamSave();
		$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');

		$teams = new Worker_Models_TeamMapper();
    	$teamId = $this->_getParam('id',0);
    	$result = null;

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
			{
				$team = new Worker_Models_Team();
				$team->setTeamId($teamId);
				$team->setName($editForm->getValue('name'));
				$team->setContactId($editForm->getValue('contactId'));
				$team->setRemark($editForm->getValue('remark'));
				$result = $teams->save($team);

				$this->_redirect('/worker');
			}
			else
    			{
    				$editForm->populate($formData);
 					}
		}
		else
    	{
    		if($teamId >0)
    		{
    			$arrayTeams = $teams->findArrayTeam($teamId);
    			$editForm->populate($arrayTeams);
    			}
    			else
    			{
    				$this->_redirect('/worker');
    				}
    		}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $teamId; 
    	$this->view->result = $result;
	}

	public function ajaxdeleteAction()
	{
		//
		$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$teamId = $this->_getParam('id',0);
    	if($teamId > 0)
    	{
    		$teams = new Worker_Models_TeamMapper();
    		$teams->delete($teamId);
    		echo "1";
    		}
    		else
    		{
    			$this->_redirect('/worker');
    			}

	}
	public function displayAction()
	{
   		$id = $this->_getParam('id',0);
    	if($id >0)
    	{
   		    $teams = new Worker_Models_TeamMapper();
   		    $team = new Worker_Models_Team();
   			$teams->find($id,$team);
   			$this->view->team = $team;
   			}
    		else
    		{
   				$this->_redirect('/worker');
   				}
		}
}
?>