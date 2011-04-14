<?php

class Material_Models_DbTable_Material extends Zend_Db_Table_Abstract
{
    protected $_name = 'mm_materials';

	public function findArrayMaterial($id)
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from(array('t'=>'ge_mtrtypes'),array('name'))
			->join(array('m'=>'mm_materials'),'t.typeId = m.typeId')		
			->where('m.mtrId = ?',$id);
			
		$entries = $this->fetchAll($select);
		
		return $entries;
		}
	
	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condtion == 'name')
		{
			$select->where('name = ?',$key);
			}
			elseif($condtion == 'type')
			{
				$select->where('typeId = ?',$key);
				}
				elseif($condtion == 'spec')
				{
					$select->where('spec = ?',$key);
					}
					
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>
