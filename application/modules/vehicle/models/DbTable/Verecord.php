<?php
	//updated on 14th May By Rob

class Vehicle_Models_DbTable_Verecord extends Zend_Db_Table_Abstract
{
	protected $_name = 've_verecords';

	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'plateNo')
		{
			$select->setIntegrityCheck(false)
				->from(array('ve' => 've_vehicles'),array('plateNo'))
				->join(array('re' => 've_verecords'),'ve.veId = re.veId')
				->where('ve.plateNo like ?','%'.$key.'%');
			}
			elseif($condition == 'date')
			{
				$select->where('startDate <= ?',$key)
					->where('endDate >= ?',$key);
				}
				elseif($condition == 'contactName')
				{
					$select->setIntegrityCheck(false)
						->from(array('em' => 'em_contacts'),array('name'))
						->join(array('re' => 've_verecords'),'em.contactId = re.contactId')
						->where('em.name like ?','%'.$key.'%');
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