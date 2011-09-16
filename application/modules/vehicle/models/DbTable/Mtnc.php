<?php
//updated on 14th May By Rob

class Vehicle_Models_DbTable_Mtnc extends Zend_Db_Table_Abstract
{
	protected $_name = 've_mtncs';

	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'plateNo')
		{
			$select->setIntegrityCheck(false)
				->from(array('ve' => 've_vehicles'),array('plateNo'))
				->join(array('mt' => 've_mtncs'),'ve.veId = mt.veId')
				->where('ve.plateNo like ?','%'.$key.'%');
			}
			elseif($condition == 'contactName')
				{
					$select->setIntegrityCheck(false)
						->from(array('e'=> 'em_contacts'),array('name'))
						->join(array('v'=>'ve_mtncs'),'e.contactId = v.contactId')
						->where('e.name like ?','%'.$key.'%');
					}
					elseif($condition == 'date')
					{
						$select->where('rDate = ?',$key);
						}
						elseif($condition == 'veId')
						{
							$select->where('veId = ?',$key);
							}
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
	
	public function fetchAllJoin($key, $condition)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('vm'=>'ve_mtncs'))
						->join(array('ve'=>'ve_vehicles'),'ve.veId = vm.veId',array('plateNo'))
						->join(array('ec'=>'em_contacts'),'ec.contactId = vm.contactId',array('contactName'));
		if($condition == 'plateNo')
		{
			$select->where('ve.plateNo like ?','%'.$key.'%');
			}
			elseif($condition == 'contactName')
				{
					$select->where('ec.contactName like ?','%'.$key.'%');
					}
					elseif($condition == 'date')
					{
						$select->where('vm.rDate = ?',$key);
						}
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
		}
}
?>