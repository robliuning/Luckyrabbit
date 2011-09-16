<?php
//Updated on 24th May by Rob

class Pment_Models_DbTable_Mstprg extends Zend_Db_Table_Abstract
{
	protected $_name = 'pm_mstprgs';
	
	public function fetchAllNames($projectId)
	{
		$select = $this->select()
				->from('pm_mstprgs',array('mstprgId','stage','task'))
				->where('projectId = ?',$projectId);
		$entries = $this->fetchAll($select);
		
		return $entries;
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
		
	public function fetchAllJoin($key, $condition)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('p' => 'pm_mstprgs'))
						->join(array('e'=>'em_contacts'),'e.contactId = p.contactId',array('contactName'));
		if($condition[1] != null)
		{
			if($condition[1] == "task")
			{
				$select->where('p.task like ?','%'.$key.'%');
				}
				elseif($condition[1] == "date")
				{
				$select->where('p.startDate <= ?',$key)
						->where('p.endDate >= ?',$key);
					}
				}
		$select->where('p.projectId = ?',$condition[0]);
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
		}
}
?>