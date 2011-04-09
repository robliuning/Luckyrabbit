<?php
/*
	author lxj
  	date 2011.3.28
  	review rob
  	date 2011/4.7
*/

class Contract_Models_SubcontractMapper
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
            $this->setDbTable('Contract_Models_DbTable_Subcontract');
        }
        return $this->_dbTable;
    }
    
    public function save(Contract_Models_Subcontract $subcontract) //check
    {
        $data = array(
        	'scontrId' => $subcontract->getScontrId(),
            'projectId' => $subcontract->getProjectId(),
            'scontrType' => $subcontract->getScontrType(),
            'contractorId' => $subcontract->getContractorId(),
            'scontrDetail' => $subcontract->getScontrDetail(),
			'quality' => $subcontract->getQuality(),
			'startDateExp' => $subcontract->getStartDateExp(),

			'endDateExp' => $subcontract->getEndDateExp(),
            'periodExp' => $subcontract->getPeriodExp(),
            'startDateAct' => $subcontract->getStartDateAct(),
            'endDateAct' => $subcontract->getEndDateAct(),
            'periodAct' => $subcontract->getPeriodAct(),
			'brConContr' => $subcontract->getBrConContr(),
			'brResContr' => $subcontract->getBrResContr(),

			'brConSContr' => $subcontract->getBrConSContr(),
            'brResSContr' => $subcontract->getBrResSContr(),
            'warranty' => $subcontract->getWarranty(),
            'contrAmt' => $subcontract->getContrAmt(),
            'consMargin' => $subcontract->getConsMargin(),
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
	
	public function findArraySubcontract($scontrId)
	{
		$resultSet = this->getDbtable->findArraySubcontract($scontrId);
		return $resultSet;
	}
    
    public function delete($id) //check
    {
    	$result = $this->getDbTable()->delete('scontrId = ' . (int)$id);
    	return $result;	
    	}
 
}
?>
