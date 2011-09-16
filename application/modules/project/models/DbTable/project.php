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
	public function fetchAllJoin($key, $condition)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('p' => 'pm_projects'))
						->join(array('e'=>'em_contacts'),'e.contactId = p.contactId',array('contactName'));

		if($condition == "projectName")
		{
			$select->where('p.name like ?','%'.$key.'%');
			}
			elseif($condition == "structype")
			{
				$select->where('p.structype like ?','%'.$key.'%');
				}
				elseif($condition == "name")
				{
					$select->where('e.contactName like ?','%'.$key.'%');
					}
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
	}
}
?>