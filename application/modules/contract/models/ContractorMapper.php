<?php
//Updated in 13th June by Rob

class Contract_Models_ContractorMapper
{
	protected $_dbTable;
	
	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract){
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}

	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->setDbTable('Contract_Models_DbTable_Contractor');
		}
		return $this->_dbTable;
	}

	public function save(Contract_Models_Contractor $contractor)
	{
		$data = array(
			'contractorId' => $contractor->getContractorId(),
			'name' => $contractor->getName(),
			'contact' => $contractor->getContact(),
			'licenseNo' => $contractor->getLicenseNo(),
			'busiField' => $contractor->getBusiField(),
			'phoneNo' => $contractor->getPhoneNo(),
			'otherContact' => $contractor->getOtherContact(),
			'address' => $contractor->getAddress(),
			'remark' => $contractor->getRemark()
		);
		if (null === ($id = $contractor->getContractorId())){
			unset($data['contractorId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('contractorId = ?' => $contractor->getContractorId()));
		}
	}
 
 	public function find($id,Contract_Models_Contractor $contract) 
	{
		$resultSet = $this->getDbTable()->find($id);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();
		$contract->setContractorId($row->contractorId)
				->setName($row->name)
				->setContact($row->contact)
				->setLicenseNo($row->licenseNo)
				->setBusiField($row->busiField)
				->setPhoneNo($row->phoneNo)
				->setOtherContact($row->otherContact)
				->setAddress($row->address)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		}
	
	public function findById($id)
	{
		$resultSet = $this->getDbTable()->find($id);

		if (0 == count($resultSet)) {

			return;
		}
		$contract = new Contract_Models_Contractor();
		$row = $resultSet->current();
		$contract->setContractorId($row->contractorId)
				->setName($row->name)
				->setContact($row->contact)
				->setLicenseNo($row->licenseNo)
				->setPhoneNo($row->phoneNo)
				->setOtherContact($row->otherContact)
				->setAddress($row->address);
		return $contract;
		}
	public function delete($id)
	{
		$result = $this->getDbTable()->delete('contractorId = ' . (int)$id);
		return $result;	
		}

	public function fetchAllJoin($key=null,$condition=null)
	{
		$paginator = $this->getDbTable()->fetchAllJoin($key, $condition);
		return $paginator;
		/*if($condition == null)
		{
			$resultSet = $this->getDbTable()->fetchAll();
			}
			else
			{
				$resultSet = $this->getDbTable()->search($key,$condition);
				}
		
		$entries = array();
		foreach ($resultSet as $row) {
			$entry = new Contract_Models_Contractor();
			$entry ->setContractorId($row->contractorId)
						->setName($row->name)
						->setContact($row->contact)
						->setLicenseNo($row->licenseNo)
						->setPhoneNo($row->phoneNo)
						->setOtherContact($row->otherContact)
						->setAddress($row->address);
			$entries[] = $entry;
		}
		return $entries;*/
	}

	public function findArrayContractor($contractorId)
	{
		$resultSet = $this->getDbtable()->findArrayContract($contractorId);
		return $resultSet;
	}

	public function findContractorName($id)
	{
		$arrayNames = $this->getDbTable()->findContractorName($id);
		
		$name = $arrayNames[0]->name;
		
		return $name;
	}
	
	public function fetchAllContractors()
	{
		$arrayContractors = $this->getDbtable()->fetchAll();
		
		$entries = array();
		
		$i = 0;
		
		foreach($arrayContractors as $contractor)
		{
			$entries[$i]['contractorId'] = $contractor->contractorId;
			$entries[$i]['name'] = $contractor->name;
			$entries[$i]['contact'] = $contractor->contact;
			$i++;
			}
		
		return $entries;
	}
	
	public function populateContractors($form)
	{
		$arrayContractors = $this->fetchAllContractors();
			
		foreach($arrayContractors as $contr)
		{
			$name = "承包商: ".$contr['name']." 联系人: ".$contr['contact'];
			$form->getElement('contractorId')->addMultiOption($contr['contractorId'],$name);
			}
		}

	public function formValidator($form,$formType)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('name')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('licenseNo')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('contact')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('phoneNo')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		
		return $form;
	}
	
	public function dataValidator($formData,$formType)
	{
		$errorMsg = null;
		$trigger = 0;

		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
	}
	
	public function fetchAllContractorIds()
	{
		$resultSet = $this->getDbTable()->fetchAllContractorIds();
		$entries = array();
		foreach ($resultSet as $row) {
			$entry = new Contract_Models_Contractor();
			$entry ->setContractorId($row->contractorId)
						->setName($row->name)
						->setContact($row->contact)
						->setLicenseNo($row->licenseNo)
						->setPhoneNo($row->phoneNo)
						->setOtherContact($row->otherContact)
						->setAddress($row->address);
			$entries[] = $entry;
		}
		return $entries;
		}
}
?>
