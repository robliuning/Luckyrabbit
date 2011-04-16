<?php
/*
author: mingtingling
date.2011.3.26
reviewed: rob
date 2001.4.7
Modified Meimo
Date :  Apr.15.2011
*/

class Employee_EmployeeController extends Zend_Controller_Action
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
		$employees = new Employee_Models_EmployeeMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayEmployees = array();
			$key = $formData['key'];
			if($key!==null)
			{
				$condition = $formData['condition'];
				$arrayEmployees  = $employees->fetchAllJoin($key,$condition);
				if(count($arrayEmployees )==0)
				{
					$errorMsg = 2;
					//waring a message  :  no match result
				}
			}
			else
			{
				$errorMsg = 1;
				//waring a message  :  please input a key word
			}
		}
		else
		{
			$arrayEmployees  = $employees->fetchAllJoin();
		}
		$this->view->arrayEmployees  = $arrayEmployees ;
		$this->view->errorMsg = $errorMsg;    
		}
    
    public function addAction() //check
	{
    	$addForm = new Employee_Forms_EmployeeSave();
	 	$addForm->submit->setLabel('保存继续新建');
	 	$addForm->submit2->setLabel('保存返回上页');
	 
	 	$employees = new Employee_Models_EmployeeMapper();
	 	$employees->populateEmployeeDd($addForm);
	 
		if($this->getRequest()->isPost())
		{
		  $btClicked = $this->getRequest()->getPost('submit');
          $formData=$this->getRequest()->getPost();
		  if($addForm->isValid($formData))
			 {
			 	$employee = new Employee_Models_Employee();
			 	$employee->setEmpId($addForm->getValue('empId'));
			 	$employee->setDeptName($addForm->getValue('deptName'));
			 	$employee->setDutyName($addForm->getValue('dutyName'));
			 	$employee->setStatus($addForm->getValue('status'));
			 	$empId = $employee->getEmpId();
				
				//varify if this empId is exists in contacts but not recorded in employees since one contact can only be assigned to one position in the company.				
			  	$errorMsg = "";
			  	$validatorRe = new Zend_Validate_Db_RecordExists(
			  		array(
			  			'table'=>'em_contacts',
			  			'field'=>'contactId'
			  			)
			  	);
			  	if($validatorRe->isValid($empId))
			  	{
			  		$validatorNe = new Zend_Validate_Db_NoRecordExists(
			  	 	array(
			  	 		'table'=>'em_employees',
			  	 		'field'=>'empId'
			  	 		)
			  		);
			  		if($validatorNe->isValid($empId))
			  		{
			  			$option = 'add';
						$employees->save($employee,$option);
			  			}
			  			else
			  			{
			  				/*foreach($validatorNe->getMessages() as $message)
			  				{
			  					$errorMsg.=$message."\n";
			  					}*/
			  				$errorMsg = "该员工已经注册过公司员工基本信息";
			  				}
			  		}
			  		else{
			  			/*standard way
			  			foreach($validatorRe->getMessages() as $message)
			  			{
			  				$errorMsg.=$message."\n";
			  				}*/
			  			$errorMsg = "输入的员工名无效，您可在通讯录管理页面录入其个人信息或点击上方工具栏’快速新建通讯录‘录入";
			  			}
			  			
			   if($btClicked == '保存继续新建')
			   {
					$this->view->errorMsg = $errorMsg;
					}
			   else
			{
				      $this->_redirect('/employee/employee');
				 }
			}
		else
		{
			  $editForm->populate($formData);
			}
		}
		$this->view->addForm = $addForm;
    }

	public function editAction()  //check
	{
		$editForm = new Employee_Forms_EmployeeSave();
    	$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');
    	$tbName = $editForm->getElement('name');
    	$tbName->setAttrib('disabled','disabled');

        $employees = new Employee_Models_EmployeeMapper();
    	$employees->populateEmployeeDd($editForm);

		$empId = $this->_getParam('id',0);

		if($this->getRequest()->isPost())
		{
          $formData=$this->getRequest()->getPost();
		  if($editForm->isValid($formData))
			 {
				$employee = new Employee_Models_Employee();
				$employee->setEmpId($empId);
				$employee->setDeptName($editForm->getValue('deptName'));
				$employee->setDutyName($editForm->getValue('dutyName'));
				$employee->setStatus($editForm->getValue('status'));
				$option = 'edit';
                $employees->save($employee,$option);
			    $this->_redirect('/employee/employee');
			}
		  else
			{
			  $editForm->populate($formData);
			}
		}
		else
	    {
			if($empId > 0)
			{
				$arrayEmployee = $employees->findArrayEmployee($empId);
				$editForm->populate($arrayEmployee);
				}
			else
			{
		     $this->redirect('/employee');
			}
		}
		
		$this->view->editForm = $editForm;
    	$this->view->id = $empId;
	}
 
  	public function ajaxdeleteAction() //check
  	{
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    
    	$id = $this->_getParam('id',0);
		if($id > 0)
	  	{
			$employees=new Employee_Models_EmployeeMapper();
        	$employees->delete($id);
			echo "1";
	  		}
			else
	  		{
				$this->redirect('/employee');
	  			}
  	}
  
  	public function autocompleteAction()
   	{
   	    $this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    	$key = $this->_getParam('key');
    	$contacts = new Employee_Models_ContactMapper();
    	$arrayNames = $contacts->findContactNames($key);
    	    	
    	echo $key;
   		}
}
?>
  