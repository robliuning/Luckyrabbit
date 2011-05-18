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
}
?>