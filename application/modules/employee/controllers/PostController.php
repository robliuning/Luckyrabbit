<?php
/*
  created: 2011.3.27
  author: mingtingling
  version: v0.1
*/
class Employee_PostController extends  Zend_Controller_Action
{
   public function init()
	{
	   /*��ʼ��*/
	}
   public function preDispatch()
	{
	   /*����*/
	   $this->view->render("_sidebar.phtml");
	}
	public function indexAction()
    {
	   $employee=new Application_Model_DbTable_Employee();
	   /*��֪����ô��*/
       $select=$employee->select()
		     ->setIntegrityCheck(false)
		     ->from(array('c'=>''))
	}
public function editAction() /*�޸�*/
	{
	 $editForm=new Employee_Form_PostSave();
	 $editForm->submit->setLabel('�����޸�');
	 /*���ز�Ӧ����ʾ����*/
	 $editForm->submit2->setAttrib('class','hide');
	 $editForm->contactno->setAttrib('class','hide');
	 $editForm->postid->setAttrib('class','hide');
	 $editForm->othercontact->setAttrib('class','hide');
	 /*�������ݿ⣬ȡ��ֵ*/
	 $projectOptions=new  Application_Model_DbTable_Project();
	 $postOptions=new Application_Model_DbTable_Post();
	 $editForm->getElement('postname')->setMultiOptions($postOptions);
	 $editForm->getElement('projectname')->setMultiOptions($projectOptions);
     $this->view->form=$editForm;
	 $this->view->id=$this->_getParam('id');
	 if($this->getRequest()->isPost())
		{
		 $formData=$this->getRequest()->getPost();
		 if($editForm->isValid($formData))
			{
              $postid=$this->_getParam('id');
			  $postname=$this->getValue('postname');
              $postcardid=$this->getValue('postcardid');
			  $posttype=$this->getValue('posttype');
			  $certid=$this->getValue('certid');
			  $remark=$this->getValue('remark');
              $empsPost=new Application_Model_DbTable_Post();
			  $empsPost->updatePost($postid,$postname,$posttype,$postcardid,$certid,$remark);
			  /*���ڻ���֪����ôȡ��contact��project��ID*/
			  $empsProject=new Application_Model_DbTable_Cpp();
			  $empsProject->updateProject($contact,$postid,$projectid);
			  $this->redirect('/employee');
			 
			}
		 else
			{
			 $editForm->populate($formData);
			}
		}
		else
		{
          $id=$this->getParam('id',0);
		  if($id>0)
			{
			  $emps=new Application_Model_DbTable_Post();
			  $editForm->populate($emps->getPost($id));
			}
		  else
			{
              $this->redirect('/employee');
			}
		}
	}
 public function addAction()/*�½�*/
    {
		$addForm=new Employee_Form_PostSave();
		$addForm->submit->setLabel('��������½�');
		$addForm->submit2->setLabel('���淵����ҳ');
	   /*���ز�Ӧ����ʾ����*/
	    $addForm->contactno->setAttrib('class','hide');
	    $addForm->othercontact->setAttrib('class','hide');
	  /*�������ݿ⣬ȡ��ֵ*/
	 	$projectOptions=new  Application_Model_DbTable_Project();
     	$postOptions=new Application_Model_DbTable_Post();
	    $addForm->getElement('postname')->setMultiOptions($postOptions);
	    $addForm->getElement('projectname')->setMultiOptions($projectOptions);
		$tbid=$addForm->getElement('postId');
		$tbid->setValue('��λ����ڱ����½����Զ�����');
		$this->view->form=$addForm;
        if($this->getRequest()->isPost())
		  {
			$dec=$this->getRequest->getPost('submit');
			$formData=$this->getRequest()->getPost();
			if($addForm->isValid($formData))
			  {
              $postid=$this->_getParam('id');
			  $postname=$this->getValue('postname');
              $postcardid=$this->getValue('postcardid');
			  $posttype=$this->getValue('posttype');
			  $certid=$this->getValue('certid');
			  $remark=$this->getValue('remark');
              $empsPost=new Application_Model_DbTable_Post();
			  $empsPost->addPost($postname,$posttype,$postcardid,$certid,$remark);
			  /*Project���ݿ⻹û��Ū*/
			  if($dec=='��������½�')
				  {
	 	      $projectOptions=new  Application_Model_DbTable_Project();
     	      $postOptions=new Application_Model_DbTable_Post();
	          $addForm->getElement('postname')->setMultiOptions($postOptions);
	          $addForm->getElement('projectname')->setMultiOptions($projectOptions);
		      $tbid=$addForm->getElement('postId');
		      $tbid->setValue('��λ����ڱ����½����Զ�����');
				  }
			  else
				  {
                  $this->redirect('/employee');
				  }
			  }
		else
			 {
             $addForm->populate($formData);
			 }
    	  }
	}
	public function ajaxDeleteAction()/*ɾ��*/
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$id=$this->_getParam('id',0);
		/*����֪����ôɾ��������ļ�¼*/
		if($id>0)
		{
          $empsPost=new Application_Model_DbTable_Post();
          $empsPost->deletePost($id);
          echo "1";
		}
		else
		{
			$this->redirect('/employee');
		}
	}
   public function ajaxDisplayAction() /*��ʾ*/
    {
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$id=$this->_getParam('id',0);
		if($id>0)
		{
         
		}
	}
}
?>