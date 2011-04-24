<?php
   //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011

class Worker_Models_DbTable_Worker extends Zend_Db_Table_Abstract
{
    protected $_name = 'wm_workers';

	public function findArrayWorker($id)
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from(array('v'=>'wm_teams'),array('name'))
			->join(array('w'=>'wm_workers'),'v.teamId = w.teamId')		
			->where('w.workerId = ?',$id);
			
		$entries = $this->fetchAll($select);
		
		return $entries;
		}
	
	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'name')
		{
			$select->where('name like ?','%'.$key.'%');
			}
			elseif($condition == 'teamName')
			{
				$select->setIntegrityCheck(false)
					->from(array('v'=>'vw_teams'),array('name'))
			        ->join(array('w'=>'wm_workers'),'v.teamId = w.teamId')		
			        ->where('v.name like ?','%'.$key.'%');
				}
				elseif($condition == 'phoneNo')
				{
					$select->where('phoneNo like ?','%'.$key.'%');
					}
					elseif($condition == 'teamId')
					{
						$select->where('teamId = ?',$key);
						}
				
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}

	public function findWorkerName($id)
    {
    	$select = $this->select()
			->setIntegrityCheck(false)
			->from('wm_workers',array('name'))
			->where('workerId = ?',$id);
			
   		$entries = $this->fetchAll($select);
   		
   		return $entries;
    	}
}
?>