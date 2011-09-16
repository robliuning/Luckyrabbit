<?php
//updated on 14th May By Rob

class Vehicle_MtncController extends Zend_Controller_Action
{
	public function init()
	{
		/* Initialize action controller here */
		$this->view->module = "vehicle";
		$this->view->controller = "mtnc";
	}
	
	public function preDispatch()
	{
		$this -> view ->render("_sidebar.phtml");
	}

	public function indexAction() 
	{
		$mtncs = new Vehicle_Models_MtncMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayMtncs = array();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition = $formData['condition'];
				$arrayMtncs = $mtncs->fetchAllJoin($key,$condition);
				if(count($arrayMtncs) == 0)
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
			$arrayMtncs = $mtncs->fetchAllJoin();
		}
		if(count($arrayMtncs) != 0)
		{
			$pageNumber = $this->_getParam('page');
			$arrayMtncs->setCurrentPageNumber($pageNumber);
			$arrayMtncs->setItemCountPerPage('20');
			}
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayMtncs = $arrayMtncs;
		$this->view->errorMsg = $errorMsg;
		$this->view->modelName = "车辆保养记录";
		}
	
	public function addAction()
	{
		$mtncs = new Vehicle_Models_MtncMapper();
		$addForm = new Vehicle_Forms_MtncSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$mtncs->populateVeDd($addForm);
		
		$addForm = $mtncs->formValidator($addForm,0);
		
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			
			if($addForm->isValid($formData))
			{
				$array = $mtncs->dataValidator($formData,null,$addForm->getValue('veId'),0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$mtnc = new Vehicle_Models_Mtnc();
					$mtnc->setVeId($addForm->getValue('veId'));
					$mtnc->setRDate($addForm->getValue('rDate'));
					$mtnc->setDetail($addForm->getValue('detail'));
					$mtnc->setContactId($addForm->getValue('contactId'));
					$mtnc->setMile($addForm->getValue('mile'));
					$mtnc->setAmount($addForm->getValue('amount'));
					$mtnc->setRemark($addForm->getValue('remark'));
					$mtncs->save($mtnc);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						}
						else
						{
							$veId = new Vehicle_Models_VehicleMapper();
							$plateNo = $veId->findPlateNo($mtnc->getVeId());
							$this->_helper->flashMessenger->addMessage($plateNo.'创建成功。');
							$this->_redirect('/vehicle/mtnc');
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
		$editForm = new Vehicle_Forms_MtncSave();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$veId = $editForm->getElement('veId');
		$veId->setAttrib('disabled','disabled');

		$mtnId = $this->_getParam('id',0);
		$from = $this->_getParam('from',0);
		
		$mtncs = new Vehicle_Models_MtncMapper();
		$mtncs->populateVeDd($editForm);
		$vId = $mtncs->findVeId($mtnId);
		
		$editForm = $mtncs->formValidator($editForm,1);
		
		$errorMsg = null;
		$link = null;
		if($from == 0)
		{
			$link = "/vehicle/mtnc";
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
				$array = $mtncs->dataValidator($formData,$mtnId,$vId,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$mtnc = new Vehicle_Models_Mtnc();
					$mtnc->setMtnId($mtnId);
					$mtnc->setVeId($vId);
					$mtnc->setRDate($editForm->getValue('rDate'));
					$mtnc->setDetail($editForm->getValue('detail'));
					$mtnc->setContactId($editForm->getValue('contactId'));
					$mtnc->setMile($editForm->getValue('mile'));
					$mtnc->setAmount($editForm->getValue('amount'));
					$mtnc->setRemark($editForm->getValue('remark'));
					$mtncs->save($mtnc);
					$veId = new Vehicle_Models_VehicleMapper();
					$plateNo = $veId->findPlateNo($mtnc->getVeId());
					$this->_helper->flashMessenger->addMessage($plateNo.'修改成功。');
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
				if($mtnId > 0)
				{
					$arrayMtnc = $mtncs->findArrayMtnc($mtnId);
					$editForm->populate($arrayMtnc);
					}
					else
					{
						$this->_redirect($link);
						}
				}
		$this->view->errorMsg = $errorMsg;
		$this->view->editForm = $editForm;
		$this->view->id = $mtnId;
		$this->view->blink = $link;
	}
	
	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$mtncs = new Vehicle_Models_MtncMapper();
		$mtnId = $this->_getParam('id',0);
		if($mtnId >0)
		{
			$mtnc = new Vehicle_Models_Mtnc();
			$mtncs->findMtncJoin($mtnId,$mtnc);
			$this ->view->mtnc = $mtnc;
			}
			else
			{
				$this->_redirect('/vehicle/mtnc');
				}
		}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$mtnId = $this->_getParam('id',0);
		if($mtnId > 0)
		{
			$mtncs = new Vehicle_Models_MtncMapper();
			try{
				$mtncs->delete($mtnId);
				echo "s";
				}
				catch(Exception $e)
				{
					echo "f";
					}
			}
			else
			{
				$this->_redirect('/vehicle/mtnc');
				}
		}
}
?>