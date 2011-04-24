<?php
   //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011
class Worker_Models_DbTable_Regular extends Zend_Db_Table_Abstract
{
    protected $_name = 'wm_regulars';

	public function findArrayRegular($id)
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from(array('p'=>'pm_projects'),array('name'))
			->join(array('w'=>'wm_regulars'),'p.projectId = w.projectId')		
			->where('w.projectId = ?',$id);
			
		$entries = $this->fetchAll($select);
		
		return $entries;
		}
	
	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'projectName')
		{
			$select->setIntegrityCheck(false)
			    ->from(array('p'=>'pm_projects'),array('name'))
			    ->join(array('w'=>'wm_regulars'),'p.projectId = w.projectId')		
			    ->where('p.name like ?','%'.$key.'%');			}
			elseif($condition == 'date')
			{
				$select->setIntegrityCheck(false)
			        ->where('startDate < ?',$key)
					->where('endDate > ?',$key);
				}
				
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>