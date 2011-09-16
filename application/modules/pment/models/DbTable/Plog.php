<?php
//Updated on 24th May by Rob

class Pment_Models_DbTable_Plog extends Zend_Db_Table_Abstract
{
	protected $_name = 'pm_projectlogs';
	
	public function fetchAllNames()
	{
		$select = $this->select()
				->from('pm_projectlogs',array('plogId','logDate'))
				->order('logDate');
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
				$select->from('pm_projectlogs',array('plogId','logDate'))
						->where('logDate = ?',$key)
						->where('projectId = ?',$condition[0])
						->order('logDate');
				}
			}
			else
			{
				$select->from('pm_projectlogs',array('plogId','logDate'))
						->where('projectId = ?',$condition[0])
						->order('logDate');
				}
		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
	
	public function checkLogDate($logDate,$projectId)
	{
		$select = $this->select();
		$select->where('logDate = ?',$logDate)
				->where('projectId = ?',$projectId);
		$resultSet = $this->fetchAll($select);
		if(count($resultSet) > 0)
		{
			return true;
			}
			else
			{
				return false;
				}
	}
	
	public function fetchAllJoin($key, $condition)
	{
		$select = $this->select();
		if($condition[1] != null)
		{
			if($condition[1] == "date")
			{
				$select->where('logDate = ?', $key);
				}
			}
		$select->where('projectId = ?',$condition[0])
				->order('logDate');
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
		}
}
?>