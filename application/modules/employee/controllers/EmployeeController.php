<?php
/*
author: mingtingling
date.2011.3.26
reviewed: rob
date 2001.4.7
Modified Meimo
Date :  Apr.15.2011,Apr.21.2011
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
			$key = trim($formData['key']);
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayEmployees  = $employees->fetchAllJoin($key,$condition);
				if(count($arrayEmployees )==0)
				{
					$errorMsg = General_Models_Text::$text_searchErrorNr;
					//waring a message  :  no match result
				}
			}
			else
			{
				$errorMsg = General_Models_Text::$text_searchErrorNi;
				//waring a message  :  please input a key word
			}
		}
		else
		{
			$arrayEmployees  = $employees->fetchAllJoin();
		}
		$this->view->arrayEmployees  = $arrayEmployees;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "employee";
		$this->view->controller = "employee";
		$this->view->modelName = "公司员工信息"; 
		}
    
    public function addAction() //check
	{
    	$addForm = new Employee_Forms_EmployeeSave();
	 	$addForm->submit->setLabel('保存继续新建');
	 	$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
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
						$errorMsg = General_Models_Text::$text_save_sucess;
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
			  			$errorMsg = "输入的员工名无效。";
			  			}
			  			
			   if($btClicked == '保存继续新建')
			   {
			   	
					}
			   else
			{
				      $this->_redirect('/employee/employee');
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
			$employees = new Employee_Models_EmployeeMapper();
			try{
				$employees->delete($id);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
	  	}
		else
  		{
			$this->redirect('/employee/employee');
		}
  	}
  	public function ajaxdisplayAction()
  	{
  	   	$this->_helper->layout()->disableLayout();
   		$id = $this->_getParam('id',0);
    	if($id >0)
    	{
   		  $employees = new Employee_Models_EmployeeMapper();
   		  $employee = new Employee_Models_Employee();
   			$employees->find($id,$employee);
   			$this->view->employee = $employee;
   			}
    		else
    		{
   				$this->_redirect('/employee/employee');
   				}
  		}
}
?>