<?php

/*create by lxj
  date 2011.3.28
  rewrite by lxj rob
  date 2011.4.7
  */

class Employee_Models_DbTable_Cpp extends Zend_Db_Table_Abstract
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
		
		if($condition == 'name')
		{
			$select->setIntegrityCheck(false)
						->from(array('c'=> 'em_contacts'),array('name'))
						->join(array('e'=>'em_cpp'),'c.contactId = e.contactId')
						->where('c.name like ?','%'.$key.'%');
			}
			elseif($condition == 'projectName')
			{
				$select->setIntegrityCheck(false)
						->from(array('p'=> 'pm_projects'),array('name'))
						->join(array('e'=>'em_cpp'),'p.projectId = e.projectId')
						->where('p.name like ?','%'.$key.'%');
				}
				elseif($condition == 'dutyName')
				{
                   $select->setIntegrityCheck(false)
						->from(array('p'=> 'ge_posts'),array('name'))
						->join(array('e'=>'em_cpp'),'p.postId = e.postId')
						->where('p.name like ?','%'.$key.'%');				
				   }
					
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>
