<?php
  //Author lincoy
  //Date 2011.4.1
  //review rob
  //date 2011.4.7
  
class Project_Models_DbTable_Project extends Zend_Db_Table_Abstract
{
    protected $_name = 'pm_projects';
	
	public function findProjectName($id)
	{    	
		$select = $this->select()
			->setIntegrityCheck(false)
			->from('pm_projects',array('name'))
			->where('projectId = ?',$id);
			
   		$entries = $this->fetchAll($select);
   		
   		return $entries;
		}
	
	public function fetchAllJoin() //check
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from('pm_projects',array('projectId','name','status','structype','staffNo'))
			->order('cTime DESC');
		$entries = $this->fetchAll();
		
		return $entries;
		}
	public function fetchAllNames() //check
	{
		$select = $this->select()
				->setIntegrityCheck(false)
				->from('pm_projects',array('projectId','name'));
		$entries = $this->fetchAll($select);
		
		return $entries;	
		}
}
?>