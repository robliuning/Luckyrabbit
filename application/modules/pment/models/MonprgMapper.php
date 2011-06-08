<?php
//Updated on 25th May by Rob

class Pment_Models_MonprgMapper
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
			$this->setDbTable('Pment_Models_DbTable_Monprg');
		}
		return $this->_dbTable;
	}
	public function save(Pment_Models_Monprg $monprg)
	{
		$data = array(
			'monprgId' => $monprg->getMonprgId(),
			'projectId' => $monprg->getProjectId(),
			'yearNum' => $monprg->getYearNum(),
			'monNum' => $monprg->getMonNum(),
			'subTask' => $monprg->getSubTask(),
			'startDate' => $monprg->getStartDate(),
			'endDate' => $monprg->getEndDate(),
			'contactId' => $monprg->getContactId(),
			'remark' => $monprg->getRemark()
		);
		if (null === ($id = $monprg->getMonprgId())) {
			unset($data['monprgId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('monprgId = ?' => $monprg->getMonprgId()));
		}
	}

	public function find($monprgId,Pment_Models_Monprg $monprg)
	{
		$resultSet = $this->getDbTable()->find($monprgId);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$monprg->setMonprgId($row->monprgId)
				->setProjectId($row->projectId)
				->setYearNum($row->yearNum)
				->setMonNum($row->monNum)
				->setSubTask($row->subTask)
				->setStartDate($row->startDate)
				->setEndDate($row->endDate)
				->setPeriod($row->period)
				->setContactId($row->contactId)
				->setRemark($row->remark)
				->setCTime($row->cTime);
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($monprg->getContactId());
		$monprg->setContactName($contactName);
	}

	public function fetchAllNames()
	{
		$resultSet = $this->getDbTable()->fetchAllNames();
		$entries = array();
		foreach($resultSet as $row){
			$entry = new Pment_Models_Monprg();
			$entry ->setMonprgId($row->MonprgId)
					->setYearNum($row->yearNum)
					->setMonNum($row->monNum);
			$entries[] = $entry;
		}
		return $entries;
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

		$monprgs = array();

		foreach($resultSet as $row){
			$monprg = new Pment_Models_Monprg();
			$monprg ->setMonprgId($row->monprgId)
				->setProjectId($row->projectId)
				->setYearNum($row->yearNum)
				->setMonNum($row->monNum)
				->setSubTask($row->subTask)
				->setStartDate($row->startDate)
				->setEndDate($row->endDate)
				->setPeriod($row->period)
				->setContactId($row->contactId);

			$contacts = new Employee_Models_ContactMapper();
			$contactName = $contacts->findContactName($monprg->getContactId());
			$monprg->setContactName($contactName);
			$monprgs[] = $monprg;
			}
		return $monprgs;
		}
		
		public function fetchAllOrganize($key = null,$condition = null)
		{
			$arrayMonprgs = $this->fetchAllJoin($key,$condition);
			$arrayYm = null;
			foreach($arrayMonprgs as $monprg)
			{
				$year = $monprg->getYearNum();
				$month = $monprg->getMonNum();
				foreach($arrayMonprgs as $mon)
				{
					if($month == $mon->getMonNum() && $year == $mon->getYearNum())
					{
						$tri = 0;
						if(!isset($arrayYm[$year][$month]))
						{
							$arrayYm[$year][$month] = array();
							}
						foreach($arrayYm[$year][$month] as $m)
						{
							if($monprg->getMonprgId() == $m->getMonprgId())
							{
								$tri = 1;
								}
							}
							if($tri == 0)
							{
								$arrayYm[$year][$month][] = $monprg;
								}
						}
					}
				}
			return $arrayYm;
		}

	public function findArrayMonprg($id)
	{
		$id = (int)$id;
		$row = $this->getDbTable()->fetchRow('monprgId = ' . $id);
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
		$this->getDbTable()->delete('monprgId = ' . (int)$id);
	}
	
			
	public function formValidator($form,$formType)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('subTask')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('startDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('endDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('contactName')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('startDate')->addValidator($dateValidator);
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
		$dateStart = new Zend_Date($formData['startDate'],'YYYY-MM-DD');
		$dateEnd = new Zend_Date($formData['endDate'],'YYYY-MM-DD');
		
		if($dateStart->isLater($dateEnd))
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_date_startEndError."<br/>".$errorMsg;
			}
			
		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
	}
	
	public function populateMonprgDd($form)
	{
		//populate ryear
		$year = date('Y');
		for($i = -5;$i <= 5; $i++)
		{
			$id = $year + $i;
			$text =(string)$id.'年';
			$form->getElement('yearNum')->addMultiOption($id,$text);
			}
		$form->getElement('yearNum')->setValue($year);
		//populate rmonth
		for($j = 1; $j <= 12; $j++)
		{
			$id = $j;
			$text = $j.'月';
			$form->getElement('monNum')->addMultiOption($id,$text);
			}
			
		$month = date('m');
		$month = (int)$month;
		$form->getElement('monNum')->setValue($month);
		
		}
}
?>