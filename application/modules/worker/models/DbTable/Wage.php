<?php
  //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011
class Worker_Models_DbTable_Wage extends Zend_Db_Table_Abstract
{
    protected $_name = 'wm_wages';

	public function findArrayTeam($id)
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from(array('v'=>'vm_workers'),array('name'))
			->join(array('w'=>'wm_wages'),'v.workerId = w.workerId')		
			->where('w.workerId = ?',$id);
			
		$entries = $this->fetchAll($select);
		
		return $entries;
		}
	
	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'workerName')
		{
			$select->setIntegrityCheck(false)
					->from(array('m'=>'wm_workers'),array('name'))
			        ->join(array('w'=>'wm_wages'),'m.workerId = w.workerId')		
			        ->where('m.name like ?','%'.$key.'%');
			}
			elseif($condition == 'date')
			{
				$select->setIntegrityCheck(false)
			        ->where('startDate < ?',$key)
					->where('endDate > ?',$key);
				}
				elseif($condition == "workerId")
				{
					$select->where('workerId = ?',$key);
					}
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>