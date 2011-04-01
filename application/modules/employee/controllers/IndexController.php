<?php
//1.Data to populate db.deptName, dutyName, titleName will be added later
//2.Validation of inputs is missing (better with ajax)
//3.Set focus for each form
//4.For add and edit, the employeemapper has been skipped, the dbTable is used directly.
//5.Reconsider the use of zend_form
//6.Messagebox for sucessful adding, editting and deleting
//7.Missing Paginator for displayAction
//8.Need to validate the deletion result
//Rewrite by meimo 2011.3.25
//Reviewed by rob 2011.3.28
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
    	$contacts = new Employee_Models_ContactMapper();
      	$this->view->entries = $contacts->fetchAll();
    }
    
    public function editAction()                                   //修改
    {
    	$editForm = new Employee_Forms_ContactSave();
    	$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');
    	$this->view->form = $editForm;
    	$this->view->id = $this->_getParam('id');
    	
    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$contactId = $this->_getParam('id');
    			$name = $editForm->getValue('name');	
    			$gender = $editForm->getValue('gender');
    			$birth = $editForm->getValue('birth');
    			$idCard = $editForm->getValue('idCard');
    			$phoneNo = $editForm->getValue('phoneNo');
    			$otherContact = $editForm->getValue('otherContact');
    			$address = $editForm->getValue('address');
    			$remark = $editForm->getValue('remark');
    			$emps = new Employee_Models_DbTable_Contact();
    			$emps->updateContact($contactId,$name,$gender,$birth,$idCard,$phoneNo,$otherContact,$address,$remark);    			
    			
    			
    			
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
    			    $emps = new Employee_Models_DbTable_Contact();
    				$editForm->populate($emps->getContact($id));
    				}
    				else
    				{
    					$this->_redirect('/employee');
    					}
    			}
    	}
    
    public function addAction()                       //新建
    {
        $editForm = new Employee_Forms_ContactSave();
        $editForm->submit->setLabel('保存继续新建');
        $editForm->submit2->setLabel('保存返回上页');
    	$tbId = $editForm->getElement('contactId');
    	$tbId->setValue('通讯录编号在保存新建后自动生成');
    	$this->view->form = $editForm;
    	
    	if($this->getRequest()->isPost())
    	{
    		$dec = $this->getRequest()->getPost('submit');
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$name = $editForm->getValue('name');
    			$gender = $editForm->getValue('gender');
    			$birth = $editForm->getValue('birth');
    			$idCard = $editForm->getValue('idCard');
    			$phoneNo = $editForm->getValue('phoneNo');
    			$otherContact = $editForm->getValue('otherContact');
    			$address = $editForm->getValue('address');
    			$remark = $editForm->getValue('remark');
    			    			
    			$contacts = new Employee_Models_DbTable_Contact();
    			$contacts->addContact($name,$gender,$birth,$idCard,$phoneNo,$otherContact,$address,$remark);   
    			if($dec == '保存继续新建')
    			{
   					$editForm->getElement('name')->setValue('');
   					$editForm->getElement('gender')->setValue('');
   					$editForm->getElement('birth')->setValue('');
   					$editForm->getElement('idCard')->setValue('0');
   					$editForm->getElement('phoneNo')->setValue('0');
   					$editForm->getElement('otherContact')->setValue('');
					$editForm->getElement('address')->setValue('');
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
    
    public function ajaxdeleteAction()                //删除
    {
        $this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$id=$this->_getParam('id',0);
    	if($id >0)
    	{
    		$contacts = new Employee_Models_DbTable_Contact();
    		$contacts->deleteContact($id);
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
   	public function ajaxdisplayAction()              //浏览
   	{
   		$this->_helper->layout()->disableLayout();
   		$id=$this->_getParam('id',0);
    	if($id >0)
    	{
   		    $contacts = new Employee_Models_DbTable_Contact();
   			$contact = $contacts->getContact($id);
   			$this->view->contact = $contact;
   			}
    		else
    		{
   				$this->_redirect('/employee');
   				}
   		}
}
?>