<?php
//Updated on 26th May by Rob

class Pment_Models_DbTable_Monprg extends Zend_Db_Table_Abstract
{
	protected $_name = 'pm_monprgs';
	
	public function fetchAllNames()
	{
		$select = $this->select()
				->from('pm_monprgs',array('monprgId','subTask'));
		$entries = $this->fetchAll($select);
		
		return $entries;
		}

	public function search($key,$condition)
	{
		$select = $this->select();
		if($condition[1] != null)
		{
			if($condition[1] == 'date')
			{
				$select->where('startDate <= ?',$key)
						->where('endDate >= ?',$key)
						->where('projectId = ?',$condition[0]);
				}
				elseif($condition[1] == 'name')
				{
 						$select->setIntegrityCheck(false)
						->from(array('e'=> 'em_contacts'),array('name'))
						->join(array('m'=>'pm_monprgs'),'e.contactId = m.contactId')
						->where('e.name like ?','%'.$key.'%')
						->where('m.projectId = ?',$condition[0]);
					}
					elseif($condition[1] == 'task')
					{
						$select->where('subTask like ?','%'.$key.'%')
						->where('projectId = ?',$condition[0]);
						}
			}
			else
			{
				$select->where('projectId = ?',$condition[0]);
				}
		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
}
?>