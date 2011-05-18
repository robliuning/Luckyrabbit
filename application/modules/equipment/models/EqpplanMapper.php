<?php
class Equipment_Models_EqpplanMapper
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
            $this->setDbTable('Equipment_Models_DbTable_Eqpplan');
        }
        return $this->_dbTable;
    }
   
    public function save(Equipment_Models_Eqpplan $eqpplan) 
    {
    	$amount = $eqpplan->getPrice()*$eqpplan->getQuantity();
        $data = array(
            'eplanId' => $eqpplan->getEplanId(),
            'planId' => $eqpplan->getPlanId(),
            'eqpId' => $eqpplan->getEqpId(),
            'price' => $eqpplan->getPrice(),
            'quantity' => $eqpplan->getQuantity(),
			'amount' => $amount
        );
        if (null === ($id = $eqpplan->getEplanId())) {
            unset($data['eplanId']);
            return $this->getDbTable()->insert($data);
        } else {
            return $this->getDbTable()->update($data, array('eplanId = ?' => $eqpplan->getEplanId()));
        }
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
   		
   		foreach($resultSet as $row){
   			$entry = new Equipment_Models_Eqpplan();
   			$entry->setEplanId($row->eplanId)
				->setPlanId($row->planId)
				->setEqpId($row->eqpId)
				->setPrice($row->price)
				->setQuantity($row->quantity)
				->setAmount($row->amount);

			$equipments = new Equipment_Models_EquipmentMapper();
			$equipmentName = $equipments->findEquipmentName($entry->getEqpId());
            $entry->setEqpName($equipmentName);
			
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    
	public function delete($id)
	{
		$this->getDbTable()->delete("eplanId = ".(int)$id);
	}
}
?>
