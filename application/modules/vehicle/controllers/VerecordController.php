<?php
//Author: Rob
//Date: 2011.4.9


class Vehicle_VerecordController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }
    
	public function preDispatch(){
	     $this -> view ->render("_sidebar.phtml");
	 }

    public function indexAction() 
    {	   
	   	$verecords = new Vehicle_Models_VerecordMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayVerecords = array();
			$key = $formData['key'];
			if($key!=null)
			{
				$condition = $formData['condition'];
				$arrayVerecords = $verecords->fetchAllJoin($key,$condition);
				if(count($arrayVerecords)==0)
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
			$arrayVerecords = $verecords->fetchAllJoin();
		}
		$this -> view ->arrayVerecords = $arrayVerecords;
		$this->view->errorMsg = $errorMsg;   
    }
    
    public function addAction()                                        
    {
    	$addForm = new Vehicle_Forms_VerecordSave();
        $addForm->submit->setLabel('保存继续新建');
        $addForm->submit2->setLabel('保存返回上页');
        
				$verecords = new Vehicle_Models_VerecordMapper();
				$verecords->populateVeDd($addForm);
	    	
    	if($this->getRequest()->isPost())
    	{
    		$btClicked = $this->getRequest()->getPost('submit');
    		$formData = $this->getRequest()->getPost();
    		if($addForm->isValid($formData))
    		{
    			$verecord = new Vehicle_Models_Verecord();
    			$verecord->setVeId($addForm->getValue('veId'));
    			$verecord->setStartDate($addForm->getValue('startDate'));
    			$verecord->setEndDate($addForm->getValue('endDate'));
    			$verecord->setPurpose($addForm->getValue('purpose'));
    			$verecord->setMile($addForm->getValue('mile'));
    			$verecord->setPilot($addForm->getValue('pilot'));
    			$verecord->setOtherUser($addForm->getValue('otherUser'));
    			$verecord->setRemark($addForm->getValue('remark'));
    			$verecords->save($verecord);   
    			
    			if($btClicked == '保存继续新建')
    			{
						$addForm->getElement('plateNo')->setValue('');
   					$addForm->getElement('veId')->setValue('');
    				$addForm->getElement('veId')->setValue('');
   					$addForm->getElement('startDate')->setValue('');
   					$addForm->getElement('endDate')->setValue('');
   					$addForm->getElement('purpose')->setValue('');
   					$addForm->getElement('mile')->setValue('');
						$addForm->getElement('pilot')->setValue('');
   					$addForm->getElement('otherUser')->setValue('');
						$addForm->getElement('remark')->setValue('');
   					}
   					else
    				{
    					$this->_redirect('/vehicle/verecord');
    					} 			
    			}
    			else
    			{
    				$addForm->populate($formData);
    				}
    		}
		    $this->view->addForm = $addForm;
    	}
    
    public function editAction()                                
    {
        $editForm = new Vehicle_Forms_VerecordSave();
    	$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');
    	
		$verecords = new vehicle_Models_VerecordMapper();
		
		$verecords->populateVeDd($editForm);
		
		$verecordId = $this->_getParam('id',0); 
   	
    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$verecord = new Vehicle_Models_Verecord();
				$verecord->setRecordId($verecordId);
    			$verecord->setVeId($editForm->getValue('veId'));
    			$verecord->setStartDate($editForm->getValue('startDate'));
    			$verecord->setEndDate($editForm->getValue('endDate'));
    			$verecord->setPurpose($editForm->getValue('purpose'));
    			$verecord->setMile($editForm->getValue('mile'));
    			$verecord->setPilot($editForm->getValue('pilot'));
    			$verecord->setOtherUser($editForm->getValue('otherUser'));
    			$verecord->setRemark($editForm->getValue('remark'));    			
    			$verecords->save($verecord); 
    			 
    			$this->_redirect('/vehicle/verecord');
    			}
    			else
    			{
    				$editForm->populate($formData);
    				}
    		}
    		else
    		{
    			if($verecordId >0)
    			{
    			    $arrayVerecord = $verecords->findArrayVerecord($verecordId);
    				$editForm->populate($arrayVerecord);
    				}
    				else
    				{
    					$this->_redirect('/verecord');
    					}
    			}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $verecordId;     	
    }
    
   public function ajaxdisplayAction()                                                    
    {  
    	$this->_helper->layout()->disableLayout();
        $verecords = new Vehicle_Models_VerecordMapper();
	    $verecordId = $this->_getParam('id',0);
	    if($verecordId >0)
        {
       		$verecord = new Vehicle_Models_Verecord();
       		$verecords->findVerecordJoin($verecordId,$verecord);   
	   		$this ->view->verecord = $verecord;      		
    		}
    /*		else
    		{
    			$this->_redirect('/verecord');
    			}*/
    	}
   
    public function ajaxdeleteAction()
    {
		$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   		$verecordId = $this->_getParam('id',0);
    	if($verecordId > 0)
    	{
    		$verecords = new verecord_Models_verecordMapper();
    		$verecords->delete($verecordId);
    		echo "1";
    		}
    		else
    		{
    			$this->_redirect('/vehicle/verecord');
    			}
    	}
   public function ajaxdisplayAction()
    	{
    		$this->_helper->layout()->disableLayout();
				$this->_helper->viewRenderer->setNoRender(true);
				$verecordId = $this->_getParam('id',0);
			if($verecordId>0)
			{
				$verecords = new Vehicle_Models_VerecordMapper();
				$verecord = new Vehicle_Models_Verecord();
				$verecords->find($verecordId,$verecord);
				$this->view->transfer = $verecord;
				}
			else
			{
            $this->_redirect('/vehicle/verecord');
			}
    		}
  /*  public function searchAction()
    {        
		$verecords = new Vehicle_Models_VerecordMapper();
	    	
    	if($this->getRequest()->isPost())
    	{	
    		
    		$this->view->arrayVerecords = $arrayVerecords;
    		}
    		else
    		{
    			
    				}
    		}
    	
    	}*/
}
?>