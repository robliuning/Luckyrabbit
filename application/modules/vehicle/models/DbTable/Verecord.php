<?php
//updated on 14th May By Rob

class Vehicle_Models_DbTable_Verecord extends Zend_Db_Table_Abstract
{
	protected $_name = 've_verecords';

	public function fetchAllJoin($key,$condition)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('v' => 've_verecords'))
						->join(array('e'=>'em_contacts'),'e.contactId = v.contactId',array('contactName'))
						->join(array('h'=>'ve_vehicles'),'h.veId = v.veId');
		if($condition[1] != null)
		{
			if($condition[1] == 'plateNo')
			{
				$select->where('h.plateNo like ?','%'.$key.'%');
				}
				elseif($condition[1] == 'date')
				{
					$select->where('startDate <= ?',$key)
						->where('endDate >= ?',$key);
					}
					elseif($condition[1] == 'contactName')
					{
						$select->where('e.contactName like ?','%'.$key.'%');
							}
			}
		if($condition[0] != null)
		{
			$select->where('v.projectId = ?', $condition[0]);
			}
			else
			{
				$select->where('v.prjFlag = 0');
				}
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
		}
}
?>