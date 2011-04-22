<?php
  //creation date 22-04-2011
  //creating by lincoy
  //completion date 22-04-2011

class Worker_Models_DbTable_Penalty extends Zend_Db_Table_Abstract
{
    protected $_name = 'wm_penalties';

	public function search($key,$condition)
	{
		$select = $this->select();

		if($condition == 'projectName')
		{
			$select->setIntegrityCheck(false)
			    ->from(array('p'=>'pm_projects'),array('name'))
			    ->join(array('w'=>'wm_penalties'),'p.projectId = w.projectId')
			    ->where('p.name like ?','%'.$key.'%');
			}
			elseif($condition == 'workerName')
			{
			$select->setIntegrityCheck(false)
			    ->from(array('m'=>'wm_workers'),array('name'))
			    ->join(array('w'=>'wm_penalties'),'m.workerId = w.workerId')
			    ->where('m.name like ?','%'.$key.'%');
				}
				elseif($condition == 'penDate')
				{
					$select->where('penDate = ?',$key);
					}
					elseif($condition == 'typeName')
					{
						$select->setIntegrityCheck(false)
			    			->from(array('g'=>'ge_pentypes'),array('name'))
			    			->join(array('w'=>'wm_penalties'),'g.typeId = w.typeId')
			    			->where('g.name like ?','%'.$key.'%');
							}

		$resultSet = $this->fetchAll($select);

		return $resultSet;
	}
}
?>