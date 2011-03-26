<?php
//2011.3.17  rob
//1.Data to populate db.deptName, dutyName, titleName will be added later
//2.Validation of inputs is missing (better with ajax)
//3.Set focus for each form
//4.For add and edit, the employeemapper has been skipped, the dbTable is used directly.
//5.Reconsider the use of zend_form
//6.Messagebox for sucessful adding, editting and deleting
//7.Missing Paginator for displayAction
//8.Need to validate the deletion result

class Employee_IndexController extends Zend_Controller_Action
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
    	$employees = new Application_Model_EmployeeMapper();
      	$this->view->entries = $employees->fetchAll();
    }
    
    public function displayAction()
    {
    	
    }
    
    public function editAction()
    {
    	$editForm = new Employee_form_edit();
    	$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');
    	$this->view->form = $editForm;
    	$this->view->id = $this->_getParam('id');
    	
    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$empId = $this->_getParam('id');
    			$name = $editForm->getValue('name');
    			$gender = $editForm->getValue('gender');
    			$age = $editForm->getValue('age');
    			$deptName = $editForm->getValue('deptName');
    			$dutyName = $editForm->getValue('dutyName');
    			$titleName = $editForm->getValue('titleName');
    			$idCard = $editForm->getValue('idCard');
    			$phone = $editForm->getValue('phone');
    			$otherContact = $editForm->getValue('otherContact');
    			$address = $editForm->getValue('address');
    			$status = $editForm->getValue('status');
    			$remark = $editForm->getValue('remark');
    			    			
    			$emps = new Application_Model_DbTable_Employee();
    			$emps->updateEmployee($empId,$name,$gender,$age,$deptName,$dutyName,$titleName,$idCard,$phone,$otherContact,$address,$status,$remark);    			
    			
    			
    			
    			$this->_redirect('/employee');
    			}
    			else
    			{
    				$editForm->populate($formData);
    				}
    		}
    		else
    		{
    			$id=$this->_getParam('id',0);
    			if($id >0)
    			{
    			    $emps = new Application_Model_DbTable_Employee();
    				$editForm->populate($emps->getEmployee($id));
    				}
    				else
    				{
    					$this->_redirect('/employee');
    					}
    			}
    	}
    
    public function addAction()
    {
        $editForm = new Employee_form_edit();
        $editForm->submit->setLabel('保存继续新建');
        $editForm->submit2->setLabel('保存返回上页');
    	$tbId = $editForm->getElement('empId');
    	$tbId->setValue('员工编号在保存新建后自动生成');
    	$this->view->form = $editForm;
    	
    	if($this->getRequest()->isPost())
    	{
    		$dec = $this->getRequest()->getPost('submit');
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$name = $editForm->getValue('name');
    			$gender = $editForm->getValue('gender');
    			$age = $editForm->getValue('age');
    			$deptName = $editForm->getValue('deptName');
    			$dutyName = $editForm->getValue('dutyName');
    			$titleName = $editForm->getValue('titleName');
    			$idCard = $editForm->getValue('idCard');
    			$phone = $editForm->getValue('phone');
    			$otherContact = $editForm->getValue('otherContact');
    			$address = $editForm->getValue('address');
    			$status = $editForm->getValue('status');
    			$remark = $editForm->getValue('remark');
    			    			
    			$emps = new Application_Model_DbTable_Employee();
    			$emps->addEmployee($name,$gender,$age,$deptName,$dutyName,$titleName,$idCard,$phone,$otherContact,$address,$status,$remark);   
    			if($dec == '保存继续新建')
    			{
   					$editForm->getElement('name')->setValue('');
   					$editForm->getElement('gender')->setValue('');
   					$editForm->getElement('age')->setValue('');
   					$editForm->getElement('deptName')->setValue('0');
   					$editForm->getElement('dutyName')->setValue('0');
   					$editForm->getElement('titleName')->setValue('');
   					$editForm->getElement('idCard')->setValue('');
					$editForm->getElement('phone')->setValue('');
					$editForm->getElement('otherContact')->setValue('');
					$editForm->getElement('address')->setValue('');
   					$editForm->getElement('status')->setValue('');
   					$editForm->getElement('remark')->setValue('');
   					}
   					else
    				{
    					$this->_redirect('/employee');
    					} 			
    			}
    			else
    			{
    				$editForm->populate($formData);
    				}
    		}
    }
    
    public function deleteAction()
    {
        $this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$id=$this->_getParam('id',0);
    	if($id >0)
    	{
    		$emps = new Application_Model_DbTable_Employee();
    		$emps->deleteEmployee($id);
    		echo "1";
    		}
    		else
    		{
    			$this->_redirect('/employee');
    			}
    }
   	
   	public function searchAction()
   	{
   	
   	}
   	public function ajaxempAction()
   	{
   		$this->_helper->layout()->disableLayout();
   		$id=$this->_getParam('id',0);
    	if($id >0)
    	{
   		    $emps = new Application_Model_DbTable_Employee();
   			$emp = $emps->getEmployee($id);
   			$this->view->employee = $emp;
   			}
    		else
    		{
   				$this->_redirect('/employee');
   				}
   		}
}
?>