<?php
  //creation date 04-04-2011
  //creating by lincoy
  //completion date  04-04-2011

class Project_Models_DbTable_Progress extends Zend_Db_Table_Abstract
{
    protected $_name = 'pm_progresses';

	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'projectId')
		{
			$select->where('projectId = ?',$key);
			}
		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
	
	public function fetchAllStages($projectId) //check
	{
		$select = $this->select()
				->from('pm_progresses',array('stage'))
				->where('projectId = ?',$projectId);
		$entries = $this->fetchAll($select);
		return $entries;
		} 
}
?>
