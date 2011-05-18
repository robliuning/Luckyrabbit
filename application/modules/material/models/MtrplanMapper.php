<?php
class Material_Models_MtrplanMapper
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
            $this->setDbTable('Material_Models_DbTable_Mtrplan');
        }
        return $this->_dbTable;
    }
   
    public function save(Material_Models_Mtrplan $mtrplan) 
    {
    	$amount = $mtrplan->getPrice()*$mtrplan->getQuantity();
        $data = array(
            'mplanId' => $mtrplan->getMplanId(),
            'planId' => $mtrplan->getPlanId(),
            'mtrId' => $mtrplan->getMtrId(),
            'price' => $mtrplan->getPrice(),
            'quantity' => $mtrplan->getQuantity(),
			'amount' => $amount
        );
        if (null === ($id = $mtrplan->getMplanId())) {
            unset($data['mplanId']);
            return $this->getDbTable()->insert($data);
        } else {
            return $this->getDbTable()->update($data, array('mplanId = ?' => $mtrplan->getMplanId()));
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
   			$entry = new Material_Models_Mtrplan();
   			$entry->setMplanId($row->mplanId)
				->setPlanId($row->planId)
				->setMtrId($row->mtrId)
				->setPrice($row->price)
				->setQuantity($row->quantity)
				->setAmount($row->amount);

			$materials = new Material_Models_MaterialMapper();
			$materialName = $materials->findMaterialName($entry->getMtrId());
            $entry->setMaterialName($materialName);
			
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    
	public function delete($id)
	{
		$this->getDbTable()->delete("mplanId = ".(int)$id);
	}
}
?>
