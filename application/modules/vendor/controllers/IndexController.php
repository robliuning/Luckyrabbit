<?php
//updated in 30th June by Rob

class Vendor_IndexController extends Zend_Controller_Action
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
		$expand = 0;
		$vendors = new Vendor_Models_VendorMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayVendors = array();
			$key = trim($formData['key']);
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayVendors = $vendors->fetchAllOrganize($key,$condition);
				if(count($arrayVendors) == 0)
				{
					$errorMsg = General_Models_Text::$text_searchErrorNr;
				}
			}
			else
			{
				$errorMsg = General_Models_Text::$text_searchErrorNi;
			}
			$expand = 1;
		}
		else
		{
			$arrayVendors = $vendors->fetchAllOrganize();
		}
		$this->view->expand = $expand;
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->view->arrayVendors = $arrayVendors;
		$this->view->errorMsg = $errorMsg;	
		$this->view->module = "vendor";
		$this->view->controller = "index";
		$this->view->modelName = "供应商管理";
		}

	public function editAction()
	{
		$editForm = new Vendor_Forms_VendorSave();
		$editForm->submit->setLabel("保存修改");
		$editForm->submit2->setAttrib('class','hide');
		$vendors = new Vendor_Models_VendorMapper();
		$vId = $this->_getParam('id',0);
		$vtypes = new General_Models_VtypeMapper();
		$vtypes->populateDd($editForm);
		$editForm = $vendors->formValidator($editForm,1);
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$vendor = new Vendor_Models_Vendor();
				$userId = $this->getUserId();
				$users = new System_Models_UserMapper();
				$contactId = $users->getContactId($userId); 
				$vendor->setVId($vId);
				$vendor->setContact($editForm->getValue('contact'));
				$vendor->setName($editForm->getValue('name'));
				$vendor->setTypeId($editForm->getValue('typeId'));
				$vendor->setBusiField($editForm->getValue('busiField'));
				$vendor->setPhoneNo($editForm->getValue('phoneNo'));
				$vendor->setOtherContact($editForm->getValue('otherContact'));
				$vendor->setAddress($editForm->getValue('address'));
				$vendor->setRemark($editForm->getValue('remark'));
				$vendor->setContactId($contactId);
				$vendors->save($vendor);
				$this->_helper->flashMessenger->addMessage('对供应商:'.$vendor->getName().'的修改成功。');
				$this->_redirect('/vendor');
				}
				else
				{
					$editForm->populate($formData);
					}
			}
			else
			{
				if($vId>0)
				{
					$arrayVendor = $vendors->findArrayVendor($vId);
					$editForm->populate($arrayVendor);
					}
					else
					{
						$this->_redirect('/vendor/');
						}
				}
		$this->view->editForm = $editForm;
		$this->view->id = $vId;
	}

	public function addAction()
	{
		$addForm = new Vendor_Forms_VendorSave();
		$addForm->submit->setLabel("保存继续新建");
		$addForm->submit2->setLabel("保存返回上页");
		$errorMsg = null;
		$vendors = new Vendor_Models_VendorMapper();
		$vtypes = new General_Models_VtypeMapper();
		$vtypes->populateDd($addForm);
		$addForm = $vendors->formValidator($addForm,0);

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $vendors->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$userId = $this->getUserId();
					$users = new System_Models_UserMapper();
					$contactId = $users->getContactId($userId); 
					$vendor = new Vendor_Models_Vendor();
					$vendor->setName($addForm->getValue('name'));
					$vendor->setContact($addForm->getValue('contact'));
					$vendor->setTypeId($addForm->getValue('typeId'));
					$vendor->setBusiField($addForm->getValue('busiField'));
					$vendor->setPhoneNo($addForm->getValue('phoneNo'));
					$vendor->setOtherContact($addForm->getValue('otherContact'));
					$vendor->setAddress($addForm->getValue('address'));
					$vendor->setRemark($addForm->getValue('remark'));
					$vendor->setContactId($contactId);
					$vendors->save($vendor);
					$errorMsg = General_Models_Text::$text_save_success;
					$addForm->reset();
					if($btClicked=="保存返回上页")
					{
						$this->_helper->flashMessenger->addMessage('对供应商:'.$vendor->getName().'的修改成功。');
						$this->_redirect('/vendor');
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
		$vId = $this->_getParam('id',0);
		if($vId>0)
		{
			$vendors = new Vendor_Models_VendorMapper();
			try{
				$vendors->delete($vId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
		}
		else
		{
		 $this->_redirect('/vendor');
		}
	}

	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$vId = $this->_getParam('id',0);
		if($vId > 0)
		{
			$vendors = new Vendor_Models_VendorMapper();
			$vendor = new Vendor_Models_Vendor();
			$vendors->find($vId,$vendor);
			
			$this->view->vendor = $vendor;
			}
			else
			{
				$this->_redirect('/vendor');
				}
	}

	public function displayAction()
	{
		$vendors = new Vendor_Models_VendorMapper();
		$id = $this->_getParam('id',0);
		if($id >0)
		{
			$vendor = new Vendor_Models_Vendor();
			$vendors->find($id,$vendor);
			$this->view->vendor = $vendor;
			}
			else
			{
				$this->_redirect('/vendor');
				}
	}
	
		
	protected function getUserId()
	{
		$userNamespace = new Zend_Session_Namespace('userNamespace');
		return $userNamespace->userId;
		}
}