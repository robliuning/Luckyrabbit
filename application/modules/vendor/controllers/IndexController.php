<?php
//updated in 13th June by Rob

class Contract_IndexController extends Zend_Controller_Action
{
	public function init()
	{
		/*init*/
	}
	public function preDisPatch()
	{
		$this->view->render("_sidebar.phtml");
	}
	public function indexAction()
	{
		$contractors = new Contract_Models_ContractorMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayContractors = array();
			$key = trim($formData['key']);
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayContractors = $contractors->fetchAllJoin($key,$condition);
				if(count($arrayContractors) == 0)
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
			$arrayContractors = $contractors->fetchAllJoin();
		}
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayContractors = $arrayContractors;
		$this->view->errorMsg = $errorMsg;	
		$this->view->module = "contract";
		$this->view->controller = "index";
		$this->view->modelName = "承包商信息";
		}

	public function editAction()
	{
		$editForm = new Contract_Forms_ContractorSave();
		$editForm->submit->setLabel("保存修改");
		$editForm->submit2->setAttrib('class','hide');
		$contractors = new Contract_Models_ContractorMapper();
		$contractorId = $this->_getParam('id',0);
		$addForm = $contractors->formValidator($editForm,1);
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$contractor = new Contract_Models_Contractor();
				$contractor->setContractorId($contractorId);
				$contractor->setContact($editForm->getValue('contact'));
				$contractor->setName($editForm->getValue('name'));
				$contractor->setLicenseNo($editForm->getValue('licenseNo'));
				$contractor->setBusiField($editForm->getValue('busiField'));
				$contractor->setPhoneNo($editForm->getValue('phoneNo'));
				$contractor->setOtherContact($editForm->getValue('otherContact'));
				$contractor->setAddress($editForm->getValue('address'));
				$contractor->setRemark($editForm->getValue('remark'));
				$contractors->save($contractor);
				$this->_helper->flashMessenger->addMessage('对承包商:'.$contractor->getName().'的修改成功。');
				$this->_redirect('/contract');
				}
				else
				{
					$editForm->populate($formData);
					}
			}
			else
			{
				if($contractorId>0)
				{
					$arrayContractor = $contractors->findArrayContractor($contractorId);
					$editForm->populate($arrayContractor);
					}
					else
					{
						$this->_redirect('/contract/');
			 			}
				}
		$this->view->editForm = $editForm;
		$this->view->id = $contractorId;
	}

	public function addAction()
	{
		$addForm = new Contract_Forms_ContractorSave();
		$addForm->submit->setLabel("保存继续新建");
		$addForm->submit2->setLabel("保存返回上页");
		$errorMsg = null;
		$contractors = new Contract_Models_ContractorMapper();
		$addForm = $contractors->formValidator($addForm,0);

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $contractors->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$contractor = new Contract_Models_Contractor();
					$contractor->setName($addForm->getValue('name'));
					$contractor->setContact($addForm->getValue('contact'));
					$contractor->setLicenseNo($addForm->getValue('licenseNo'));
					$contractor->setBusiField($addForm->getValue('busiField'));
					$contractor->setPhoneNo($addForm->getValue('phoneNo'));
					$contractor->setOtherContact($addForm->getValue('otherContact'));
					$contractor->setAddress($addForm->getValue('address'));
					$contractor->setRemark($addForm->getValue('remark'));
					$contractors->save($contractor);
					$errorMsg = General_Models_Text::$text_save_success;
					$addForm->reset();
					if($btClicked=="保存返回上页")
					{
						$this->_helper->flashMessenger->addMessage('对承包商:'.$contractor->getName().'的修改成功。');
						$this->_redirect('/contract');
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
	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$contractorId = $this->_getParam('id',0);
		if($contractorId>0)
		{
			$contractors = new Contract_Models_ContractorMapper();
			try{
				$contractors->delete($contractorId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
		 $this->_redirect('/contract');
		}
	}

	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$contractorId = $this->_getParam('id',0);
		if($contractorId > 0)
		{
			$contractors = new Contract_Models_ContractorMapper();
			$contractor = new Contract_Models_Contractor();
			$contractors->find($contractorId,$contractor);
			
			$this->view->contractor = $contractor;
			}
			else
			{
				$this->_redirect('/contract');
				}
	}

	public function displayAction()
	{
		$contractors = new Contract_Models_ContractorMapper();
		$id = $this->_getParam('id',0);
		if($id >0)
		{
			$contract = new Contract_Models_Contractor();
			$contractors->find($id,$contract);
			$contrqualifs = new Contract_Models_ContrqualifMapper();
			$condition = 'contractorId';
			$arrayContrqualifs = $contrqualifs->fetchAllJoin($id,$condition);
			$this->view->arrayContrqualifs = $arrayContrqualifs;
			$this->view->contract = $contract;
			}
			else
			{
				$this->_redirect('/contract');
				}
		}
}