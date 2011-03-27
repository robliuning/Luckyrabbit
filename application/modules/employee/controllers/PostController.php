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
	   /*初始化*/
	}
   public function preDispatch()
	{
	   /*边栏*/
	   $this->view->render("_sidebar.phtml");
	}
	public function indexAction()
    {
	   $employee=new Application_Model_DbTable_Employee();
	   /*不知道怎么搞*/
       $select=$employee->select()
		     ->setIntegrityCheck(false)
		     ->from(array('c'=>''))
	}
public function editAction() /*修改*/
	{
	 $editForm=new Employee_Form_PostSave();
	 $editForm->submit->setLabel('保存修改');
	 /*隐藏不应该显示的项*/
	 $editForm->submit2->setAttrib('class','hide');
	 $editForm->contactno->setAttrib('class','hide');
	 $editForm->postid->setAttrib('class','hide');
	 $editForm->othercontact->setAttrib('class','hide');
	 /*连接数据库，取得值*/
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
			  /*现在还不知道怎么取得contact和project的ID*/
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
 public function addAction()/*新建*/
    {
		$addForm=new Employee_Form_PostSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
	   /*隐藏不应该显示的项*/
	    $addForm->contactno->setAttrib('class','hide');
	    $addForm->othercontact->setAttrib('class','hide');
	  /*连接数据库，取得值*/
	 	$projectOptions=new  Application_Model_DbTable_Project();
     	$postOptions=new Application_Model_DbTable_Post();
	    $addForm->getElement('postname')->setMultiOptions($postOptions);
	    $addForm->getElement('projectname')->setMultiOptions($projectOptions);
		$tbid=$addForm->getElement('postId');
		$tbid->setValue('岗位编号在保存新建后自动生成');
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
			  /*Project数据库还没有弄*/
			  if($dec=='保存继续新建')
				  {
	 	      $projectOptions=new  Application_Model_DbTable_Project();
     	      $postOptions=new Application_Model_DbTable_Post();
	          $addForm->getElement('postname')->setMultiOptions($postOptions);
	          $addForm->getElement('projectname')->setMultiOptions($projectOptions);
		      $tbid=$addForm->getElement('postId');
		      $tbid->setValue('岗位编号在保存新建后自动生成');
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
	public function ajaxDeleteAction()/*删除*/
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$id=$this->_getParam('id',0);
		/*还不知道怎么删除两个表的记录*/
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
   public function ajaxDisplayAction() /*显示*/
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