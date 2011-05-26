<?php
//Updated on 24th May by Rob

class Project_Models_DbTable_Project extends Zend_Db_Table_Abstract
{
	protected $_name = 'pm_projects';
	
	public function findProjectName($id)
	{	
		$select = $this->select()
			->from('pm_projects',array('name'))
			->where('projectId = ?',$id);
			
		$entries = $this->fetchAll($select);
		
		return $entries;
		}
	
	public function fetchAllNames()
	{
		$select = $this->select()
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
						->from(array('e'=> 'em_contacts'),array('name'))
						->join(array('p'=>'pm_projects'),'p.contactId = e.contactId')
						->where('e.name like ?','%'.$key.'%');
				}
		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
}
?>