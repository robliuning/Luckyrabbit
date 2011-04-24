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

	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'projectName')
		{
			$select->where('name like ?','%'.$key.'%');
			}
			elseif($condition == 'structype')
			{
				$select->where('structype like ?','%'.$key.'%');
				}
				elseif($condition == 'name')
				{
                   $select->setIntegrityCheck(false)
						->from(array('e'=> 'em_contacts'),array('name')) //  waiting for check 
				        ->from(array('c'=>'em_cpp'),array('contactId'))
						->join(array('p'=>'pm_projects'),'e.contactId = c.contactId' and 'p.projectId = c.projectId')
						->where('e.name like ?','%'.$key.'%');				
				   }
				   
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>