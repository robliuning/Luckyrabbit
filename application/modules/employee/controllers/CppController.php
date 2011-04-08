<?php
/*
  author: mingtingling
  date:2011.4.3
  review rob
  date.2011.4.7
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
	public function indexAction() //check
    {
	 	$cpps = new Employee_Models_CppMapper();
      	$this->view->cpps = $cpps->fetchAllJoin(null,null);
	 }
	  
	public function addAction()//check
    {
     	$addForm=new Employee_Forms_CppSave();
	 	$addForm->submit->setLabel("保存继续新建");
	 	$addForm->submit2->setLabel("保存返回上页");
	 	
	 	$cpps=new Employee_Models_CppMapper();
     	$cpps->populateCppDd($addForm);
		
     	$this->view->addForm = $addForm;
	 	if($this->getRequest()->isPost())
		{
		   	$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
		   	if($addForm->isValid($formData))
			{
				$cpp = new Employee_Models_Cpp();
				$cpp->setPostId($addForm->getValue('postId'));
				$cpp->setContactId($addForm->getValue('contactId'));
				$cpp->setProjectId($addForm->getValue('projectId'));
				$cpp->setPostType($addForm->getValue('postType'));
				$cpp->setPostCardId($addForm->getValue('postCardId'));
				$cpp->setCertId($addForm->getValue('certId'));
				
				$errorMsg = null;
			    $validatorRe = new Zend_Validate_Db_RecordExists(
			    array(
			  		 'table'=>'em_cpp',
			  		 'field'=>'postId',
					 'field'=>'contactId',
					 'field'=>'projectId' 
			  	     	)
			        );
			        
			   	if($validatorRe->isValid($cpp->getPostId(),$cpp->getContactId(),$cpp->getProjectId())) 
			  	{
			  		$errorMsg = "该岗位信息已经存在。";
			  		$addForm->populate($formData);
			  		}
			  		else
			  		{
			  			$result = $cpps->save($cpp); 
			  			$addForm->getElement('contactName')->setValue('');	
			  			$addForm->getElement('postId')->setValue('');	
			  			$addForm->getElement('projectId')->setValue('');	
			  			$addForm->getElement('postType')->setValue('');			    	
			  			$addForm->getElement('postCardId')->setValue('');	
			  			$addForm->getElement('certId')->setValue('');	
			  			}

				if($btClicked=="保存继续新建")
			    {
			    	$this->view->errorMsg = $errorMsg;
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
	   	
	public function editAction() 
	{
	 	$editForm=new Employee_Forms_CppSave();
	 	$editForm->submit->setLabel("保存修改");
     	$editForm->submit2->setAttrib('class','hide');

	 	$cpps=new Employee_Models_CppMapper();
	 	$cpps->populateCppDd($editForm);
	 	$cppId = $this->_getParam('id',0);

	 	if($this->getRequest()->isPost())
		{
		  $formData=$this->getRequest()->getPost();
		  if($editForm->isValid($formData))
			{
				$cpp = new Employee_Models_Cpp();
				$cpp->setCppId($cppId);
				$cpp->setPostId($editForm->getValue('postId'));
				$cpp->setContactId($editForm->getValue('contactId'));
				$cpp->setProjectId($editForm->getValue('projectId'));
				$cpp->setPostType($editForm->getValue('postType'));
				$cpp->setPostCardId($editForm->getValue('postCardId'));
				$cpp->setCertId($editForm->getValue('certId'));
				
				$errorMsg = null;
			    $validatorRe = new Zend_Validate_Db_RecordExists(
			    array(
			  	 	'table'=>'em_cpp',
			  		'field'=>'postId',
					'field'=>'contactId',
					'field'=>'projectId' 
			  	   	 )
			    );
			    if($validatorRe->isValid($cpp->getPostId(),$cpp->getContactId(),$cpp->getProjectName())) 
			  	{
			        $errorMsg="该岗位信息已经存在。";
			  		}
			  		else 
			  		{
			  			$cpps->save($cpp);
						$this->_redirect('/employee/cpp');
			  		      }
			  		 }			    					 
			else
		   	{
                $editForm->populate($formData);
		   		}
		}
		else
	   	{
		   	if($cppId > 0)
		   	{
		   	 	$arrayCpp = $cpps->findArrayCpp($cppId);
		   	 	$editForm->populate($arrayCpp);
			 	   }
			else
			{
           		$this->_redirect('/employee/cpp');
		   		}
	   		}
	   $this->view->editForm = $editForm;
	   $this->view->cppId = $cppId;
	 }
 	
 	public function ajaxdeleteAction()/*删除*/
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
        $cppId = $this->_getParam('id',0);
		if($cppId > 0)
		{
			$cpps=new Employee_Models_CppMapper();
			$result = $cpps->delete($cppId);
			echo $result;
		}
		else
		{
         $this->_redirect('/employee');
		}
	}
   public function ajaxdisplayAction() /*显示*/
    {
		$this->_helper->layout()->disableLayout();
        $cppId=$this->_getParam('id',0);
		if($cppId>0)
		{
			$cpps=new Employee_Models_DbTable_Cpp();
			$this->view->entries=$cpps->getCpp($cppId);
		}
		else
		{
           $this->_redirect('/employee');
		}
	}
}
