<?php
//updated in 8th June 2011 by rob

class Employee_Models_ContactMapper
{
	protected $_dbTable;
	
	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}

	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->setDbTable('Employee_Models_DbTable_Contact');
		}
		return $this->_dbTable;
	}

	public function save(Employee_Models_Contact $contact)
	{
		$data = array(
			'contactId' => $contact->getContactId(),
			'name' => $contact->getName(),
			'gender' => $contact->getGender(),
 			'titleName' => $contact->getTitleName(),
			'birth' => $contact->getBirth(),
			'titleSpec' => $contact->getTitleSpec(),
			'deptName' => $contact->getDeptName(),
			'dutyName' => $contact->getDutyName(),
			'edu' => $contact->getEdu(),
			'enroll' => $contact->getEnroll(),
			'political' => $contact->getPolitical(),
			'idCard' => $contact->getIdCard(),
			'ethnic' => $contact->getEthnic(),
			'address' => $contact->getAddress(),
			'zip' => $contact->getZip(),
			'phoneHome' => $contact->getPhoneHome(),
			'phoneMob' => $contact->getPhoneMob(),
			'residence' => $contact->getResidence(),
			'probStart' => $contact->getProbStart(),
			'probEnd' => $contact->getProbEnd(),
			'profile' => $contact->getProfile(),
			'security' => $contact->getSecurity(),
			'secIn' => $contact->getSecIn(),
			'secDate' => $contact->getSecDate(),
			'medical' => $contact->getMedical(),
			'relation1' => $contact->getRelation1(),
			'name1' => $contact->getName1(),
			'company1' => $contact->getCompany1(),
			'address1' => $contact->getAddress1(),
			'phone1' => $contact->getPhone1(),
			'relation2' => $contact->getRelation2(),
			'name2' => $contact->getName2(),
			'company2' => $contact->getCompany2(),
			'address2' => $contact->getAddress2(),
			'phone2' => $contact->getPhone2(),
			'relation3' => $contact->getRelation3(),
			'name3' => $contact->getName3(),
			'company3' => $contact->getCompany3(),
			'address3' => $contact->getAddress3(),
			'phone3' => $contact->getPhone3(),
			'relation4' => $contact->getRelation4(),
			'name4' => $contact->getName4(),
			'company4' => $contact->getCompany4(),
			'address4' => $contact->getAddress4(),
			'phone4' => $contact->getPhone4(),
			'remark' => $contact->getRemark()
		);
		if (null === ($id = $contact->getContactId())) {
			unset($data['contactId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('contactId = ?' => $contact->getContactId()));
		}
	}

	public function find($contactId, Employee_Models_Contact $contact)
	{
		$result = $this->getDbTable()->find($contactId);

		if (0 == count($result)) {

			return;

		}

		$row = $result->current();

		$contact->setContactId($row->contactId)
				->setName($row->name)
				->setGender($row->gender)
				->setTitleName($row->titleName)
				->setBirth($row->birth)
				->setIdCard($row->idCard)
				->setPhoneHome($row->phoneHome)
				->setPhoneMob($row->phoneMob)
				->setAddress($row->address)
				->setZip($row->zip)
				->setEthnic($row->ethnic)
				->setPolitical($row->political)
				->setEnroll($row->enroll)
				->setEdu($row->edu)
				->setDutyName($row->dutyName)
				->setDeptName($row->deptName)
				->setTitleSpec($row->titleSpec)
				->setRemark($row->remark)
				->setCTime($row->cTime);

		$age = $this->caculateAge($contact->getBirth());
		$contact->setAge($age);
	}
	
	public function findComplete($contactId,Employee_Models_Contact $contact)
	{
		$result = $this->getDbTable()->find($contactId);

		if (0 == count($result)) {

			return;

		}

		$row = $result->current();

		$contact->setContactId($row->contactId)
				->setName($row->name)
				->setGender($row->gender)
				->setTitleName($row->titleName)
				->setBirth($row->birth)
				->setIdCard($row->idCard)
				->setPhoneHome($row->phoneHome)
				->setPhoneMob($row->phoneMob)
				->setAddress($row->address)
				->setZip($row->zip)
				->setEthnic($row->ethnic)
				->setPolitical($row->political)
				->setEnroll($row->enroll)
				->setEdu($row->edu)
				->setDutyName($row->dutyName)
				->setDeptName($row->deptName)
				->setTitleSpec($row->titleSpec)
				->setRemark($row->remark)
				->setCTime($row->cTime)
				->setResidence($row->residence)
				->setProbStart($row->probStart)
				->setProbEnd($row->probEnd)
				->setProfile($row->profile)
				->setSecurity($row->security)
				->setSecIn($row->secIn)
				->setSecDate($row->secDate)
				->setMedical($row->medical)
				->setRelation1($row->relation1)
				->setName1($row->name1)
				->setCompany1($row->company1)
				->setAddress1($row->address1)
				->setPhone1($row->phone1)
				->setRelation2($row->relation2)
				->setName2($row->name2)
				->setCompany2($row->company2)
				->setAddress2($row->address2)
				->setPhone2($row->phone2)
				->setRelation3($row->relation3)
				->setName3($row->name3)
				->setCompany3($row->company3)
				->setAddress3($row->address3)
				->setPhone3($row->phone3)
				->setRelation4($row->relation4)
				->setName4($row->name4)
				->setCompany4($row->company4)
				->setAddress4($row->address4)
				->setPhone4($row->phone4);

		$age = $this->caculateAge($contact->getBirth());
		$contact->setAge($age);
	}
	
	public function findArrayContact($id)
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('contactId = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
		}

	public function findContactName($id)
	{
		$arrayNames = $this->getDbTable()->findContactName($id);
		
		$name = $arrayNames[0]->name;
		
		return $name;
		}

	public function findContactNames($key)
	{
		$arrayNames = $this->getDbTable()->findContactNames($key);
		
		$entries = array();
		
		$i = 0;
		
		foreach($arrayNames as $name)
		{
			$entries[$i]['name'] = $name->name;
			$entries[$i]['contactId'] = $name->contactId;
			$entries[$i]['gender'] = $name->gender;
			$entries[$i]['titleName'] = $name->titleName;
			$i++;
			if($i == 12)
			{
				break;
				}
			}
		
		return $entries;
		}

	public function fetchAllJoin($key = null,$condition = null) 
	{
		if($condition == null)
		{
			$resultSet = $this->getDbTable()->fetchAll();
			}
			else
			{
				$resultSet = $this->getDbTable()->search($key,$condition);
				}

		$entries= array();

		foreach ($resultSet as $row) {
			$entry = new Employee_Models_Contact();
			$entry ->setContactId($row->contactId)
				->setName($row->name)
				->setDeptName($row->deptName)
				->setDutyName($row->dutyName)
				->setGender($row->gender)
				->setBirth($row->birth)
				->setPhoneHome($row->phoneHome)
				->setPhoneMob($row->phoneMob);
			$age = $this->caculateAge($entry->getBirth());
			$entry->setAge($age);
			$entries[] = $entry;
		}
		return $entries;
	}

	public function delete($id)
	{ 	
		$this->getDbTable()->delete('contactId = ' . (int)$id);
		}

	public function populateContactDd($form)
	{
		$depts = new General_Models_DeptMapper();
		$arrayDepts = $depts->fetchAll(); 
		$duties = new General_Models_DutyMapper();
		$arrayDuties = $duties->fetchAll();

		foreach($arrayDepts as $dept)
		{
			$form->getElement('deptName')->addMultiOption($dept->getName(),$dept->getName());
			}
		foreach($arrayDuties as $duty)
		{
			$form->getElement('dutyName')->addMultiOption($duty->getName(),$duty->getName());
			}
		}

	public function caculateAge($birth)
	{
		$strtimes = explode(" ",$birth);
		$timearray = explode("-",$strtimes[0]);
		$birthYear = $timearray[0];
		$thisYear = date('Y');
		$age = $thisYear - $birthYear;
		return $age;
		}
	
	public function formValidator($form,$formType)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('name')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('birth')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('edu')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('enroll')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('political')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('phoneMob')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('birth')->addValidator($dateValidator);
		$form->getElement('enroll')->addValidator($dateValidator);
		$form->getElement('probStart')->addValidator($dateValidator);
		$form->getElement('probEnd')->addValidator($dateValidator);
		$form->getElement('secDate')->addValidator($dateValidator);
		
		return $form;
	}
	
	public function dataValidator($formData,$formType)
	{
		$errorMsg = null;
		$trigger = 0;

		$dateStart = new Zend_Date($formData['probStart'],'YYYY-MM-DD');
		$dateEnd = new Zend_Date($formData['probEnd'],'YYYY-MM-DD');
		
		if($dateStart->isLater($dateEnd))
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_date_startEndError."<br/>".$errorMsg;
			}
			
		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
	}
}
?>