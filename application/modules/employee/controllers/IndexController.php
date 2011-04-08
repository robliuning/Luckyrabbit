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
     
    public function addAction()                       
    {
        $addForm = new Employee_Forms_ContactSave();
        $addForm->submit->setLabel('保存继续新建');
        $addForm->submit2->setLabel('保存返回上页');
        
    	$contacts=new Employee_Models_ContactMapper();
    	$contacts->populateContactDd($addForm);
    	    	
    	if($this->getRequest()->isPost())
    	{
    		$btClicked = $this->getRequest()->getPost('submit');
    		$formData = $this->getRequest()->getPost();
    		if($addForm->isValid($formData))
    		{  			
    			$contact = new Employee_Models_Contact();
    			$contact->setName($addForm->getValue('name'));
    			$contact->setGender($addForm->getValue('gender'));
    			$contact->setTitleName($addForm->getValue('titleName'));
    			$contact->setBirth($addForm->getValue('birth'));
    			$contact->setIdCard($addForm->getValue('idCard'));
    			$contact->setPhoneNo($addForm->getValue('phoneNo'));
    			$contact->setOtherContact($addForm->getValue('otherContact'));
    			$contact->setAddress($addForm->getValue('adress'));
    			$contact->setRemark($addForm->getValue('remark'));
    			$contacts->save($contact);   
    			
    			if($btClicked == '保存继续新建')
    			{
   					$addForm->getElement('name')->setValue('');
   					$addForm->getElement('gender')->setValue('');
   					$addForm->getElement('titleName')->setValue('');
   					$addForm->getElement('birth')->setValue('');
   					$addForm->getElement('idCard')->setValue('');
   					$addForm->getElement('phoneNo')->setValue('');
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
        	
        $this->view->addForm = $addForm;
    }
         
    public function editAction()                                  
    {
    	$editForm = new Employee_Forms_ContactSave();
    	$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');
	
		$contacts = new Employee_Models_ContactMapper();
		$contacts->populateContactDd($editForm);
		$contactId = $this->_getParam('id',0);
    	
    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$contact = new Employee_Models_Contact();
    			$contact->setContactId($contactId);
    			$contact->setName($editForm->getValue('name'));
    			$contact->setGender($editForm->getValue('gender'));
    			$contact->setTitleName($editForm->getValue('titleName'));
    			$contact->setBirth($editForm->getValue('birth'));
    			$contact->setIdCard($editForm->getValue('idCard'));
    			$contact->setPhoneNo($editForm->getValue('phoneNo'));
    			$contact->setOtherContact($editForm->getValue('otherContact'));
    			$contact->setAddress($editForm->getValue('address'));
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
   	
   	public function autocompleteAction()
   	{
   	    $this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    	$key = $this->_getParam('key');
    	$contacts = new Employee_Models_ContactMapper();
    	$arrayNames = $contacts->findContactNames($key);
    	
    	echo $key;
   		}
   	
   	public function searchAction()
   	{
   	//get search key
   	
   	}
   	public function ajaxdisplayAction()              
   	{
   		$this->_helper->layout()->disableLayout();
   		$contactId = $this->_getParam('id',0);
    	if($contactId >0)
    	{
   		    $contacts = new Employee_Models_ContactMapper();
   		    $contact = new Employee_Models_Contact();
   			$contacts->find($contactId,$contact);
   			$this->view->contact = $contact;
   			}
    		else
    		{
   				$this->_redirect('/employee');
   				}
   		}
}
?>