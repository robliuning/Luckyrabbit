//add.phtml	
		<div class="p_msg">
			<h3></h3>
			<p class="errorMsg"><?php <-----------------------------------------------------here!
				if($this->errorMsg != null)
				{
					echo $this->errorMsg;
			 		}?>
			 		</p>
		</div>
//controller
    public function addAction()                       
    {
        $addForm = new Employee_Forms_ContactSave();
        $addForm->submit->setLabel('保存继续新建');
        $addForm->submit2->setLabel('保存返回上页');
        $errorMsg = null;<-----------------------------------------------------here!
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
    			$errorMsg = General_Models_Text::$text_save_success;   <-----------------------------------------------------here!
    			
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
        $this->view->errorMsg = $errorMsg;<-----------------------------------------------------here!
        $this->view->addForm = $addForm;
    }