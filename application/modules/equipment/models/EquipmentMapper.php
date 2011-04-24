<?php

/*write by lxj
 2011-04-16 v0.2
 */

class Equipment_Models_EquipmentMapper
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
            $this->setDbTable('Equipment_Models_DbTable_Equipment');
        }
        return $this->_dbTable;
    }
    
    public function save(Equipment_Models_Equipment $equipment) //check
    {
    	$id = null;
        $data = array(
            'eqpId' => $equipment->getEqpId(),
            'name' => $equipment->getName(),
            'typeId' => $equipment->getTypeId(),
            'spec' => $equipment->getSpec(),
            'unit' => $equipment->getUnit(),
            'remark' => $equipment->getRemark()
        );
        if (null === ($id = $equipment->getEqpId())) {
            unset($data['eqpId']);
            $id = $this->getDbTable()->insert($data);
        } else {
            $id = $this->getDbTable()->update($data, array('eqpId = ?' => $equipment->getEqpId()));
        }
       return $id;
    }
     
    public function findArrayEquipment($id) //check
    {
		$id = (int)$id;
		$entries = $this->getDbTable()->findArrayEquipment($id);
		$entry = $entries[0]->toArray();
		return $entry;
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
   		
   		$entries = array();
   		
   		foreach($resultSet as $row){
   			$entry = new Equipment_Models_Equipment();
   			
   			$entry->setEqpId($row->eqpId)
   				->setName($row->name)
   				->setTypeId($row->typeId)
   				->setSpec($row->spec)
   				->setUnit($row->unit)
   				->setRemark($row->remark)
				->setCTime($row->cTime);
   				
   			$typeId = $entry->getTypeId();
   			$eqptypes = new General_Models_EqptypeMapper();	
   			$typeName = $eqptypes->findTypeName($typeId);
   			$entry->setTypeName($typeName);
   			 				
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    
	public function delete($eqpId)
	{
		$this->getDbTable()->delete("eqpId = ".(int)$eqpId);
		}
}
?>
