<?php
  //creation date 22-04-2011
  //creating by lincoy
  //completion date 22-04-2011

class Worker_Models_DbTable_Bonuse extends Zend_Db_Table_Abstract
{
    protected $_name = 'wm_bonuses';

	public function search($key,$condition)
	{
		$select = $this->select();

		if($condition == 'projectName')
		{
			$select->setIntegrityCheck(false)
			    ->from(array('p'=>'pm_projects'),array('name'))
			    ->join(array('w'=>'wm_bonuses'),'p.projectId = w.projectId')
			    ->where('p.name like ?','%'.$key.'%');
			}
			elseif($condition == 'workerName')
			{
			$select->setIntegrityCheck(false)
			    ->from(array('m'=>'wm_workers'),array('name'))
			    ->join(array('w'=>'wm_bonuses'),'m.workerId = w.workerId')
			    ->where('m.name like ?','%'.$key.'%');
				}
				elseif($condition == 'bonDate')
				{
					$select->where('bonDate = ?',$key);
					}
					elseif($condition == 'typeName')
					{
						$select->setIntegrityCheck(false)
			    			->from(array('g'=>'ge_bontypes'),array('name'))
			    			->join(array('w'=>'wm_bonuses'),'g.typeId = w.typeId')
			    			->where('g.name like ?','%'.$key.'%');
							}

		$resultSet = $this->fetchAll($select);

		return $resultSet;
	}
}
?>