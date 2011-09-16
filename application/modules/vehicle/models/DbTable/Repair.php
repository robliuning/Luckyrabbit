<?php
//updated on 14th May By Rob

class Vehicle_Models_DbTable_Repair extends Zend_Db_Table_Abstract
{
	protected $_name = 've_repairs';

	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'plateNo')
		{
			$select->setIntegrityCheck(false)
				->from(array('ve' => 've_vehicles'),array('plateNo'))
				->join(array('re' => 've_repairs'),'ve.veId = re.veId')
				->where('ve.plateNo like ?','%'.$key.'%');
			}
			elseif($condition == 'contactName')
				{
					$select->setIntegrityCheck(false)
						->from(array('e'=> 'em_contacts'),array('name'))
						->join(array('v'=>'ve_repairs'),'e.contactId = v.contactId')
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
						->from(array('ve'=>'ve_repairs'))
						->join(array('em'=>'em_contacts'),'em.contactId = ve.contactId',array('contactName'))
						->join(array('vv'=>'ve_vehicles'),'vv.veId = ve.veId',array('plateNo'));
		if($condition == 'plateNo')
		{
			$select->where('vv.plateNo like ?','%'.$key.'%');
			}
			elseif($condition == 'contactName')
				{
					$select->where('em.contactName like ?','%'.$key.'%');
					}
					elseif($condition == 'date')
					{
						$select->where('ve.rDate = ?',$key);
						}
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
		}
}
?>