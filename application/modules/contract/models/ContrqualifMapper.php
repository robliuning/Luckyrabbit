<?php
//updated in 14th June by Rob

class Contract_Models_ContrqualifMapper
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
			$this->setDbTable('Contract_Models_DbTable_Contrqualif');
		}
		return $this->_dbTable;
	}

	public function save(Contract_Models_Contrqualif $contrqualif) //check
	{
		$data = array(
			'cqId' => $contrqualif->getCqId(),
			'contractorId' => $contrqualif->getContractorId(),
			'qualifTypeId' => $contrqualif->getQualifTypeId(),
			'qualifGrade' => $contrqualif->getQualifGrade()
		);
		if (null === ($id = $contrqualif->getCqId())) {
			unset($data['cqId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('cqId = ?' => $contrqualif->getCqId()));
		}
	}
	
	public function find($id,Contract_Models_Contrqualif $contrqualif)
	{
		$resultSet = $this->getDbTable()->find($id);

		if (0 == count($resultSet)) {

			return;
		}

		$row = $resultSet->current();

		$contrqualif->setCqId($row->cqId)
				->setContractorId($row->contractorId)
				->setQualifTypeId($row->qualifTypeId)
				->setQualifGrade($row->qualifGrade);	
		$qualiftypes = new General_Models_QualifTypeMapper();
		$qualiftype = new General_Models_QualifType();
		$qualiftypes->find($contrqualif->getQualifTypeId(),$qualiftype); 
		$contrqualif->setQualifSerie($qualiftype->getSerie());
		$contrqualif->setQualifType($qualiftype->getName());
		$contractors = new Contract_Models_ContractorMapper();
		$contractorName = $contractors->findContractorName($contrqualif->getContractorId());
		$contrqualif->setContractorName($contractorName);

	}
	
	public function fetchAllJoin($key,$condition)
	{
		if($condition == null)
		{
			$resultSet = $this->getDbTable()->fetchAll();
			}
			else
			{
				$resultSet = $this->getDbTable()->search($key,$condition);
				}
 		
 		$contrqualifs = array();
 		
 		foreach($resultSet as $row){
 			$contrqualif = new Contract_Models_Contrqualif();
			$contrqualif ->setCqId($row->cqId)
						->setContractorId($row->contractorId)
						->setQualifTypeId($row->qualifTypeId)
						->setQualifGrade($row->qualifGrade);
						
			$qualiftypes = new General_Models_QualifTypeMapper();
			$qualiftype = new General_Models_QualifType();
			$qualiftypes->find($contrqualif->getQualifTypeId(),$qualiftype);
			
			$contrqualif->setQualifSerie($qualiftype->getSerie());
			$contrqualif->setQualifType($qualiftype->getName());
			
			$contrqualifs[] = $contrqualif;
 		}
		return $contrqualifs;
	}
 
	public function fetchAllQualifTypes($key)
	{
		$qualiftypes = new General_Models_QualifTypeMapper();

		$arrayQualifTypes = $qualiftypes->fetchAll($key);

		return $arrayQualifTypes;
	}
	
	public function populateContrqualifDd($form,$condition,$serie)
	{
		if($condition == 0)
		{
			$contractors = new Contract_Models_ContractorMapper();
			$arrayContractors = $contractors->fetchAllContractorIds();
			
			foreach($arrayContractors as $contr)
			{
				$form->getElement('contractorId')->addMultiOption($contr->getContractorId(),$contr->getName());
				}
			}
		$qualifTypes = new General_Models_QualifTypeMapper();
		$arrayQualifTypes = $qualifTypes->fetchAllBySerie($serie);
		foreach($arrayQualifTypes as $qualif)
		{
			$form->getElement('qualifTypeId')->addMultiOption($qualif->getTypeId(),$qualif->getName());
			}
	}
	
	public function findQualiftypes($key)
	{
		$qualiftypes = new General_Models_QualifTypeMapper();
		
		$arrayQualiftypes = $qualiftypes->fetchAllBySerie($key);
		
		$entries = array();
		
		$i = 0;
		
		foreach($arrayQualiftypes as $qualiftype)
		{
			$entries[$i]['typeId'] = $qualiftype->typeId;
			$entries[$i]['name'] = $qualiftype->name;
			$entries[$i]['serie'] = $qualiftype->serie;
			$i++;
			}
		
		return $entries;
		}

	public function populateQualifDd($key)
	{
		$qualifType = new General_Models_QualifTypeMapper();
		$arrayQualiftype = $qualifType->fetchAllBySerie($key);
		return $arrayQualiftype;
	}
	
	public function findArrayContrqualif($id)
	{
		$resultSet = $this->getDbTable()->findArrayContrqualif($id);
		$qualifTypeId = $resultSet['qualifTypeId'];
		$qualiftypes = new General_Models_QualifTypeMapper();
		$qualifSerie = $qualiftypes->findQualifSerie($qualifTypeId);
		$resultSet['qualifSerie'] = $qualifSerie;
		
		return $resultSet;
	}
	
	public function fetchAllContrqualifs($id)
	{
		$resultSet = $this->getDbTable()->fetchAllContrqualifs($id);
		return $resultSet;	
	}
	
	public function formValidator($form,$formType)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('qualifGrade')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		return $form;
	}
}
?>
