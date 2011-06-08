<?php
//Updated on 30th May by Rob

class Pment_Models_TechMapper
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
			$this->setDbTable('Pment_Models_DbTable_Tech');
		}
		return $this->_dbTable;
	}
	public function save(Pment_Models_Tech $tech)
	{
		$data = array(
			'techId' => $tech->getTechId(),
			'projectId' => $tech->getProjectId(),
			'techDate' => $tech->getTechDate(),
			'content' => $tech->getContent(),
			'name' => $tech->getName(),
			'contactId' => $tech->getContactId(),
			'remark' => $tech->getRemark()
		);
		if (null === ($id = $tech->getTechId())) {
			unset($data['techId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('techId = ?' => $tech->getTechId()));
		}
	}

	public function find($techId,Pment_Models_Tech $tech)
	{
		$resultSet = $this->getDbTable()->find($techId);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$tech->setTechId($row->techId)
				->setProjectId($row->projectId)
				->setTechDate($row->techDate)
				->setContent($row->content)
				->setName($row->name)
				->setContactId($row->contactId)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($tech->getContactId());
		$tech->setContactName($contactName);
	}

	public function fetchAllJoin($key = null,$condition = null) //check
	{
		if($condition == null)
		{
			$resultSet = $this->getDbTable()->fetchAll();
			}
			else
			{
				$resultSet = $this->getDbTable()->search($key,$condition);
				}

		$techs = array();

		foreach($resultSet as $row){
			$tech = new Pment_Models_Tech();
			$tech ->setTechId($row->techId)
				->setProjectId($row->projectId)
				->setTechDate($row->techDate)
				->setName($row->name)
				->setContactId($row->contactId);

			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findContactName($tech->getContactId());
			$tech->setContactName($contactName);
			$techs[] = $tech;
			}
		return $techs;
		}

	public function findArrayTech($id)
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('techId = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		$row = $row->toArray();
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($row['contactId']);
		$row['contactName'] = $contactName;
		return $row;
	}

	public function delete($id)
	{
		$this->getDbTable()->delete('techId = ' . (int)$id);
	}
	
			
	public function formValidator($form,$formType)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('techDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('content')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('name')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('contactName')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('techDate')->addValidator($dateValidator);
		
		return $form;
	}
	
	public function dataValidator($formData,$formType)
	{
		$errorMsg = null;
		$trigger = 0;

		if($formData['contactId'] == null)
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_vehicle_contact_notFound."<br/>".$errorMsg;
			}

		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
	}
}
?>