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
    
    public function populateContrqualifDd($form) //check
  	{
  		$contractors = new Contract_Models_ContractorMapper();
		$arrayContractors = $contractors->fetchAllJoin();  //contractor name and id
		$qualifTypes = new General_Models_QualifTypeMapper();
		
		$serie = '施工总承包';
		
		$arrayQualifTypes = $qualifTypes->fetchAllBySerie($serie); 

		foreach($arrayContractors as $contr)
		{
			$form->getElement('contractorId')->addMultiOption($contr->getContractorId(),$contr->getName());
			}
		foreach($arrayQualifTypes as $qualif)
		{
			$form->getElement('qualifTypeId')->addMultiOption($qualif->getTypeId(),$qualif->getName());
			}
  	}
  	
  	public function findQualiftypes($key) //check
	{
		$qualiftypes = new General_Models_QualiftypeMapper();
		
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
		return $resultSet;
	}
	
	public function fetchAllContrqualifs($id)
	{
		$resultSet = $this->getDbTable()->fetchAllContrqualifs($id);
		return $resultSet;	
	}
}
?>
