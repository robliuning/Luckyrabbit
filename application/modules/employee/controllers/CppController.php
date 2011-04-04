<?php
/*
  created: 2011.4.3
  author: mingtingling
  version: v0.2
*/
class Employee_CppController extends  Zend_Controller_Action
{
   public function init()
	{
		/* Initialize action controller here */
	}
   public function preDispatch()
	{
	   $this->view->render("_sidebar.phtml");
	}
	public function indexAction()
    {
	 	$cpp = new Employee_Models_CppMapper();
      	$this->view->entries = $cpp->fetchAll(null,null);
	   	}
	   	
	public function editAction() /*修改*/
	{
	 $editForm=new Employee_Forms_CppSave();
	 $editForm->submit->setLabel("保存修改");
     $editForm->submit2->setAttrib('class','hide');
	 /*下拉条*/
	 $cpps=new Employee_Models_DbTable_Cpp();
	 $cpps->populateCppDd($editForm);
	 /*end*/
	 $this->view->form=$editForm;
	 if($this->getRequest()->isPost())
		{
		  $formData=$this->getRequest()->getPost();
		  if($editForm->isValid($formData))
			{
			     $postId=$editForm->getValue('postId');
				 $contactId=$editForm->getValue('contactId'); /*从隐藏域中读出员工姓名的ID*/
                 $postName=$editForm->getValue('postName');
                 $contactName=$editForm->getValue('contactName');
                 $projectName=$editForm->getValue('projectName');/*实际上得到的是projectId*/
                 $postType=$editForm->getValue('postType');
                 $postCardId=$editForm->getValue('postCardId');
                 $certId=$editForm->getValue('certId');
				 /*取得没有修改前的三个编号*/
				 $prePostId=$editForm->getValue('prePostId');
				 $preContactId=$editForm->getValue('preContactId');
				 $preProjectName=$editForm->getValue('preProjectName');
				 /*end*/
				 /*查找是否存在该记录*/
				        $errorMsg;
			            $validatorRe = new Zend_Validate_Db_RecordExists(
			        	array(
			  		     'table'=>'em_cpp',
			  		     'field'=>'postId',
						 'field'=>'contactId',
						 'field'=>'projectName'  /*有可能是出错的*/
			  	            	)
			              );
			          if($validatorRe->isValid($postId,$contactId,$projectName)) /*已经存在这条记录*/
			  	          {
			  		       $errorMsg="该岗位信息已经存在。";
			  		      }
			  		  else /*不存在这条记录，可以update一条记录*/
			  		      {
			  			    $cpps->updateCpp($contactId,$postId,$projectName,$postCardId,$postType,$certId); /*projectName实际上是projectId*/
							$cpps->deleteCpp($preContactId,$prePostId,$preProjectId);
						 	$this->_redirect('/employee/cpp');
			  		      }
			  		      }
			    					 
				 /*end*/
			else
		   {
                 $editForm->populate($formData);
		   }
		 }
		   
		else
	   {
	   	   $id=$this->_getParam('id'); /*传递过来的Id,实际上是三个值，中间用&连接的*/
	   	   $str=explode('&',$id);
	   	   $contactId=(int)$str[0];
	   	   $postId=(int)$str[1];
	   	   $projectId=(int)$str[2];
		   if(!empty($id))
		   {
		   	 $cppMapper = new Employee_Models_Cppmapper();
		   	 
		   	 $data = $cppMapper->getCpp($contactId,$postId,$projectId);
			 foreach($data as $da)
			 {
				 $contactId=$editForm->getElement('contactId');
                 $contactId->setValue($da->getContactId());
				 $preContactId->$editForm->getElement('preContactId');
                 $preContactId->setValue($da->getContactId());
				 $postId=$editForm->getElement('postId');
                 $postId->setValue($da->getPostId());
				 $prePostId=$editForm->getElement('prePostId');
				 $prePostId->setValue($da->getPostId());
				 $projectName=$editForm->getElement('projectName');
                 $projectName->setValue($da->getProjectName());
				 $preProjectName=$editForm->getElement('preProjectName');
				 $preProjectName->setValue($da->getProjectName());
				 $postCardId=$editForm->getElement('postCardId');
                 $postCardId->setValue($da->getPostCardId());
				 $postType=$editForm->getElement('postType');
                 $postType->setValue($da->getPostType());
				 $certId=$editForm->getElement('certId');
                 $certId->setValue($da->getCertId());
				 $contactName=$editForm->getElement('contactName');
				 $contactName->setValue($da->getContactName());
			   }
		   }
		 else /*非法访问*/
		   {
           $this->_redirect('/employee/cpp');
		   }
	   }
	 }
 	public function addAction()/*新建*/
    {
     $addForm=new Employee_Forms_CppSave();
	 $addForm->submit->setLabel("保存继续新建");
	 $addForm->submit2->setLabel("保存返回上页");
	 /*下拉条*/
	 $cpps=new Employee_Models_DbTable_Cpp();
     $cpps->populateCppDd($addForm);
	/*end*/
     $this->view->form=$addForm;
	 if($this->getRequest()->isPost())
		{
		   $dec=$this->getRequest()->getPost('submit');
		   $formData=$this->getRequest()->getPost();
		   if($addForm->isValid($formData))
			{
			     $postId=$addForm->getValue('postId');
				 $contactId=$addForm->getValue('contactId'); /*从隐藏域中读出员工姓名的ID*/
                 $postName=$addForm->getValue('postName');
                 $contactName=$addForm->getValue('contactName');
                 $projectName=$addForm->getValue('projectName');/*实际上得到的是projectId*/
                 $postType=$addForm->getValue('postType');
                 $postCardId=$addForm->getValue('postCardId');
                 $certId=$addForm->getValue('certId');
                 /*查找em_cpp是否存在该记录*/
				     	$errorMsg = null;
			            $validatorRe = new Zend_Validate_Db_RecordExists(
			        	array(
			  		     'table'=>'em_cpp',
			  		     'field'=>'postId',
						 'field'=>'contactId',
						 'field'=>'projectId' 
			  	            	)
			              );
			          if($validatorRe->isValid($postId,$contactId,$projectName)) /*已经存在这条记录*/
			  	          {
			  		       $errorMsg="该岗位信息已经存在。";
			  		      }
			  		  else /*不存在这条记录，可以insert一条记录*/
			  		      {
			  			    $cpps->addCpp($contactId,$postId,$projectName,$postCardId,$postType,$certId); /*projectName实际上是projectId*/
			  		      }
				/*查找结束*/
				if($dec=="保存继续新建")
			    {
			    	$this->view->errorMsg=$errorMsg;
			    }
				else
			   {
					$this->_redirect('/employee/cpp');
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
		$contactId=$this->_getParam('contactId',0);
        $postId=$this->_getParam('postId',0);
		$projectId=$this->_getParam('projectId',0);
		if(($contactId>0)&&($postId>0)&&($projectId>0))
		{
			$cpps=new Employee_Models_DbTable_Cpp();
			$cpps->deleteCpp($contactId,$postId,$projectId);
			echo "1";
		}
		else
		{
         $this->_redirect('/employee');
		}
	}
   public function ajaxDisplayAction() /*显示*/
    {
		$this->_helper->layout()->disableLayout();
		$contactId=$this->_getParam('contactId',0);
        $postId=$this->_getParam('postId',0);
		$projectId=$this->_getParam('projectId',0);
		if(($contactId>0)&&($postId>0)&&($projectId>0))
		{
			$cpps=new Employee_Models_DbTable_Cpp();
			$this->view->entries=$cpps->displayOne($contactId,$postId,$projectId);
		}
		else
		{
           $this->_redirect('/employee');
		}
	}
}
