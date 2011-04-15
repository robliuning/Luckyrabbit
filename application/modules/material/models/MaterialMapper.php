<?php

class Material_Models_MaterialMapper
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
            $this->setDbTable('Material_Models_DbTable_Material');
        }
        return $this->_dbTable;
    }
    
    public function save(Material_Models_Material $material) //check
    {
    	$id = null;
        $data = array(
            'mtrId' => $material->getMtrId(),
            'name' => $material->getName(),
            'typeId' => $material->getTypeId(),
            'spec' => $material->getSpec(),
            'unit' => $material->getUnit(),
            'remark' => $material->getRemark(),
        );
        if (null === ($id = $material->getMtrId())) {
            unset($data['mtrId']);
            $id = $this->getDbTable()->insert($data);
        } else {
            $id = $this->getDbTable()->update($data, array('mtrId = ?' => $material->getMtrId()));
        }
       return $id;
    }
     
    public function findArrayMaterial($id) //check
    {
		$id = (int)$id;
		$entries = $this->getDbTable()->findArraymaterial($id);
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
   			$entry = new Material_Models_Material();
   			
   			$entry->setMtrId($row->mtrId)
   				->setName($row->name)
   				->setTypeId($row->typeId)
   				->setSpec($row->spec)
   				->setUnit($row->unit)
   				->setRemark($row->remark);
   				
   			$typeId = $entry->getTypeId();
   			$mtrtypes = new General_Models_MtrtypeMapper();
   			$typeName = $mtrtypes->findTypeName($typeId);
   			$entry->setTypeName($typeName);
   			 				
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    
	public function delete($mtrId)
	{
		$this->getDbTable()->delete("mtrId = ".(int)$mtrId);
		}
}
?>
