<?php
//updated in 14th May by Rob
//updated in 13th June by Rob

class Vehicle_VerecordController extends Zend_Controller_Action
{
	public function init()
	{
		/* Initialize action controller here */
		$this->view->module = "vehicle";
		$this->view->controller = "verecord";
	}
	
	public function preDispatch()
	{
		$this -> view ->render("_sidebar.phtml");
	}

	public function indexAction()
	{
		$verecords = new Vehicle_Models_VerecordMapper();
		$errorMsg = null;
		$condition[0] = null;
		$condition[1] = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayVerecords = array();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition[1] = $formData['condition'];
				$arrayVerecords = $verecords->fetchAllJoin($key,$condition);
				if(count($arrayVerecords) == 0)
				{
					$errorMsg = General_Models_Text::$text_searchErrorNr;
				}
			}
			else
			{
				$errorMsg = General_Models_Text::$text_searchErrorNi;
			}
		}
		else
		{
			$arrayVerecords = $verecords->fetchAllJoin(null,$condition);
		}
		if(count($arrayVerecords) != 0)
		{
			$pageNumber = $this->_getParam('page');
			$arrayVerecords->setCurrentPageNumber($pageNumber);
			$arrayVerecords->setItemCountPerPage('20');
			}
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayVerecords = $arrayVerecords;
		$this->view->errorMsg = $errorMsg;
		$this->view->modelName = "车辆使用记录";
		}
	
	public function addAction()
	{
		$verecords = new Vehicle_Models_VerecordMapper();
		$addForm = new Vehicle_Forms_VerecordSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$verecords->populateVeDd($addForm);
		$addForm = $verecords->formValidator($addForm,0);
		
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			
			if($addForm->isValid($formData))
			{
				$array = $verecords->dataValidator($formData,null,$addForm->getValue('veId'),0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$verecord = new Vehicle_Models_Verecord();
					$verecord->setVeId($addForm->getValue('veId'));
					$verecord->setPrjFlag(0);
					$verecord->setProjectId(0);
					$verecord->setStartDate($addForm->getValue('startDate'));
					$verecord->setEndDate($addForm->getValue('endDate'));
					$verecord->setRoute($addForm->getValue('route'));
					$verecord->setMileBf($addForm->getValue('mileBf'));
					$verecord->setMileAf($addForm->getValue('mileAf'));
					$verecord->setPurpose($addForm->getValue('purpose'));
					$verecord->setUser($addForm->getValue('user'));
					$verecord->setMileRef($addForm->getValue('mileRef'));
					$verecord->setContactId($addForm->getValue('contactId'));
					$verecord->setAmount($addForm->getValue('amount'));
					$verecord->setRemark($addForm->getValue('remark'));
					$verecords->save($verecord);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						}
						else
						{
							$veId = new Vehicle_Models_VehicleMapper();
							$plateNo = $veId->findPlateNo($verecord->getVeId());
							$this->_helper->flashMessenger->addMessage($plateNo.'创建成功。');
							$this->_redirect('/vehicle/verecord');
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
		$editForm = new Vehicle_Forms_VerecordSave();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$veId = $editForm->getElement('veId');
		$veId->setAttrib('disabled','disabled');

		$recordId = $this->_getParam('id',0);
		$from = $this->_getParam('from',0);
		
		$verecords = new Vehicle_Models_VerecordMapper();
		$verecords->populateVeDd($editForm);
		$vId = $verecords->findVeId($recordId);
		
		$editForm = $verecords->formValidator($editForm,1);
		
		$errorMsg = null;
		$link = null;
		if($from == 0)
		{
			$link = "/vehicle/verecord";
			}
			elseif($from == 1)
			{
				$link = '"/vehicle/index/display/id/'.$vId.'"';
				}
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$array = $verecords->dataValidator($formData,$recordId,$vId,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$verecord = new Vehicle_Models_Verecord();
					$verecord->setrecordId($recordId);
					$verecord->setVeId($vId);
					$verecord->setPrjFlag(0);
					$verecord->setProjectId(0);
					$verecord->setStartDate($editForm->getValue('startDate'));
					$verecord->setEndDate($editForm->getValue('endDate'));
					$verecord->setRoute($editForm->getValue('route'));
					$verecord->setMileBf($editForm->getValue('mileBf'));
					$verecord->setMileAf($editForm->getValue('mileAf'));
					$verecord->setPurpose($editForm->getValue('purpose'));
					$verecord->setUser($editForm->getValue('user'));
					$verecord->setMileRef($editForm->getValue('mileRef'));
					$verecord->setContactId($editForm->getValue('contactId'));
					$verecord->setAmount($editForm->getValue('amount'));
					$verecord->setRemark($editForm->getValue('remark'));
					$veId = new Vehicle_Models_VehicleMapper();
					$plateNo = $veId->findPlateNo($verecord->getVeId());
					$this->_helper->flashMessenger->addMessage($plateNo.'修改成功。');
					$verecords->save($verecord);
					$this->_redirect($link);
					}
					else
					{
						$editForm->populate($formData);
						$veId->setValue($vId);
						}
				}
				else
				{
					$editForm->populate($formData);
					$veId->setValue($vId);
					}
			}
			else
			{
				if($recordId > 0)
				{
					$arrayVerecord = $verecords->findArrayVerecord($recordId);
					$editForm->populate($arrayVerecord);
					}
					else
					{
						$this->_redirect($link);
						}
				}
		$this->view->errorMsg = $errorMsg;
		$this->view->editForm = $editForm;
		$this->view->id = $recordId;
		$this->view->blink = $link;
	}
	
	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$verecords = new Vehicle_Models_VerecordMapper();
		$recordId = $this->_getParam('id',0);
		if($recordId >0)
		{
			$verecord = new Vehicle_Models_Verecord();
			$verecords->findVerecordJoin($recordId,$verecord);
			$this ->view->verecord = $verecord;
			}
			else
			{
				$this->_redirect('/vehicle/verecord');
				}
		}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$recordId = $this->_getParam('id',0);
		if($recordId > 0)
		{
			$verecords = new Vehicle_Models_VerecordMapper();
			try{
				$verecords->delete($recordId);
				echo "s";
				}
				catch(Exception $e)
				{
					echo "f";
					}
			}
			else
			{
				$this->_redirect('/vehicle/verecord');
				}
		}
}
?>