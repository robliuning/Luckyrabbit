<?php
//updated in 9th June by Rob

class Pment_Models_DbTable_Cpp extends Zend_Db_Table_Abstract
{
	protected $_name = 'em_cpp'; 

	public function findArrayCpp($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('cppId = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}
		
	public function findContact($projectId,$postId) //check
	{
		$select = $this->select()
				->setIntegrityCheck(false)
				->from(array('e'=>'em_cpp'),array('contactId'))
				->join(array('c'=>'em_contacts'),'e.contactId = c.contactId')
				->where('e.projectId = ?',$projectId)
				->where('e.postId = ?',$postId);
		$entries = $this->fetchAll($select);
		return $entries;
		}

	public function search($key,$condition)
	{
		$select = $this->select();
		if($condition[1] != null)
		{
			if($condition[1] == 'postName')
			{
				$select->setIntegrityCheck(false)
						->from(array('p'=>'ge_posts'),array('name'))
						->join(array('c'=>'em_cpp'),'p.postId = c.postId')
						->where('p.name like ?','%'.$key.'%')
						->where('c.projectId = ?',$condition[0]);
				}
				elseif($condition[1] == 'name')
				{
					$select->setIntegrityCheck(false)
							->from(array('e'=>'em_contacts'),array('name'))
							->join(array('c'=>'em_cpp'),'e.contactId = c.contactId')
							->where('e.name like ?','%'.$key.'%')
							->where('c.projectId = ?',$condition[0])
							->order('postId');
					}
			}
			else
			{
				$select->where('projectId = ?',$condition[0])
						->order('postId');
				}
		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
	
	public function fetchAllJoin($key, $condition)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('c' => 'em_cpp'))
						->join(array('e'=>'em_contacts'),'e.contactId = c.contactId',array('contactName'))
						->join(array('g'=>'ge_posts'),'g.postId = c.postId', array('postName'))
						->join(array('p'=>'pm_projects'), 'p.projectId = c.projectId', array('name'));
		
		if($condition[1] != null)
		{
		
			if($condition[1] == "postName")
			{
				$select->where('g.postName like ?','%'.$key.'%');
				}
				elseif($condition[1] == "name")
				{
					$select->where('e.contactName like ?','%'.$key.'%');
					}
				}
		$select->where('c.projectId = ?', $condition[0]);
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
		}
}
?>
