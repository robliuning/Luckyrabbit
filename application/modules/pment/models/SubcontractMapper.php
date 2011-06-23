<?php
//Updated in 17th June by Rob

class Pment_Models_SubcontractMapper
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
			$this->setDbTable('Pment_Models_DbTable_Subcontract');
		}
		return $this->_dbTable;
	}

	public function save(Pment_Models_Subcontract $subcontract)
	{
		$data = array(
			'scontrId' => $subcontract->getScontrId(),
			'projectId' => $subcontract->getProjectId(),
			'scontrType' => $subcontract->getScontrType(),
			'contractorId' => $subcontract->getContractorId(),
			'content' => $subcontract->getContent(),
			'detail' => $subcontract->getDetail(),
			'quality' => $subcontract->getQuality(),
			'startDateExp' => $subcontract->getStartDateExp(),
			'endDateExp' => $subcontract->getEndDateExp(),
			'startDateAct' => $subcontract->getStartDateAct(),
			'endDateAct' => $subcontract->getEndDateAct(),
			'brConContr' => $subcontract->getBrConContr(),
			'brResContr' => $subcontract->getBrResContr(),

			'brConSContr' => $subcontract->getBrConSContr(),
			'brResSContr' => $subcontract->getBrResSContr(),
			'contrAmt' => $subcontract->getContrAmt(),
			'guarantee' => $subcontract->getGuarantee(),
			'prjMargin' => $subcontract->getPrjMargin(),
			'prjWarr' => $subcontract->getPrjWarr(),
			'remark' => $subcontract->getRemark()
		);

		if (null === ($id = $subcontract->getScontrId())) {
			unset($data['scontrId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('scontrId = ?' => $subcontract->getScontrId()));
		}
	}
	
	public function find($id,Pment_Models_Subcontract $subcontract)
	{
		$resultSet = $this->getDbTable()->find($id);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();
		$subcontract->setScontrId($row->scontrId)
				->setProjectId($row->projectId)
				->setScontrType($row->scontrType)
				->setContractorId($row->contractorId)
				->setContent($row->content)
				->setDetail($row->detail)
				->setQuality($row->quality)
				->setStartDateExp($row->startDateExp)
				->setEndDateExp($row->endDateExp)
				->setPeriodExp($row->periodExp)
				->setStartDateAct($row->startDateAct)
				->setEndDateAct($row->endDateAct)
				->setPeriodAct($row->periodAct)
				->setBrConContr($row->brConContr)
				->setBrResContr($row->brResContr)
				->setBrConSContr($row->brConSContr)
				->setBrResSContr($row->brResSContr)
				->setContrAmt($row->contrAmt)
				->setGuarantee($row->guarantee)
				->setPrjMargin($row->prjMargin)
				->setPrjWarr($row->prjWarr)
				->setRemark($row->remark)
				->setCTime($row->cTime);

		$contractors = new Contract_Models_ContractorMapper();
		$contractorName = $contractors->findContractorName($subcontract->getContractorId());
		$subcontract->setContractorName($contractorName);
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

		$entries = array();
		foreach ($resultSet as $row) {
			$entry = new Pment_Models_Subcontract();

			 $entry ->setScontrId($row->scontrId)
						->setProjectId($row->projectId)
						->setScontrType($row->scontrType)
						->setContractorId($row->contractorId)
						->setContent($row->content)
						->setContrAmt($row->contrAmt);
			$contractors = new Contract_Models_ContractorMapper();
			$contractorName = $contractors->findContractorName($entry->getContractorId());
			$entry->setContractorName($contractorName);
			
			$entries[] = $entry;
		}
		return $entries;
	}
	
	public function findArraySubcontract($scontrId)
	{
		$resultSet = $this->getDbtable()->findArraySubcontract($scontrId);
		return $resultSet;
	}
	
	public function delete($id) 
	{
		$result = $this->getDbTable()->delete('scontrId = ' . (int)$id);
		return $result;	
		}
	
	public function populateSubcontractDd($form,$projectId)
	{
		$cps = new Pment_Models_CpMapper();
		$arrayContractors = $cps->fetchAllJoin($projectId,'projectId');
			
		foreach($arrayContractors as $contr)
		{
			$form->getElement('contractorId')->addMultiOption($contr->getContractorId(),$contr->getName());
			}
	}
	
	public function formValidator($form,$formType)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('content')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('startDateExp')->addValidator($dateValidator);
		$form->getElement('endDateExp')->addValidator($dateValidator);
		$form->getElement('startDateAct')->addValidator($dateValidator);
		$form->getElement('endDateAct')->addValidator($dateValidator);
		
		$numberValidator = new Zend_Validate_Float();
		$numberValidator->setMessage(General_Models_Text::$text_notInt);
		$form->getElement('contrAmt')->addValidator($numberValidator);
		$form->getElement('guarantee')->addValidator($numberValidator);
		$form->getElement('prjMargin')->addValidator($numberValidator);
		$form->getElement('prjWarr')->addValidator($numberValidator);

		return $form;
	}
	
	public function dataValidator($formData,$formType)
	{
		$errorMsg = null;
		$trigger = 0;

		if($formData['startDateExp'] != null && $formData['endDateExp'] != null)
		{
			$dateStart = new Zend_Date($formData['startDateExp'],'YYYY-MM-DD');
			$dateEnd = new Zend_Date($formData['endDateExp'],'YYYY-MM-DD');
		
			if($dateStart->isLater($dateEnd))
			{
				$trigger = 1;
				$errorMsg = General_Models_Text::$text_date_startEndError_sub_exp."<br/>".$errorMsg;
				}
			}
		if($formData['startDateAct'] != null && $formData['endDateAct'] != null)
		{
			$dateStart = new Zend_Date($formData['startDateAct'],'YYYY-MM-DD');
			$dateEnd = new Zend_Date($formData['endDateAct'],'YYYY-MM-DD');
			if($dateStart->isLater($dateEnd))
			{
				$trigger = 1;
				$errorMsg = General_Models_Text::$text_date_startEndError_sub_act."<br/>".$errorMsg;
				}
			}
		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
	}
}
?>
