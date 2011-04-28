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
    	$errorMsg = null;
		$cpps = new Employee_Models_CppMapper();
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayCpps = array();
			$key = trim($formData['key']);
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayCpps = $cpps->fetchAllJoin($key,$condition);
				if(count($arrayCpps) == 0)
				{
					$errorMsg = General_Models_Text::$text_searchErrorNr;
					//warning will be displayed: "没有找到符合条件的结果。"
					}
				}
				else
				{
					$errorMsg = General_Models_Text::$text_searchErrorNi;
					//warning will be displayed: "请输入搜索关键字。"
					}
		}
		else
		{
			$arrayCpps = $cpps->fetchAllJoin();
			}
			
		$this->view->arrayCpps = $arrayCpps;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "employee";
		$this->view->controller = "cpp";
		$this->view->modelName = "员工岗位信息";
  	}
	  
	public function addAction()
    {
     	$addForm=new Employee_Forms_CppSave();
	 	$addForm->submit->setLabel("保存继续新建");
	 	$addForm->submit2->setLabel("保存返回上页");
	 	$errorMsg = null;
	 	$cpps=new Employee_Models_CppMapper();
     	$cpps->populateCppDd($addForm);
		
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
				
			/*    $validatorRe = new Zend_Validate_Db_RecordExists(
			    array(
			  		 'table'=>'em_cpp',
			  		 'field'=>'postId',
					 'field'=>'contactId',
					 'field'=>'projectId' 
			  	     	)
			        );
			        
			   	if($validatorRe->isValid($cpp->getPostId(),$cpp->getContactId(),$cpp->getProjectId())) 
			  	{
			  		$errorMsg = General_Models_Text::$text_cpp_exist;
			  		$addForm->populate($formData);
			  		}
			  		else
			  		{*/
			  			$result = $cpps->save($cpp); 
			  			$errorMsg = General_Models_Text::$text_save_success;	
			  			
				if($btClicked=="保存继续新建")
			    {
			    	$addForm->getElement('name')->setValue('');	
			  		$addForm->getElement('postId')->setValue('');	
			  		$addForm->getElement('projectId')->setValue('');	
		 			$addForm->getElement('postType')->setValue('');			    	
		  			$addForm->getElement('postCardId')->setValue('');	
		 			$addForm->getElement('certId')->setValue('');	
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
		
		$this->view->errorMsg = $errorMsg;		   	
		$this->view->addForm = $addForm;
	} 
	   	
	public function editAction() 
	{
	 	$editForm = new Employee_Forms_CppSave();
	 	$editForm->submit->setLabel("保存修改");
     	$editForm->submit2->setAttrib('class','hide');
		$errorMsg = null;

	 	$cpps = new Employee_Models_CppMapper();
	 	$cpps->populateCppDd($editForm);
	 	$cppId = $this->_getParam('id',0);

	 	if($this->getRequest()->isPost())
		{
		  	$formData = $this->getRequest()->getPost();
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
				
			   /* $validatorRe = new Zend_Validate_Db_RecordExists(
			    array(
			  	 	'table'=>'em_cpp',
			  		'field'=>'postId',
					'field'=>'contactId',
					'field'=>'projectId' 
			  	   	 )
			    );
			    if($validatorRe->isValid($cpp->getPostId(),$cpp->getContactId(),$cpp->getProjectName())) 
			  	{
			        $errorMsg = "该岗位信息已经存在。";
			  		}
			  		else 
			  		{*/
			  			$cpps->save($cpp);
						$this->_redirect('/employee/cpp');
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
	   $this->view->id = $cppId;
	 }
 	
 	public function ajaxdeleteAction()/*删除*/
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
        $cppId = $this->_getParam('id',0);
		if($cppId > 0)
		{
			$cpps = new Employee_Models_CppMapper();
			try{
				$cpps->delete($cppId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
         $this->_redirect('/employee/cpp');
		}
	}
	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
   		$cppId = $this->_getParam('id',0);
    	if($cppId >0)
    	{
   		    $cpps = new Employee_Models_CppMapper();
   		    $cpp = new Employee_Models_Cpp();
   			$cpps->find($cppId,$cpp);
   			$this->view->cpp = $cpp;
   			}
    		else
    		{
   				$this->_redirect('/employee/cpp');
   				}
		}
}
