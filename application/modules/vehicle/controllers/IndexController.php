<?php
//updated on 14th May By Rob
class Vehicle_IndexController extends Zend_Controller_Action
{
	public function init()
	{
		/* Initialize action controller here */
	}
	
	public function preDispatch()
	{
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
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition = $formData['condition'];
				$arrayVehicles = $vehicles->fetchAllJoin($key,$condition);
				if(count($arrayVehicles) == 0)
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
		$this->view->module = "vehicle";
		$this->view->controller = "index";
		$this->view->modelName = "车辆信息";
		}
	
	public function addAction()
	{
		$addForm = new Vehicle_Forms_VehicleSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$vehicles = new Vehicle_Models_VehicleMapper();
		$addForm = $vehicles->formValidator($addForm,0);

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $vehicles->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$vehicle = new Vehicle_Models_Vehicle();
					$vehicle->setPlateNo($addForm->getValue('plateNo'));
					$vehicle->setName($addForm->getValue('name'));
					$vehicle->setColor($addForm->getValue('color'));
					$vehicle->setLicense($addForm->getValue('license'));
					$vehicle->setContactId($addForm->getValue('contactId'));
					$vehicle->setPilot($addForm->getValue('pilot'));
					$vehicle->setUser($addForm->getValue('user'));
					$vehicle->setFuelCons($addForm->getValue('fuelCons'));
					$vehicle->setPDate($addForm->getValue('pDate'));
					$vehicle->setPrice($addForm->getValue('price'));
					$vehicle->setBrand($addForm->getValue('brand'));
					$vehicle->setRemark($addForm->getValue('remark'));
					$vehicles->save($vehicle);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
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
				else
				{
					$addForm->populate($formData);
					}
			}
			$this->view->errorMsg = $errorMsg;
			$this->view->addForm = $addForm;
		}
	
	public function editAction()
	{
		$veId = $this->_getParam('id',0);
		$editForm = new Vehicle_Forms_VehicleSave();
		$vehicles = new Vehicle_Models_VehicleMapper();
		$editForm->submit->setLabel('保存修改');

		$editForm->submit2->setAttrib('class','hide');
		$plateNoEl = $editForm->getElement('plateNo');
		$plateNoEl->setAttrib('disabled','disabled');
		$plateNo = $vehicles->findPlateNo($veId);
		$plateNoEl->setValue($plateNo);

		$editForm = $vehicles->formValidator($editForm,1);

		$errorMsg = null;
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$array = $vehicles->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$vehicle = new Vehicle_Models_Vehicle();
					$vehicle->setVeId($veId);
					$vehicle->setPlateNo($plateNo);
					$vehicle->setName($editForm->getValue('name'));
					$vehicle->setColor($editForm->getValue('color'));
					$vehicle->setLicense($editForm->getValue('license'));
					$vehicle->setContactId($editForm->getValue('contactId'));
					$vehicle->setPilot($editForm->getValue('pilot'));
					$vehicle->setUser($editForm->getValue('user'));
					$vehicle->setFuelCons($editForm->getValue('fuelCons'));
					$vehicle->setPrice($editForm->getValue('price'));
					$vehicle->setBrand($editForm->getValue('brand'));
					$vehicle->setPDate($editForm->getValue('pDate'));
					$vehicle->setRemark($editForm->getValue('remark'));
					$vehicles->save($vehicle); 
					$this->_redirect('/vehicle');
					}
					else
					{
						$editForm->populate($formData);
						$plateNoEl->setValue($plateNo);
					}
				}
				else
				{
					$editForm->populate($formData);
					$plateNoEl->setValue($plateNo);
					}
			}
			else
			{
				if($veId > 0)
				{
					$arrayVehicle = $vehicles->findArrayVehicle($veId);
					$editForm->populate($arrayVehicle);
					}
					else
					{
						$this->_redirect('/vehicle');
						}
				}
		$this->view->errorMsg = $errorMsg;
		$this->view->editForm = $editForm;
		$this->view->id = $veId;
	}
	
	public function displayAction()
	{
		$vehicles = new Vehicle_Models_VehicleMapper();
		$veId = $this->_getParam('id',0);
		if($veId >0)
		{
			$vehicle = new Vehicle_Models_Vehicle();
			$vehicles->find($veId,$vehicle);
			
			$condition = 'veId';
			$drirecords = new Vehicle_Models_DrirecordMapper();
			$repairs = new Vehicle_Models_RepairMapper();
			$mtncs = new Vehicle_Models_MtncMapper();
			$verecords = new Vehicle_Models_VerecordMapper();
			
			$arrayDrirecords = $drirecords->fetchAllJoin($veId,$condition);
			$arrayRepairs = $repairs->fetchAllJoin($veId,$condition);
			$arrayMtncs = $mtncs->fetchAllJoin($veId,$condition);
			$arrayVerecords = $verecords->fetchAllJoin($veId,$condition);
			$this ->view->vehicle = $vehicle;
			$this ->view->arrayDrirecords = $arrayDrirecords;
			$this ->view->arrayRepairs = $arrayRepairs;
			$this ->view->arrayMtncs = $arrayMtncs;
			$this ->view->arrayVerecords = $arrayVerecords;
			}
			else
			{
				$this->_redirect('/vehicle');
				}
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
			try{
				$vehicles->delete($veId);
				echo "s";
				}
				catch(Exception $e)
				{
					echo "f";
					}
			}
			else
			{
				$this->_redirect('/vehicle');
				}
		}
}
?>