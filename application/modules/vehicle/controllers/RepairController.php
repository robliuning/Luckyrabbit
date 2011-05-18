<?php
//updated on 14th May By Rob

class Vehicle_RepairController extends Zend_Controller_Action
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
		$repairs = new Vehicle_Models_RepairMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayRepairs = array();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition = $formData['condition'];
				$arrayRepairs = $repairs->fetchAllJoin($key,$condition);
				if(count($arrayRepairs) == 0)
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
			$arrayRepairs = $repairs->fetchAllJoin();
		}
		$this->view->arrayRepairs = $arrayRepairs;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "vehicle";
		$this->view->controller = "repair";
		$this->view->modelName = "车辆维修记录";
		}
	
	public function addAction()
	{
		$repairs = new Vehicle_Models_RepairMapper();
		$addForm = new Vehicle_Forms_RepairSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$repairs->populateVeDd($addForm);
		
		$addForm = $repairs->formValidator($addForm,0);
		
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			
			if($addForm->isValid($formData))
			{
				$array = $repairs->dataValidator($formData,null,$addForm->getValue('veId'),0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$repair = new Vehicle_Models_Repair();
					$repair->setVeId($addForm->getValue('veId'));
					$repair->setRDate($addForm->getValue('rDate'));
					$repair->setReason($addForm->getValue('reason'));
					$repair->setDetail($addForm->getValue('detail'));
					$repair->setContactId($addForm->getValue('contactId'));
					$repair->setSpot($addForm->getValue('spot'));
					$repair->setDescr($addForm->getValue('descr'));
					$repair->setAmount($addForm->getValue('amount'));
					$repair->setInsFlag($addForm->getValue('insFlag'));
					if($addForm->getValue('insFlag') == '1')
					{
						$repair->setIndem($addForm->getValue('indem'));
						}
						else
						{
							$repair->setIndem('');
							}
					$repair->setRemark($addForm->getValue('remark'));
					$repairs->save($repair);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						}
						else
						{
							$this->_redirect('/vehicle/repair');
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
		$editForm = new Vehicle_Forms_RepairSave();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$veId = $editForm->getElement('veId');
		$veId->setAttrib('disabled','disabled');

		$repId = $this->_getParam('id',0);
		$from = $this->_getParam('from',0);
		
		$repairs = new Vehicle_Models_RepairMapper();
		$repairs->populateVeDd($editForm);
		$vId = $repairs->findVeId($repId);
		
		$editForm = $repairs->formValidator($editForm,1);
		
		$errorMsg = null;
		$link = null;
		if($from == 0)
		{
			$link = "/vehicle/repair";
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
				$array = $repairs->dataValidator($formData,$repId,$vId,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$repair = new Vehicle_Models_Repair();
					$repair->setRepId($repId);
					$repair->setVeId($vId);
					$repair->setRDate($editForm->getValue('rDate'));
					$repair->setReason($editForm->getValue('reason'));
					$repair->setDetail($editForm->getValue('detail'));
					$repair->setContactId($editForm->getValue('contactId'));
					$repair->setSpot($editForm->getValue('spot'));
					$repair->setDescr($editForm->getValue('descr'));
					$repair->setAmount($editForm->getValue('amount'));
					$repair->setInsFlag($editForm->getValue('insFlag'));
					if($editForm->getValue('insFlag') == '1')
					{
						$repair->setIndem($editForm->getValue('indem'));
						}
						else
						{
							$repair->setIndem('');
							}
					$repair->setIndem($editForm->getValue('indem'));
					$repair->setRemark($editForm->getValue('remark'));
					$repairs->save($repair);
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
				if($repId > 0)
				{
					$arrayRepair = $repairs->findArrayRepair($repId);
					$editForm->populate($arrayRepair);
					}
					else
					{
						$this->_redirect($link);
						}
				}
		$this->view->errorMsg = $errorMsg;
		$this->view->editForm = $editForm;
		$this->view->id = $repId;
		$this->view->blink = $link;
	}
	
	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$repairs = new Vehicle_Models_RepairMapper();
		$repId = $this->_getParam('id',0);
		if($repId >0)
		{
			$repair = new Vehicle_Models_Repair();
			$repairs->findRepairJoin($repId,$repair);
			$this ->view->repair = $repair;
			}
			else
			{
				$this->_redirect('/vehicle/repair');
				}
		}

	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$repId = $this->_getParam('id',0);
		if($repId > 0)
		{
			$repairs = new Vehicle_Models_RepairMapper();
			try{
				$repairs->delete($repId);
				echo "s";
				}
				catch(Exception $e)
				{
					echo "f";
					}
			}
			else
			{
				$this->_redirect('/vehicle/repair');
				}
		}
}
?>