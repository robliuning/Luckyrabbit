<?php
//updated on 14th May By Rob

class Vehicle_DrirecordController extends Zend_Controller_Action
{
	public function init()
	{
		/* Initialize action controller here */
		$this->view->module = "vehicle";
		$this->view->controller = "drirecord";
	}
	
	public function preDispatch()
	{
		$this -> view ->render("_sidebar.phtml");
	}

	public function indexAction() 
	{
		$drirecords = new Vehicle_Models_DrirecordMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayDrirecords = array();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition = $formData['condition'];
				$arrayDrirecords = $drirecords->fetchAllJoin($key,$condition);
				if(count($arrayDrirecords) == 0)
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
			$arrayDrirecords = $drirecords->fetchAllJoin();
		}
		if(count($arrayDrirecords) != 0)
		{
			$pageNumber = $this->_getParam('page');
			$arrayDrirecords->setCurrentPageNumber($pageNumber);
			$arrayDrirecords->setItemCountPerPage('20');
			}
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayDrirecords = $arrayDrirecords;
		$this->view->errorMsg = $errorMsg;
		$this->view->modelName = "车辆行驶记录";
		}
	
	public function addAction()
	{
		$drirecords = new Vehicle_Models_DrirecordMapper();
		$addForm = new Vehicle_Forms_DrirecordSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$drirecords->populateVeDd($addForm);
		$drirecords->populateDate($addForm);
		
		$addForm = $drirecords->formValidator($addForm,0);
		
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			
			if($addForm->isValid($formData))
			{
				$array = $drirecords->dataValidator($formData,null,$addForm->getValue('veId'),0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$drirecord = new Vehicle_Models_Drirecord();
					$drirecord->setVeId($addForm->getValue('veId'));
					$drirecord->setRYear($addForm->getValue('rYear'));
					$drirecord->setRMonth($addForm->getValue('rMonth'));
					$drirecord->setMileEarly($addForm->getValue('mileEarly'));
					$drirecord->setMileEnd($addForm->getValue('mileEnd'));
					$drirecord->setRemark($addForm->getValue('remark'));
					$drirecords->save($drirecord);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						}
						else
						{
							$veId = new Vehicle_Models_VehicleMapper();
							$plateNo = $veId->findPlateNo($drirecord->getVeId());
							$this->_helper->flashMessenger->addMessage($plateNo.'创建成功。');
							$this->_redirect('/vehicle/drirecord');
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
		$editForm = new Vehicle_Forms_DrirecordSave();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$veId = $editForm->getElement('veId');
		$veId->setAttrib('disabled','disabled');

		$recordId = $this->_getParam('id',0);
		$from = $this->_getParam('from',0);
		
		$drirecords = new Vehicle_Models_DrirecordMapper();
		$drirecords->populateVeDd($editForm);
		$drirecords->populateDate($editForm);
		$vId = $drirecords->findVeId($recordId);
		
		$editForm = $drirecords->formValidator($editForm,1);
		
		$errorMsg = null;
		$link = null;
		if($from == 0)
		{
			$link = "/vehicle/drirecord";
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
				$array = $drirecords->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$drirecord = new Vehicle_Models_Drirecord();
					$drirecord->setRecordId($recordId);
					$drirecord->setVeId($vId);
					$drirecord->setRYear($editForm->getValue('rYear'));
					$drirecord->setRMonth($editForm->getValue('rMonth'));
					$drirecord->setMileEarly($editForm->getValue('mileEarly'));
					$drirecord->setMileEnd($editForm->getValue('mileEnd'));
					$drirecord->setRemark($editForm->getValue('remark'));
					$drirecords->save($drirecord);
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
					$arrayDrirecord = $drirecords->findArrayDrirecord($recordId);
					$editForm->populate($arrayDrirecord);
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
		$recordId = $this->_getParam('id',0);
		if($recordId >0)
		{
			$drirecords = new Vehicle_Models_DrirecordMapper();
			$drirecord = new Vehicle_Models_Drirecord();
			$drirecords->findDrirecordJoin($recordId,$drirecord);
			$this ->view->drirecord = $drirecord;
			}
			else
			{
				$this->_redirect('/vehicle/drirecord');
				}
		}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$recordId = $this->_getParam('id',0);
		if($recordId > 0)
		{
			$drirecords = new Vehicle_Models_DrirecordMapper();
			try{
				$drirecords->delete($recordId);
				echo "s";
				}
				catch(Exception $e)
				{
					echo "f";
					}
			}
			else
			{
				$this->_redirect('/vehicle/drirecord');
				}
		}
}
?>