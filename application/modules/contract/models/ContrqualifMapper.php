<?php

/* create by lxj
   2011-04-08   v 0.2
   rewrite by lxj
   2011-04-09   v 0.2
   */


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
            'qualifSerie' => $contrqualif->getQualifSerie(),
            'qualifType' => $contrqualif->getQualifType(),
			'qualifGrade' => $contrqualif->getQualifGrade()
        );
        if (null === ($id = $contrqualif->getCqId())) {
            unset($data['cqId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('cqId = ?' => $cqId));
        }
    }
 
    public function fetchAllQualifTypes($key)
    {
		$qualiftypes = new General_Models_QualifTypeMapper();

		$arrayQualifTypes = $qualiftypes->fetchAll($key);

		return $arrayQualifTypes;
    }
    
    public function populateDd($form) //check
  	{
  		$contractors = new Contract_Models_ContractorMapper();
		$arrayContractors = $contractors->fetchAll(); 
		$qualifTypes = new General_Models_QualifTypeMapper();
		$arrayQualiftypes = $qualifTypes->fetchAll(null);

		foreach($arrayContractors as $contr)
		{
			$form->getElement('contractId')->addMultiOption($contr->getContractorId(),$contr->getName());
			}
		foreach($arrayQualiftype as $qualif)
		{
			$form->getElement('qualifTypeId')->addMultiOption($qualif->getQualifTypeId(),$qualif->getName());
			}
  	}

	public function populateQualifDd($key)
	{
		$qualifType = new General_Models_QualifTypeMapper();
		$arrayQualiftype = $qualifType->fetchAll($key);
		return $arrayQualiftype;
	}
	
	public function findArrayContrQualif($cqId)
	{
		$resultSet = this->getDbtable->findArrayContrqualif($cqId);
		return $resultSet;
	}
}
?>
