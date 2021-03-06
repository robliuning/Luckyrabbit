<?php
//updated in 8th June 2011 by Rob

class Employee_IndexController extends Zend_Controller_Action
{
	public function init()
	{
		/* Initialize action controller here */
		$this->view->module = "employee";
		$this->view->controller = 'index';
	}
	
	public function preDispatch()
	{
		$this->view->render("_sidebar.phtml");
	}

	public function indexAction()
	{
		$errorMsg = null;
		$contacts = new Employee_Models_ContactMapper();
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayContacts = array();
			$key = trim($formData['key']);
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayContacts = $contacts->fetchAllJoin($key,$condition);
				if(count($arrayContacts) == 0)
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
			$arrayContacts = $contacts->fetchAllJoin();
			}
		$pageNumber = $this->_getParam('page');
		$arrayContacts->setCurrentPageNumber($pageNumber);
		$arrayContacts->setItemCountPerPage('20');
		$this->view->arrayContacts = $arrayContacts;
		$this->view->errorMsg = $errorMsg;
		$this->view->modelName = "公司员工信息";
	}
	
	public function addAction()
	{
		$addForm = new Employee_Forms_ContactSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$contacts=new Employee_Models_ContactMapper();
		$contacts->populateContactDd($addForm);
		$addForm = $contacts->formValidator($addForm,0);

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$array = $contacts->dataValidator($formData,0);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$contact = new Employee_Models_Contact();
					$contact->setName($addForm->getValue('name'));
					$contact->setGender($addForm->getValue('gender'));
					$contact->setBirth($addForm->getValue('birth'));
					$contact->setTitleName($addForm->getValue('titleName'));
					$contact->setTitleSpec($addForm->getValue('titleSpec'));
					$contact->setDeptName($addForm->getValue('deptName'));
					$contact->setDutyName($addForm->getValue('dutyName'));
					$contact->setEdu($addForm->getValue('edu'));
					$contact->setEnroll($addForm->getValue('enroll'));
					$contact->setPolitical($addForm->getValue('political'));
					$contact->setIdCard($addForm->getValue('idCard'));
					$contact->setEthnic($addForm->getValue('ethnic'));
					$contact->setAddress($addForm->getValue('address'));
					$contact->setZip($addForm->getValue('zip'));
					$contact->setPhoneHome($addForm->getValue('phoneHome'));
					$contact->setPhoneMob($addForm->getValue('phoneMob'));
					$contact->setResidence($addForm->getValue('residence'));
					$contact->setProbStart($addForm->getValue('probStart'));
					$contact->setProbEnd($addForm->getValue('probEnd'));
					$contact->setProfile($addForm->getValue('profile'));
					$contact->setSecurity($addForm->getValue('security'));
					$contact->setSecIn($addForm->getValue('secIn'));
					$contact->setSecDate($addForm->getValue('secDate'));
					$contact->setMedical($addForm->getValue('medical'));
					$contact->setRelation1($addForm->getValue('relation1'));
					$contact->setName1($addForm->getValue('name1'));
					$contact->setCompany1($addForm->getValue('company1'));
					$contact->setAddress1($addForm->getValue('address1'));
					$contact->setPhone1($addForm->getValue('phone1'));
					$contact->setRelation2($addForm->getValue('relation2'));
					$contact->setName2($addForm->getValue('name2'));
					$contact->setCompany2($addForm->getValue('company2'));
					$contact->setAddress2($addForm->getValue('address2'));
					$contact->setPhone2($addForm->getValue('phone2'));
					$contact->setRelation3($addForm->getValue('relation3'));
					$contact->setName3($addForm->getValue('name3'));
					$contact->setCompany3($addForm->getValue('company3'));
					$contact->setAddress3($addForm->getValue('address3'));
					$contact->setPhone3($addForm->getValue('phone3'));
					$contact->setRelation4($addForm->getValue('relation4'));
					$contact->setName4($addForm->getValue('name4'));
					$contact->setCompany4($addForm->getValue('company4'));
					$contact->setAddress4($addForm->getValue('address4'));
					$contact->setPhone4($addForm->getValue('phone4'));
					$contact->setRemark($addForm->getValue('remark'));
					$contacts->save($contact);
					$errorMsg = General_Models_Text::$text_save_success;
					if($btClicked == '保存继续新建')
					{
						$addForm->reset();
						}
						else
						{
							$this->_helper->flashMessenger->addMessage('对员工: '.$contact->getName().'的新建成功。');
							$this->_redirect('/employee');
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
		$errorMsg = null;
		$editForm = new Employee_Forms_ContactSave();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
	
		$contacts = new Employee_Models_ContactMapper();
		$contacts->populateContactDd($editForm);
		$contactId = $this->_getParam('id',0);
		$editForm = $contacts->formValidator($editForm,1);

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$array = $contacts->dataValidator($formData,1);
				$trigger = $array['trigger'];
				$errorMsg = $array['errorMsg'];
				if($trigger == 0)
				{
					$contact = new Employee_Models_Contact();
					$contact->setContactId($contactId);
					$contact->setName($editForm->getValue('name'));
					$contact->setGender($editForm->getValue('gender'));
					$contact->setBirth($editForm->getValue('birth'));
					$contact->setTitleName($editForm->getValue('titleName'));
					$contact->setTitleSpec($editForm->getValue('titleSpec'));
					$contact->setDeptName($editForm->getValue('deptName'));
					$contact->setDutyName($editForm->getValue('dutyName'));
					$contact->setEdu($editForm->getValue('edu'));
					$contact->setEnroll($editForm->getValue('enroll'));
					$contact->setPolitical($editForm->getValue('political'));
					$contact->setIdCard($editForm->getValue('idCard'));
					$contact->setEthnic($editForm->getValue('ethnic'));
					$contact->setAddress($editForm->getValue('address'));
					$contact->setZip($editForm->getValue('zip'));
					$contact->setPhoneHome($editForm->getValue('phoneHome'));
					$contact->setPhoneMob($editForm->getValue('phoneMob'));
					$contact->setResidence($editForm->getValue('residence'));
					$contact->setProbStart($editForm->getValue('probStart'));
					$contact->setProbEnd($editForm->getValue('probEnd'));
					$contact->setProfile($editForm->getValue('profile'));
					$contact->setSecurity($editForm->getValue('security'));
					$contact->setSecIn($editForm->getValue('secIn'));
					$contact->setSecDate($editForm->getValue('secDate'));
					$contact->setMedical($editForm->getValue('medical'));
					$contact->setRelation1($editForm->getValue('relation1'));
					$contact->setName1($editForm->getValue('name1'));
					$contact->setCompany1($editForm->getValue('company1'));
					$contact->setAddress1($editForm->getValue('address1'));
					$contact->setPhone1($editForm->getValue('phone1'));
					$contact->setRelation2($editForm->getValue('relation2'));
					$contact->setName2($editForm->getValue('name2'));
					$contact->setCompany2($editForm->getValue('company2'));
					$contact->setAddress2($editForm->getValue('address2'));
					$contact->setPhone2($editForm->getValue('phone2'));
					$contact->setRelation3($editForm->getValue('relation3'));
					$contact->setName3($editForm->getValue('name3'));
					$contact->setCompany3($editForm->getValue('company3'));
					$contact->setAddress3($editForm->getValue('address3'));
					$contact->setPhone3($editForm->getValue('phone3'));
					$contact->setRelation4($editForm->getValue('relation4'));
					$contact->setName4($editForm->getValue('name4'));
					$contact->setCompany4($editForm->getValue('company4'));
					$contact->setAddress4($editForm->getValue('address4'));
					$contact->setPhone4($editForm->getValue('phone4'));
					$contact->setRemark($editForm->getValue('remark'));
					$contacts->save($contact);
					$this->_helper->flashMessenger->addMessage('对员工: '.$contact->getName().'的修改成功。');
					$this->_redirect('/employee');
					}
					else
					{
						$editForm->populate($formData);
						}
				}
				else
				{
					$editForm->populate($formData);
					}
			}
			else
			{
				if($contactId >0)
				{
					$arrayContact = $contacts->findArrayContact($contactId);
					$editForm->populate($arrayContact);
					}
					else
					{
						$this->_redirect('/employee');
						}
				}
		$this->view->editForm = $editForm;
		$this->view->id = $contactId;
		}

	
	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$contactId = $this->_getParam('id',0);
		if($contactId >0)
		{
			$contacts = new Employee_Models_ContactMapper();
			try{
				$contacts->delete($contactId);
				echo "s";
				}
				catch(Exception $e)
				{
					echo "f";
					}
			}
			else
			{
				$this->_redirect('/employee');
				}
	}
	
	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$contactId = $this->_getParam('id',0);
		if($contactId >0)
		{
			$contacts = new Employee_Models_ContactMapper();
			$contact = new Employee_Models_Contact();
			$contacts->find($contactId,$contact);
			$this->view->contact = $contact;
			}
			else
			{
				$this->_redirect('/employee');
				}
		}
	
	public function displayAction()
	{
		$contacts = new Employee_Models_ContactMapper();
		$contactId = $this->_getParam('id',0);
		if($contactId >0)
		{
			$contact = new Employee_Models_Contact();
			$contacts->findComplete($contactId,$contact);
			$this->view->id = $contact->getContactId();
			$this ->view->contact = $contact;
			}
			else
			{
				$this->_redirect('/employee');
				}
	}
	
	public function autocompleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$key = $this->_getParam('key');
		$contacts = new Employee_Models_ContactMapper();
		$arrayNames = $contacts->findContactNames($key,0);
		$json = Zend_Json::encode($arrayNames);
		echo $json;
		}
		
	public function acregisterAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$key = $this->_getParam('key');
		$contacts = new Employee_Models_ContactMapper();
		$arrayNames = $contacts->findContactNames($key,1);
		$json = Zend_Json::encode($arrayNames);
		echo $json;
		}
	//pdf test
	public function ajaxpdfAction()
	{
		$this->_helper->layout()->disableLayout();
	//	$this->_helper->viewRenderer->setNoRender(true);
		
		$pdf = new Zend_Pdf();
		$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
		$font = Zend_Pdf_Font::fontWithPath('font/simkai.ttf',(Zend_Pdf_Font::EMBED_SUPPRESS_EMBED_EXCEPTION |
Zend_Pdf_Font::EMBED_DONT_COMPRESS));
		//put the personal information to the pdf
		$contacts = new Employee_Models_ContactMapper();
		$arrayContacts = $contacts->fetchAllJoin();
		$count = 1;//every page show approximately 20 pieces;
		//$arrayCount = count($arrayContacts);
		$totalItems = $arrayContacts->getTotalItemCount();
		$arrayContacts->setItemCountPerPage($totalItems);

		$pageNumber = ceil($totalItems / 25);
		$x = 0; $y = 750;
		$currentpage = 1;
		foreach($arrayContacts as $contact)
		{
			if($count == 1)
			{
				$page->setLineWidth(0.5);
				$page->drawLine(50, 770, 560, 770);
				$page->drawLine(50, 125, 560, 125);
				$page->setFont($font,13)
						->drawText("编号", 50, $y, 'UTF-8')
						->drawText("姓名", 100, $y, 'UTF-8')
						->drawText("性别", 145, $y, 'UTF-8')
						->drawText("生日", 195, $y, 'UTF-8')
						->drawText("部门", 275, $y, 'UTF-8')
						->drawText("职务", 335, $y, 'UTF-8')
						->drawText("入职时间", 415, $y, 'UTF-8')
						->drawText("手机号码", 495, $y, 'UTF-8');
				$time = Date("Y-m-d,H:i");
				$users = new System_Models_UserMapper();
				$contactId = $users->getContactId($this->getUserId());
				$contacts = new Employee_Models_ContactMapper();
				$contactName = $contacts->findContactName($contactId);
				$page->setFont($font,11)
						->drawText("公司员工信息总览", 250, 790, 'UTF-8')
						->drawText("导出人:".$contactName, 50, 100, 'UTF-8')
						->drawText("导出日期:".$time, 250, 100, 'UTF-8')
						->drawText("页数:".$currentpage."(".$pageNumber.")", 500, 100, 'UTF-8');
				}
				$y -= 25;$count++;
				$page->setFont($font, 11)
						->drawText($contact->contactId, $x+=50, $y, 'UTF-8')
						->drawText($contact->contactName, $x+=50, $y, 'UTF-8')
						->drawText($contact->gender, $x+=45, $y, 'UTF-8')
						->drawText($contact->birth, $x+=50, $y, 'UTF-8')
						->drawText($contact->deptName, $x+=80, $y, 'UTF-8')
						->drawText($contact->dutyName, $x+=60, $y, 'UTF-8')
						->drawText($contact->enroll, $x+=80, $y, 'UTF-8')
						->drawText($contact->phoneMob, $x+=80, $y, 'UTF-8');
			if($count >= 25)
			{
				$pdf->pages[] = $page;
				$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
				$count = 1;
				$y = 750;
				$currentpage++;
				}
			$x = 0;
			}
		$pdf->pages[] = $page;
		$name_string = "公司员工信息总览".time().".pdf";
		//server
		$base = General_Models_ServerInfo::$localUrl;
		$url = 'tmp/'.$name_string;
		$pdf->save($url);
		$murl = $base.'/'.$url;
		$this->view->murl = $murl;
		}
	
	protected function getUserId()
	{
		$userNamespace = new Zend_Session_Namespace('userNamespace');
		return $userNamespace->userId;
		}
}
?>