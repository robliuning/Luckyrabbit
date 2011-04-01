<?php
/*created: 2011.3.26
author: mingtingling
reviewed: rob:2001.3.31
version: v0.2
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

    public function indexAction()
    {
    	$employee = new Employee_Models_DbTable_Employee();
      	$this->view->entries = $employee->displayAll();
    }
	public function editAction()
	{
		$editForm = new Employee_Forms_EmployeeSave();
    	$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');
    	$tbName = $editForm->getElement('name');
    	$tbName->setAttrib('disabled','disabled');
    	//populate dropdown  	
        $emps=new Employee_Models_DbTable_Employee();
    	$emps->populateEmployeeDd($editForm);

		//end
    	$this->view->form = $editForm;
    	$this->view->id = $this->_getParam('id');
		if($this->getRequest()->isPost())
		{
          $formData=$this->getRequest()->getPost();
		  if($editForm->isValid($formData))
			 {
			  $empId=$this->_getParam('id');
			  $deptName=$editForm->getValue('deptName');
			  $dutyName=$editForm->getValue('dutyName');
			  $titleName=$editForm->getValue('titleName');
			  $status=$editForm->getValue('status');
              $emps->updateEmployee($empId,$deptName,$dutyName,$titleName,$status);
			  $this->_redirect('/employee/employee');
			}
		  else
			{
			  $editForm->populate($formData);
			}
		}
		else
	    {
			$id=$this->_getParam('id',0);
			if($id>0)
			{
            	$data = $emps->displayOne($id);
            	foreach($data as $da)
            	{
            	    $empId = $editForm->getElement('empId');
            		$empId->setValue($da->empId);
            		$name = $editForm->getElement('name');
            		$name->setValue($da->name);
            		$dept = $editForm->getElement('deptName');
            		$dept->setValue($da->deptName);
            		$duty = $editForm->getElement('dutyName');
            		$duty->setValue($da->dutyName);
            		$title = $editForm->getElement('titleName');
            		$title->setValue($da->titleName);
            		$status = $editForm->getElement('status');
            		$status->setValue($da->status);
            		}
				}
			else
			{
		     $this->redirect('/employee');
			}
		}
	}
  public function addAction()
	{
     $addForm = new Employee_Forms_EmployeeSave();
	 $addForm->submit->setLabel('保存继续新建');
	 $addForm->submit2->setLabel('保存返回上页');
	 $emps = new Employee_Models_DbTable_Employee();
	 $emps->populateEmployeeDd($addForm);
	 $this->view->form=$addForm;
		if($this->getRequest()->isPost())
		{
		  $dec=$this->getRequest()->getPost('submit');
          $formData=$this->getRequest()->getPost();
		  if($addForm->isValid($formData))
			 {
			  $empId=$addForm->getValue('empId');
			  $deptName=$addForm->getValue('deptName');
			  $dutyName=$addForm->getValue('dutyName');
			  $titleName=$addForm->getValue('titleName');
			  $status=$addForm->getValue('status');
			  $contact = new Employee_Models_DbTable_Contact();
			  //valdiate if the empid is exists in contacts but not recorded in employees since one contact can have up to 1 position within the company.
			  $errorMsg;
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
			  		$emps->addEmployee($empId,$deptName,$dutyName,$titleName,$status);
			  		}
			  		else
			  		{
			  			/*foreach($validatorNe->getMessages() as $message)
			  			{
			  				$errorMsg.=$message."\n";
			  				}*/
			  			$errorMsg = "该员工已经注册过公司基本信息。";
			  			}
			  	}
			  	else{
			  	/*standard way
			  		foreach($validatorRe->getMessages() as $message)
			  		{
			  			$errorMsg.=$message."\n";
			  			}*/
			  		$errorMsg = "输入的员工名无效，您需要首先在通讯录管理录入其个人信息或点击工具栏’快速新建通讯录‘录入。";
			  		}
			   if($dec=='保存继续新建')
			   {
					$this->view->errorMsg=$errorMsg;
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
  }
  public function ajaxdeleteAction()
  {
    $this->_helper->layout()->disableLayout();
    $this->_helper->viewRenderer->setNoRender(true);
    $id=$this->_getParam('id',0);
	if($id>0)
	  {
		$emps=new Employee_Models_DbTable_Employee();
        $emps->deleteEmployee($id);
		echo "1";
	  }
	else
	  {
		$this->redirect('/employee');
	  }
  }
  public function ajaxdisplayAction()
  {
	$this->_helper->layout()->disableLayout();
	//$this->_helper->viewRenderer->setNoRender(true);
	$id=$this->_getParam('id',0);
	if($id>0)
	  {
   		$employee = new Employee_Models_DbTable_Employee();
    	$this->view->entries=$employee->displayOne($id);  		
	  }
	else
	  {
		$this->redirect('/employee');
	  }
  }

}

