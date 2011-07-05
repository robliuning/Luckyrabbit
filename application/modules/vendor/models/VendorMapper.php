<?php
//Updated in 13th June by Rob

class Vendor_Models_VendorMapper
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
			$this->setDbTable('Vendor_Models_DbTable_Vendor');
		}
		return $this->_dbTable;
	}

	public function save(Vendor_Models_Vendor $vendor)
	{
		$data = array(
			'vId' => $vendor->getVId(),
			'name' => $vendor->getName(),
			'contact' => $vendor->getContact(),
			'typeId' => $vendor->getTypeId(),
			'busiField' => $vendor->getBusiField(),
			'phoneNo' => $vendor->getPhoneNo(),
			'otherContact' => $vendor->getOtherContact(),
			'address' => $vendor->getAddress(),
			'remark' => $vendor->getRemark(),
			'contactId' => $vendor->getContactId()
		);
		if (null === ($id = $vendor->getVId())){
			unset($data['vId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('vId = ?' => $vendor->getVId()));
		}
	}

	public function find($id,Vendor_Models_Vendor $vendor) 
	{
		$resultSet = $this->getDbTable()->find($id);
		if (0 == count($resultSet)) {
			return;
		}
		$row = $resultSet->current();
		$vendor->setVId($row->vId)
				->setName($row->name)
				->setContact($row->contact)
				->setTypeId($row->typeId)
				->setBusiField($row->busiField)
				->setPhoneNo($row->phoneNo)
				->setOtherContact($row->otherContact)
				->setAddress($row->address)
				->setRemark($row->remark)
				->setCTime($row->cTime)
				->setContactId($row->contactId);
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($vendor->getContactId());
		$vtypes = new General_Models_VtypeMapper();
		$typeName = $vtypes->findTypeName($vendor->getTypeId());
		$vendor->setContactName($contactName);
		$vendor->setTypeName($typeName);
		}
	
	public function delete($id)
	{
		$result = $this->getDbTable()->delete('vId = ' . (int)$id);
		return $result;	
		}

	public function fetchAllJoin($key=null,$condition=null)
	{
		if($condition == null)
		{
			$resultSet = $this->getDbTable()->fetchAll();
			}
			else
			{
				$resultSet = $this->getDbTable()->search($key,$condition);
				}
		
		$entries = array();
		foreach ($resultSet as $row) {
			$entry = new Vendor_Models_Vendor();
			$entry ->setVId($row->vId)
						->setName($row->name)
						->setContact($row->contact)
						->setTypeId($row->typeId)
						->setPhoneNo($row->phoneNo)
						->setOtherContact($row->otherContact)
						->setAddress($row->address)
						->setContactId($row->contactId);
			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findContactName($entry->getContactId());
			$vtypes = new General_Models_VtypeMapper();
			$typeName = $vtypes->findTypeName($entry->getTypeId());
			$entry->setTypeName($typeName);
			$entry->setContactName($contactName);
			$entries[] = $entry;
		}
		return $entries;
	}
	
	public function fetchAllOrganize($key = null,$condition = null)
		{
			$arrayVendors = $this->fetchAllJoin($key,$condition);
			$arrayYm = null;
			foreach($arrayVendors as $vendor)
			{
				$typeName = $vendor->getTypeName();
				foreach($arrayVendors as $ven)
				{
					if($typeName == $ven->getTypeName())
					{
						$tri = 0;
						if(!isset($arrayYm[$typeName]))
						{
							$arrayYm[$typeName] = array();
							}
						foreach($arrayYm[$typeName] as $v)
						{
							if($vendor->getVId() == $v->getVId())
							{
								$tri = 1;
								}
							}
							if($tri == 0)
							{
								$arrayYm[$typeName][] = $vendor;
								}
						}
					}
				}
			return $arrayYm;
		}

	public function findArrayVendor($id)
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('vId = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		$row = $row->toArray();
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($row['contactId']);
		$row['contactName'] = $contactName;
		return $row;
	}

	public function formValidator($form,$formType)
	{
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('name')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('typeId')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('busiField')->setAllowEmpty(false)
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
}
?>
