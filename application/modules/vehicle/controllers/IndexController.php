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
       $vehicles  = new Vehicle_Models_VehicleMapper();
	   $this -> view ->arrayVehicles = $vehicles -> fetchAllJoin();
    }
    
    public function addAction()                                        
    {
    	$addForm = new Vehicle_Forms_VehicleSave();
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
    					$this->_redirect('/Vehicle');
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
    			$vehicle->setPlateNo($addForm->getValue('plateNo'));
    			$vehicle->setName($addForm->getValue('name'));
    			$vehicle->setColor($addForm->getValue('color'));
    			$vehicle->setLicense($addForm->getValue('license'));
    			$vehicle->setContactId($addForm->getValue('contactId'));
    			$vehicle->setUser($addForm->getValue('user'));
    			$vehicle->setFuelCons($addForm->getValue('fuelCons'));
    			$vehicle->setRemark($addForm->getValue('remark'));    			
    			$Vehicles->save($Vehicle); 
    			 
    			$this->_redirect('/Vehicle');
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
    			    $arrayVehicle = $Vehicles->findArrayVehicle($veId);
    				$editForm->populate($arrayVehicle);
    				}
    				else
    				{
    					$this->_redirect('/Vehicle');
    					}
    			}		
    	$this->view->form = $editForm;
    	$this->view->id = $veId;     	
    }
    
   public function displayAction()                                                    
    {  
       $vehicles = new Vehicle_Models_VehicleMapper();
	   $veId = $this->_getParam('id',0);
	   if($VeId >0)
       {
       		$vehicles = new Vehicle_Models_VehicleMapper();
       		$vehicles->find($veId,$vehicles);   
	   		$this ->view->vehicle = $vehicle;      		
    		}
    		else
    		{
    			$this->_redirect('/Vehicle');
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
    			$this->_redirect('/Vehicle');
    			}
    	}
}
?>