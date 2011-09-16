<?php
//Updated on 24th May by Rob

class Pment_Models_DbTable_Wkprg extends Zend_Db_Table_Abstract
{
	protected $_name = 'pm_wkprgs';
	
	public function fetchAllNames()
	{
		$select = $this->select()
				->from('pm_wkprgs',array('wkprgId','wkNum'));
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
						->join(array('m'=>'pm_wkprgs'),'e.contactId = m.contactId')
						->where('e.name like ?','%'.$key.'%')
						->where('m.projectId = ?',$condition[0]);
					}
					elseif($condition[1] == 'wkNum')
					{
						$select->where('wkNum like ?','%'.$key.'%')
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
	
	public function calWkNum($projectId)
	{
		$select = $this->select();
		$select->from('pm_wkprgs',array('wkNum'))
				->where('projectId = ?',$projectId);
		$resultSet = $this->fetchAll($select);
		return $resultSet;
		}

	public function findWkNum($wkprgId)
	{
		$select = $this->select();
		$select->from('pm_wkprgs',array('wkNum'))
				->where('wkprgId = ?',$wkprgId);
		$resultSet = $this->fetchAll($select);
		return $resultSet;
		}
	
	public function findWkPlan($wkNum,$projectId)
	{
		$select = $this->select();
		$select->from('pm_wkprgs',array('nextPlan'))
				->where('wkNum = ?',$wkNum)
				->where('projectId = ?',$projectId);
		$resultSet = $this->fetchAll($select);
		return $resultSet;
		}
		
	public function fetchAllJoin($key, $condition)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('p' => 'pm_wkprgs'))
						->join(array('e'=>'em_contacts'),'e.contactId = p.contactId',array('contactName'));
		
		if($condition[1] != null)
		{
		
			if($condition[1] == "wkNum")
			{
				$select->where('p.wkNum like ?','%'.$key.'%');
				}
				elseif($condition[1] == "date")
				{
					$select->where('startDate <= ?',$key)
						->where('endDate >= ?',$key);
					}
				}
		$select->where('p.projectId = ?', $condition[0]);
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
		}

}
?>