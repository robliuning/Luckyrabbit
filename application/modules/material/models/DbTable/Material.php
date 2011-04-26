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
		
		if($condition == 'name')
		{
			$select->where('name like ?','%'.$key.'%');
			}
			elseif($condition == 'type')
			{
				$select->setIntegrityCheck(false)
						->from(array('m'=> 'mm_materials'))
						->join(array('t'=>'ge_mtrtypes'),'m.typeId = t.typeId')
						->where('t.Name like ?','%'.$key.'%');
				}
				elseif($condition == 'spec')
				{
					$select->where('spec like ?','%'.$key.'%');
					}
					
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>
