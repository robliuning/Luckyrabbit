<?php
/*created: 2011.3.26
author: mingtingling
version: v0.1
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
    	$employee = new Application_Model_DbTable_Employee();
		$select = $employee->select()
			->setIntegrityCheck(false)
			->from(array('e'=>'em_employees'),array('deptName','dutyName','titleName','status'))
			->join(array('c'=>'em_contacts'),array('contactId','name','gender','phoneNo','adress'),e.empId = c.contactId);
      	$this->view->entries = $employee->fetchAll($select);
    }
	public function editAction()
	{
		$editForm = new Employee_form_employeeSave();
    	$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');
		$deptOptions=new Application_Model_DbTable_Dept();
		$dutyOptions=new Application_Model_DbTable_Duty();
		$titleOptions=new Application_Model_DbTable_Title();
		$editForm->getElement('deptName')->setMultiOptions($deptOptions);
        $editForm->getElement('dutyName')->setMultiOptions($dutyOptions);
		$editForm->getElement('titleName')->setMultiOptions($titleOptions);
    	$this->view->form = $editForm;
    	$this->view->id = $this->_getParam('id');
		if($this->getRequest()->isPost())
		{
          $formData=$this->getRequest()->getPost();
		  if($editForm->isVaild($formData))
			 {
			  $empId=$this->_getParam('id');
			  $deptName=$this->getValue('deptName');
			  $dutyName=$this->getValue('dutyName');
			  $titleName=$this->getValue('titleName');
			  $status=$this->getValue('status');
              $emps=new Application_Model_DbTable_Employee();
              $emps->updateEmployee($empId,$deptName,$dutyName,$titleName,$status);
			  this->redirect('/employee');
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
            $emps=new Application_Model_DbTable_Employee();
            $editForm->populate($emps->getEmployee($id));
			}
			else
			{
		     $this->redirect('/employee');
			}
		}
	}
  public function addAction()
	{
     $addForm = new Employee_form_employeeSave();
	 $addForm->submit->setLabel('保存继续新建');
	 $addForm->submit->setLabel('保存返回上页');
	 $deptOptions=new Application_Model_DbTable_Dept();
	 $dutyOptions=new Application_Model_DbTable_Duty();
	 $titleOptions=new Application_Model_DbTable_Title();
	 $addForm->getElement('deptName')->setMultiOptions($deptOptions);
     $addForm->getElement('dutyName')->setMultiOptions($dutyOptions);
	 $addForm->getElement('titleName')->setMultiOptions($titleOptions);
	 $tbId=$addForm->getElement('empId');
	 $tbId->setValue('员工编号在保存新建后自动生成');
	 $this->view->form=$addForm;
		if($this->getRequest()->isPost())
		{
		  $dec=$this->getRequest->getPost('submit');
          $formData=$this->getRequest()->getPost();
		  if($addForm->isVaild($formData))
			 {
			  $empId=$this->_getParam('id');
			  $deptName=$this->getValue('deptName');
			  $dutyName=$this->getValue('dutyName');
			  $titleName=$this->getValue('titleName');
			  $status=$this->getValue('status');
              $emps=new Application_Model_DbTable_Employee();
              $emps->addEmployee($empId,$deptName,$dutyName,$titleName,$status);
			   if($dec=='保存继续新建')
				 {
				   	 $deptOptions=new Application_Model_DbTable_Dept();
	                 $dutyOptions=new Application_Model_DbTable_Duty();
	                 $titleOptions=new Application_Model_DbTable_Title();
	                 $addForm->getElement('deptName')->setMultiOptions($deptOptions);
                     $addForm->getElement('dutyName')->setMultiOptions($dutyOptions);
	                 $addForm->getElement('titleName')->setMultiOptions($titleOptions);
					 $tbId=$addForm->getElement('empId');
	                 $tbId->setValue('员工编号在保存新建后自动生成');
				 }
			  else
				 {
				      $this->redirect('/employee');
				 }
			}
		  else
			{
			  $editForm->populate($formData);
			}
	  }
  }
  public function ajaxDeleteAction()
  {
    $this->_helper->layout()->disableLayout();
    $this->_helper->viewRenderer->setNoRender(true);
    $id=$this->_getParam('id',0);
	if($id>0)
	  {
		$emps=new Application_Model_DbTable_Employee();
        $emps->deleteEmployee($id);
		echo "1";
	  }
	else
	  {
		$this->redirect('/employee');
	  }
  }
  public function ajaxDisplayAction()
  {
	$this->_helper->layout()->disableLayout();
	$this->_helper->viewRenderer->setNoRender(true);
	$id=$this->_getPararm('id',0);
	if($id>0)
	  {
    $employee = new Application_Model_DbTable_Employee();
	$select = $employee->select()
			->setIntegrityCheck(false)
			->from(array('e'=>'em_employees'))
			->join(array('c'=>'em_contacts'),e.empId = c.contactId);
    $this->view->entries=$employee->find($id,$select);
	  }
	else
	  {
		$this->redirect('/employee');
	  }
  }
}

