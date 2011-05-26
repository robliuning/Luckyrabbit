<?php
//Updated on 24th May by Rob

class Pment_Models_DbTable_Mstprg extends Zend_Db_Table_Abstract
{
	protected $_name = 'pm_mstprgs';
	
	public function fetchAllNames()
	{
		$select = $this->select()
				->from('pm_mstprgs',array('mstprgId','stage','task'));
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
						->join(array('m'=>'pm_mstprgs'),'e.contactId = m.contactId')
						->where('e.name like ?','%'.$key.'%')
						->where('m.projectId = ?',$condition[0]);
					}
					elseif($condition[1] == 'task')
					{
						$select->where('task like ?','%'.$key.'%')
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
	
	public function calStage($projectId)
	{
		$select = $this->select();
		$select->from('pm_mstprgs',array('stage'))
				->where('projectId = ?',$projectId);
		$resultSet = $this->fetchAll($select);
		return $resultSet;
		}

	public function findStage($mstprgId)
	{
		$select = $this->select();
		$select->from('pm_mstprgs',array('stage'))
				->where('mstprgId = ?',$mstprgId);
		$resultSet = $this->fetchAll($select);
		return $resultSet;
		}
}
?>