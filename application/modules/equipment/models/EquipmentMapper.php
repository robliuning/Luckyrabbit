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
    
    public function find($id,Equipment_Models_Equipment $equipment)
    {
    	$result = $this->getDbTable()->find($id);

        if (0 == count($result)) {

            return;

        }

        $row = $result->current();

        $equipment ->seteqpId($row->eqpId)
        		  ->setName($row->name)
                  ->setTypeId($row->typeId)
                  ->setSpec($row->spec)
                  ->setUnit($row->unit)
                  ->setRemark($row->remark)
                  ->setCTime($row->cTime);
		$eqptypes = new General_Models_EqptypeMapper();
        $typeName = $eqptypes->findTypeName($equipment->getTypeId());
        $equipment->setTypeName($typeName);
    }
     
    public function findArrayEquipment($id) //check
    {
		$id = (int)$id;
		$entries = $this->getDbTable()->findArrayEquipment($id);
		$entry = $entries[0]->toArray();
		return $entry;
	}
    
    public function findEquipmentName($id)
    {
		$arrayNames = $this->getDbTable()->findEquipmentName($id);
		
		$name = $arrayNames[0]->name;
		
		return $name;	
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
   				->setUnit($row->unit);
   				
   			$typeId = $entry->getTypeId();
   			$eqptypes = new General_Models_EqptypeMapper();	
   			$typeName = $eqptypes->findTypeName($typeId);
   			$entry->setTypeName($typeName);
   			 				
   			$entries[] = $entry;
   			}
    	return $entries;
    	}
    	
	public function findEquipmentNames($id)
	{
		$condition = "typeId";		
    	$resultSets = $this->getDbTable()->search($id,$condition);
		
		$entries = array();
		
		$i = 0;
		
		foreach($resultSets as $entry)
		{
			$entries[$i]['eqpId'] = $entry->eqpId;
			$entries[$i]['name'] = $entry->name;
			$i++;
			}
		
		return $entries;
		}
    
	public function delete($eqpId)
	{
		$this->getDbTable()->delete("eqpId = ".(int)$eqpId);
		}
	
	public function findEquipmentTypes()
	{
		$eqptypes = new General_Models_EqptypeMapper();
		$arrayEqptypes = $eqptypes->fetchAll();
		$eqpxrefs = new General_Models_EqpxrefMapper();
		$arrayEqpxrefs = $eqpxrefs->fetchAll();
		$entries = array();
		
		foreach($arrayEqptypes as $eqptype)
		{
			foreach($arrayEqpxrefs as $eqpxref)
			{
				if($eqpxref->getParent() == 0)
				{
					$typeId = $eqpxref->getChild();
					if($eqptype->getTypeId() == $typeId)
					{
						$name = "|- ".$eqptype->getName();
						$entries[] = array('typeId'=>$eqptype->getTypeId(),'name'=>$name);
						foreach($arrayEqptypes as $mtype)
						{
							foreach($arrayEqpxrefs as $mref)
							{
								if($mref->getParent() == $typeId )
								{
									$tId = $mref->getChild();
									if($mtype->getTypeId() == $tId)
									{
										$name = "|　|-- ".$mtype->getName();
										$entries[] = array('typeId'=>$mtype->getTypeId(),'name'=>$name);
										foreach($arrayEqptypes as $mt)
										{
											foreach($arrayEqpxrefs as $mf)
											{
												if($mf->getParent() == $tId)
												{
													$td = $mf->getChild();
													if($mt->getTypeId() == $td)
													{
														$name = "|　| 　|--- ".$mt->getName();
														$entries[] = array('typeId'=>$mt->getTypeId(),'name'=>$name);
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		return $entries;	
	}
	
	public function populateEqptypeDd($form)
	{
		$eqptypes = new General_Models_EqptypeMapper();
		$arrayEqptypes = $eqptypes->fetchAll();
		$eqpxrefs = new General_Models_EqpxrefMapper();
		$arrayEqpxrefs = $eqpxrefs->fetchAll();
		
		foreach($arrayEqptypes as $eqptype)
		{
			foreach($arrayEqpxrefs as $eqpxref)
			{
				if($eqpxref->getParent() == 0)
				{
					$typeId = $eqpxref->getChild();
					if($eqptype->getTypeId() == $typeId)
					{
						$name = "|- ".$eqptype->getName();
						$form->getElement('typeId')->addMultiOption($eqptype->getTypeId(),$name);//一级
						foreach($arrayEqptypes as $etype)
						{
							foreach($arrayEqpxrefs as $eref)
							{
								if($eref->getParent() == $typeId )
								{
									$tId = $eref->getChild();
									if($etype->getTypeId() == $tId)
									{
										$name = "|　|-- ".$etype->getName();
										$form->getElement('typeId')->addMultiOption($etype->getTypeId(),$name);//二级
										foreach($arrayEqptypes as $et)
										{
											foreach($arrayEqpxrefs as $ef)
											{
												if($ef->getParent() == $tId)
												{
													$td = $ef->getChild();
													if($et->getTypeId() == $td)
													{
														$name = "|　| 　|--- ".$et->getName();
														$form->getElement('typeId')->addMultiOption($et->getTypeId(),$name);//三级
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}	
	}
}
?>
