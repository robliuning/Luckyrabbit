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
            'remark' => $material->getRemark()
        );
        if (null === ($id = $material->getMtrId())) {
            unset($data['mtrId']);
            $id = $this->getDbTable()->insert($data);
        } else {
            $id = $this->getDbTable()->update($data, array('mtrId = ?' => $material->getMtrId()));
        }
       return $id;
    }
    
    public function find($id, Material_Models_Material $material)
    { 
       $result = $this->getDbTable()->find($id);

        if (0 == count($result)) {

            return;

        }

        $row = $result->current();

        $material  ->setMtrId($row->mtrId)
        		  ->setName($row->name)
                  ->setTypeId($row->typeId)
                  ->setSpec($row->spec)
                  ->setUnit($row->unit)
                  ->setRemark($row->remark)
                  ->setCTime($row->cTime);
                  
        $mtrtypes = new General_Models_MtrtypeMapper();
        $typeName = $mtrtypes->findTypeName($material->getTypeId());
        $material->setTypeName($typeName);  
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
		
	public function findMaterialNames($id)
	{
		$condition = "typeId";		
    	$resultSets = $this->getDbTable()->search($id,$condition);
		
		$entries = array();
		
		$i = 0;
		
		foreach($resultSets as $entry)
		{
			$entries[$i]['mtrId'] = $entry->mtrId;
			$entries[$i]['name'] = $entry->name;
			$i++;
			}
		
		return $entries;
		}
		
	public function findMaterialName($id)
	{
		$arrayNames = $this->getDbTable()->findMaterialName($id);
		
		$name = $arrayNames[0]->name;
		
		return $name;
	}
	
	public function findMaterialTypes()
	{
		$mtrtypes = new General_Models_MtrtypeMapper();
		$arrayMtrtypes = $mtrtypes->fetchAll();
		$mtrxrefs = new General_Models_MtrxrefMapper();
		$arrayMtrxrefs = $mtrxrefs->fetchAll();
		$entries = array();
		
		foreach($arrayMtrtypes as $mtrtype)
		{
			foreach($arrayMtrxrefs as $mtrxref)
			{
				if($mtrxref->getParent() == 0)
				{
					$typeId = $mtrxref->getChild();
					if($mtrtype->getTypeId() == $typeId)
					{
						$name = "|- ".$mtrtype->getName();
						$entries[] = array('typeId'=>$mtrtype->getTypeId(),'name'=>$name);
						foreach($arrayMtrtypes as $mtype)
						{
							foreach($arrayMtrxrefs as $mref)
							{
								if($mref->getParent() == $typeId )
								{
									$tId = $mref->getChild();
									if($mtype->getTypeId() == $tId)
									{
										$name = "|　|-- ".$mtype->getName();
										$entries[] = array('typeId'=>$mtype->getTypeId(),'name'=>$name);
										foreach($arrayMtrtypes as $mt)
										{
											foreach($arrayMtrxrefs as $mf)
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
	
	public function populateMtrtypeDd($form)
	{
		$mtrtypes = new General_Models_MtrtypeMapper();
		$arrayMtrtypes = $mtrtypes->fetchAll();
		$mtrxrefs = new General_Models_MtrxrefMapper();
		$arrayMtrxrefs = $mtrxrefs->fetchAll();
		
		foreach($arrayMtrtypes as $mtrtype)
		{
			foreach($arrayMtrxrefs as $mtrxref)
			{
				if($mtrxref->getParent() == 0)
				{
					$typeId = $mtrxref->getChild();
					if($mtrtype->getTypeId() == $typeId)
					{
						$name = "|- ".$mtrtype->getName();
						$form->getElement('typeId')->addMultiOption($mtrtype->getTypeId(),$name);//一级
						foreach($arrayMtrtypes as $mtype)
						{
							foreach($arrayMtrxrefs as $mref)
							{
								if($mref->getParent() == $typeId )
								{
									$tId = $mref->getChild();
									if($mtype->getTypeId() == $tId)
									{
										$name = "|　|-- ".$mtype->getName();
										$form->getElement('typeId')->addMultiOption($mtype->getTypeId(),$name);//二级
										foreach($arrayMtrtypes as $mt)
										{
											foreach($arrayMtrxrefs as $mf)
											{
												if($mf->getParent() == $tId)
												{
													$td = $mf->getChild();
													if($mt->getTypeId() == $td)
													{
														$name = "|　| 　|--- ".$mt->getName();
														$form->getElement('typeId')->addMultiOption($mt->getTypeId(),$name);//三级
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
