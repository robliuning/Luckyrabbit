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


class Vehicle_VehicleController extends Zend_Controller_Action
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
    	$vehicle = new Application_Model_VehicleMapper();
      	$this->view->entries = $vehicle->fetchAll();
    }
    
    
    public function editAction()                                       //修改
    {
    	$editForm = new Vehicle_Form_VehicleSave();
    	$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');
    	$this->view->form = $editForm;
    //	$this->view->id = $this->_getParam('id');
    	
    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$plateNo = $this->_getValue('plateNo');
    			$name = $editForm->getValue('name');
    			$license = $editForm->getValue('license');
    			$personIC = $editForm->getValue('personIC');
    			$users = $editForm->getValue('users');
    			$fuelCons = $editForm->getValue('fuelCons');
    			$remark = $editForm->getValue('remark');
    			    			
    			$vehs = new Application_Model_DbTable_Vehicle();
    			$vehs->updatevehicle($plateNo,$name,$license,$personIC,$users,$fuelCons,$remark);    			
    			
    			
    			
    			$this->_redirect('/vehicle/Vehicle');
    			}
    			else
    			{
    				$editForm->populate($formData);
    				}
    		}
   		else
    		{
    			$id=$this->_getValue('plateNo');
    			if($id != null)
    			{
    			    $vehs = new Application_Model_DbTable_Vehicle();
    				$editForm->populate($vehs->getVehicle($plateNo));
    				}
    				else
    				{
    					$this->_redirect('/vehicle/Vehicle');
    					}
    			}  

    	}
    
    public function addAction()                                      //新建
    {
        $editForm = new Vehicle_form_VehicleSave();
        $editForm->submit->setLabel('保存继续新建');
        $editForm->submit2->setLabel('保存返回上页');
    	$tbId = $editForm->getElement('plateNo');
    	$tbId->setValue('车辆信息在保存新建后自动生成');
    	$this->view->form = $editForm;
    	
    	if($this->getRequest()->isPost())
    	{
    		$dec = $this->getRequest()->getPost('submit');
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$plateNo = $editForm->getValue('plateNo');
    			$name = $editForm->getValue('name');
    			$license = $editForm->getValue('license');
    			$personIC = $editForm->getValue('personIC');
    			$users = $editForm->getValue('users');
    			$fuelCons = $editForm->getValue('fuelCons');
    			$remark = $editForm->getValue('remark');
    			    			
    			$vehs = new Application_Model_DbTable_Vehicle();
    			$vehs->addVehicle($plateNo,$name,$license,$personIC,$users,$fuelCons,$remark);   
    			if($dec == '保存继续新建')
    			{
   					$editForm->getElement('plateNo')->setValue('');
   					$editForm->getElement('name')->setValue('');
   					$editForm->getElement('license')->setValue('0');
   					$editForm->getElement('personIC')->setValue('0');
   					$editForm->getElement('users')->setValue('');
   					$editForm->getElement('fuelCons')->setValue('');
   					$editForm->getElement('remark')->setValue('');
   					}
   					else
    				{
    					$this->_redirect('/vehicle/Vehicle');
    					} 			
    			}
    			else
    			{
    				$editForm->populate($formData);
    				}
    		}
    }
    
    public function ajaxdeleteAction()                                     //删除
    {
        $this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$id=$this->_getValue('plateNo');
    	if($id != null)
    	{
    		$vehs = new Application_Model_DbTable_Vehicle();
    		$vehs->deleteVehicle($id);
    		echo "1";
    		}
    		else
    		{ 
    			$this->_redirect('/vehicle/Vehicle');
    			} 
    }
   	
   	public function searchAction()
   	{
   	
   	}
   	public function displayAction()                                       //浏览
   	{
   		$this->_helper->layout()->disableLayout();
   		$id=$this->_getValue('plateNo');
    	if($id != null)
    	{
   		    $vehs = new Application_Model_DbTable_Vehicle();
   			$veh = $vehs->getVehicle($id);
   			$this->view->vehicle = $veh;
   			}
    		else
    		{  
   				$this->_redirect('/vehicle/Vehicle');
   				}
   		}
}
?>