<?php
//Updated on 24th May by Rob

class Project_Models_ProjectMapper
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
			$this->setDbTable('Project_Models_DbTable_Project');
		}
		return $this->_dbTable;
	}
	public function save(Project_Models_Project $project)
	{
		$data = array(
			'projectId' => $project->getProjectId(),
			'name' => $project->getName() ,
			'address' => $project->getAddress(),
			'status' => $project->getStatus(),
			'structype' => $project->getStructype(),
			'level' => $project->getLevel(),
			'period' => $project->getPeriod(),
			'startDate' => $project->getStartDate(),
			'contactId' => $project->getContactId(),
			'constructor' => $project->getConstructor(),
			'contractor' => $project->getContractor(),
			'supervisor' => $project->getSupervisor(),
			'designer' => $project->getDesigner(),
			'license' => $project->getLicense(),
			'amount' => $project->getAmount(),
			'constrArea' => $project->getConstrArea(),
			'remark' => $project->getRemark()
		);
		if (null === ($id = $project->getProjectId())) {
			unset($data['projectId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('projectId = ?' => $project->getProjectId()));
		}
	}

	public function find($projectId,Project_Models_Project $project)
	{
		$resultSet = $this->getDbTable()->find($projectId);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$project->setProjectId($row->projectId)
				->setName($row->name)
				->setAddress($row->address)
				->setStatus($row->status)
				->setStructype($row->structype)
				->setLevel($row->level)
				->setPeriod($row->period)
				->setStartDate($row->startDate)
				->setContactId($row->contactId)
				->setConstructor($row->constructor)
				->setContractor($row->contractor)
				->setSupervisor($row->supervisor)
				->setDesigner($row->designer)
				->setLicense($row->license)
				->setAmount($row->amount)
				->setConstrArea($row->constrArea)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($project->getContactId());
		$project->setContactName($contactName);
	}

	public function fetchAllNames()
	{
		$resultSet = $this->getDbTable()->fetchAllNames();
		$entries = array();
		foreach($resultSet as $row){
			$entry = new Project_Models_Project();
			$entry ->setProjectId($row->projectId)
					->setName($row->name);
			$entries[] = $entry;
		}
		return $entries;
	}

	public function findProjectName($id)
	{
		$arrayNames = $this->getDbTable()->findProjectName($id);
		$name = $arrayNames[0]->name;
		return $name;
		}

	public function fetchAllJoin($key = null,$condition = null) //check
	{
		
		$paginator = $this->getDbTable()->fetchAllJoin($key,$condition);
		return $paginator;
		}

	public function findArrayProject($id)
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('projectId = ' . $id);
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
		$this->getDbTable()->delete('projectId = ' . (int)$id);
	}
	
			
	public function formValidator($form,$formType)
	{
		$numberValidator = new Zend_Validate_Float();
		$numberValidator->setMessage(General_Models_Text::$text_notInt);
		$form->getElement('amount')->addValidator($numberValidator);
		
		$intValidator = new Zend_Validate_Int();
		$intValidator->setMessage(General_Models_Text::$text_notInt);
		$form->getElement('level')->addValidator($intValidator);
		$form->getElement('period')->addValidator($intValidator);
		$form->getElement('constrArea')->addValidator($intValidator);
		
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('name')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('contactName')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('license')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('startDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('startDate')->addValidator($dateValidator);
		
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