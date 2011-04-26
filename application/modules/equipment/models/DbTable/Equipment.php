<?php

/*write by lxj
 2011-04-16 v0.2
 */

class Equipment_Models_DbTable_Equipment extends Zend_Db_Table_Abstract
{
    protected $_name = 'eq_equipments';

	public function findArrayEquipment($id)
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from(array('g'=>'ge_eqptypes'),array('name'))
			->join(array('e'=>'eq_equipments'),'g.typeId = e.typeId')		
			->where('e.eqpId = ?',$id);
			
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
						->from(array('e'=> 'eq_equipments'))
						->join(array('g'=>'ge_eqptypes'),'e.typeId = g.typeId')
						->where('g.Name like ?','%'.$key.'%');
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
