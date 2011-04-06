<?php
//Author Rob
//2011.4.6
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
    
    public function addAction()                       
    {
        $addForm = new Employee_Forms_ContactSave();
        $addForm->submit->setLabel('保存继续新建');
        $addForm->submit2->setLabel('保存返回上页');
        
    	$contacts=new Employee_Models_ContactMapper();
    	$contacts->populateContactDd($addForm);
   
    	$tbId = $addForm->getElement('contactId');
    	$tbId->setValue('通讯录编号在保存新建后自动生成');
    	    	
    	if($this->getRequest()->isPost())
    	{
    		$btClicked = $this->getRequest()->getPost('submit');
    		$formData = $this->getRequest()->getPost();
    		if($addForm->isValid($formData))
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
    			
    			if($btClicked == '保存继续新建')
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
        	
        $this->view->form = $addForm;
    }
    
    public function ajaxdeleteAction()               
    {
        $this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    
   		$contactId = $this->_getParam('id',0);
    	if($contactId >0)
    	{
    		$contacts = new Employee_Models_ContactMapper();
    		$contacts->delete($contactId);
    		echo "1";//Missing validate if deletion succeed.
    		}
    		else
    		{
    			$this->_redirect('/employee');
    			}
    }
   	
   	public function searchAction()
   	{
   	
   	}
   	public function ajaxdisplayAction()              
   	{
   		$this->_helper->layout()->disableLayout();
   		$contactId = $this->_getParam('id',0);
    	if($contactId >0)
    	{
   		    $contacts = new Employee_Models_ContactMapper();
   		    $contact = new Employee_Models_Contact();
   			$contact = $contacts->find($contactId,$contact);
   			$this->view->contact = $contact;
   			}
    		else
    		{
   				$this->_redirect('/employee');
   				}
   		}
}
?>