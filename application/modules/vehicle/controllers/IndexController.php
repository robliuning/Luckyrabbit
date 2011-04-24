<?php
//Author: Rob
//Date: 2011.4.9


class Vehicle_IndexController extends Zend_Controller_Action
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
		$vehicles = new Vehicle_Models_VehicleMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayVehicles = array();
			$key = $formData['key'];
			if($key!=null)
			{
				$condition = $formData['condition'];
				$arrayVehicles = $vehicles->fetchAllJoin($key,$condition);
				if(count($arrayVehicles)==0)
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
			$arrayVehicles = $vehicles->fetchAllJoin();
		}
		$this->view->arrayVehicles = $arrayVehicles;
		$this->view->errorMsg = $errorMsg;   
		}
    
    public function addAction()                                        
    {
    	$addForm = new Vehicle_Forms_vehicleSave();
        $addForm->submit->setLabel('保存继续新建');
        $addForm->submit2->setLabel('保存返回上页');
        
		$vehicles = new Vehicle_Models_VehicleMapper();
	    	
    	if($this->getRequest()->isPost())
    	{
    		$btClicked = $this->getRequest()->getPost('submit');
    		$formData = $this->getRequest()->getPost();
    		if($addForm->isValid($formData))
    		{
    			$vehicle = new Vehicle_Models_Vehicle();
    			$vehicle->setPlateNo($addForm->getValue('plateNo'));
    			$vehicle->setName($addForm->getValue('name'));
    			$vehicle->setColor($addForm->getValue('color'));
    			$vehicle->setLicense($addForm->getValue('license'));
    			$vehicle->setContactId($addForm->getValue('contactId'));
    			$vehicle->setUser($addForm->getValue('user'));
    			$vehicle->setFuelCons($addForm->getValue('fuelCons'));
    			$vehicle->setRemark($addForm->getValue('remark'));
    			$vehicles->save($vehicle);   
    			
    			if($btClicked == '保存继续新建')
    			{
   					$addForm->getElement('name')->setValue('');
   					$addForm->getElement('plateNo')->setValue('');
   					$addForm->getElement('name')->setValue('');
   					$addForm->getElement('color')->setValue('');
   					$addForm->getElement('license')->setValue('');
   					$addForm->getElement('contactId')->setValue('');
						$addForm->getElement('user')->setValue('');
   					$addForm->getElement('fuelCons')->setValue('');
						$addForm->getElement('remark')->setValue('');
   					}
   					else
    				{
    					$this->_redirect('/vehicle');
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
        $editForm = new Vehicle_Forms_VehicleSave();
    		$editForm->submit->setLabel('保存修改');
    		$editForm->submit2->setAttrib('class','hide');

				$vehicles = new Vehicle_Models_VehicleMapper();
		
		$veId = $this->_getParam('id',0); 
   	
    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$vehicle = new Vehicle_Models_Vehicle();
					$vehicle->setVeId($veId);
    			$vehicle->setPlateNo($editForm->getValue('plateNo'));
    			$vehicle->setName($editForm->getValue('name'));
    			$vehicle->setColor($editForm->getValue('color'));
    			$vehicle->setLicense($editForm->getValue('license'));
    			$vehicle->setContactId($editForm->getValue('contactId'));
    			$vehicle->setUser($editForm->getValue('user'));
    			$vehicle->setFuelCons($editForm->getValue('fuelCons'));
    			$vehicle->setRemark($editForm->getValue('remark'));    			
    			$vehicles->save($vehicle); 
    			 
    			$this->_redirect('/vehicle');
    			}
    			else
    			{
    				$editForm->populate($formData);
    				}
    		}
    		else
    		{
    			if($veId >0)
    			{
    			    $arrayVehicle = $vehicles->findArrayVehicle($veId);
    					$editForm->populate($arrayVehicle);
    				}
    				else
    				{
    					$this->_redirect('/vehicle');
    					}
    			}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $veId;     	
    }
    
   public function ajaxdisplayAction()                                                    
    {  
    	$this->_helper->layout()->disableLayout();
       	$vehicles = new Vehicle_Models_VehicleMapper();
	   		$veId = $this->_getParam('id',0);
	   	if($veId >0)
       	{
       		$vehicle = new Vehicle_Models_Vehicle();
       		$vehicles->find($veId,$vehicle);   
	   		$this ->view->vehicle = $vehicle;      		
    		}
    		else
    		{
    			$this->_redirect('/vehicle');
    			}
    	}
   
    public function ajaxdeleteAction()
    {
		$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$veId = $this->_getParam('id',0);
    	if($veId > 0)
    	{
    		$vehicles = new Vehicle_Models_VehicleMapper();
    		$vehicles->delete($veId);
    		echo "1";
    		}
    		else
    		{
    			$this->_redirect('/vehicle');
    			}
    	}
   public function ajaxdisplayAction()
    	{
    		$this->_helper->layout()->disableLayout();
				$this->_helper->viewRenderer->setNoRender(true);
				$veId = $this->_getParam('id',0);
					if($veId>0)
					{
			$vehicles = new Vehicle_Models_VehicleMapper();
			$vehicle = new Vehicle_Models_Vehicle();
			$vehicles->find($veId,$vehicle);
			$this->view->vehicle = $vehicle;
					}
				else
					{
            $this->_redirect('/vehicle');
					}
    		}
}
?>