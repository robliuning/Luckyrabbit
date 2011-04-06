<?php
//Author Rob
//2011.4.6

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
    	$contacts = new Employee_Models_ContactMapper();
      	$this->view->arrayContacts = $contacts->fetchAll();
    }
    
    public function editAction()                                  
    {
    	$editForm = new Employee_Forms_ContactSave();
    	$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');
	
		$contacts = new Employee_Models_ContactMapper()
		$contacts->populateContactDd($editForm);
		$contactId = $this->_getParam('id',0)
    	
    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$contact = new Employee_Models_Contact();
    			$contact->setName($editForm->getValue('name'));
    			$contact->setGender($editForm->getValue('gender'));
    			$contact->setTitleName($editForm->getValue('titleName'));
    			$contact->setBirth($editForm->getValue('birth'));
    			$contact->setIdCard($editForm->getValue('idCard'));
    			$contact->setPhoneNo($editForm->getValue('phoneNo'));
    			$contact->setOtherContact($editForm->getValue('otherContact'));
    			$contact->setAddress($editForm->getValue('adress'));
    			$contact->setRemark($editForm->getValue('remark'));
    			$contacts->save($contact);    			
    			
    			$this->_redirect('/employee');
    			}
    			else
    			{
    				$editForm->populate($formData);
    				}
    		}
    		else
    		{
    			if($contactId >0)
    			{
    				$arrayContact = $contacts->findArrayContact($contactId);
    				$editForm->populate($arrayContact);
    				}
    				else
    				{
    					$this->_redirect('/employee');
    					}
    			}
    	$this->view->editForm = $editForm;
    	$this->view->id = $contactId;
    	}
    
    public function addAction()                       //新建
    {
        $addForm = new Employee_Forms_ContactSave();
        $addForm->submit->setLabel('保存继续新建');
        $addForm->submit2->setLabel('保存返回上页');
        
        //populate ddb
    	$contacts=new Employee_Models_DbTable_Contact();
    	$contacts->populateContactDd($addForm);
   
    	$tbId = $addForm->getElement('contactId');
    	$tbId->setValue('通讯录编号在保存新建后自动生成');
    	$this->view->form = $addForm;
    	
    	if($this->getRequest()->isPost())
    	{
    		$dec = $this->getRequest()->getPost('submit');
    		$formData = $this->getRequest()->getPost();
    		if($addForm->isValid($formData))
    		{
    			$name = $addForm->getValue('name');
    			$gender = $addForm->getValue('gender');
       			$titleName = $addForm->getValue('titleName');
    			$birth = $addForm->getValue('birth');
    			$idCard = $addForm->getValue('idCard');
    			$phoneNo = $addForm->getValue('phoneNo');
    			$otherContact = $addForm->getValue('otherContact');
    			$address = $addForm->getValue('address');
    			$remark = $addForm->getValue('remark');
    			    			
    			$contacts = new Employee_Models_DbTable_Contact();
    			$contacts->addContact($name,$gender,$titleName,$birth,$idCard,$phoneNo,$otherContact,$address,$remark);   
    			if($dec == '保存继续新建')
    			{
   					$addForm->getElement('name')->setValue('');
   					$addForm->getElement('gender')->setValue('');
   					$addForm->getElement('titleName')->setValue('');
   					$addForm->getElement('birth')->setValue('');
   					$addForm->getElement('idCard')->setValue('0');
   					$addForm->getElement('phoneNo')->setValue('0');
   					$addForm->getElement('otherContact')->setValue('');
					$addForm->getElement('address')->setValue('');
   					$addForm->getElement('remark')->setValue('');
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