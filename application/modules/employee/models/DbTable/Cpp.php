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
		
	public function fetchAllJoin($data,$condition) //check
	{
		$select = $this->select();
		if($condition == "projectId")
		{
			$select->where("projectId = ?",$data);
			}
		elseif($condition == "postId")
		{
			$select->where("postId = ?",$data);
			}
		elseif($condition == "contactId")
		{
			$select->where("contactId = ?",$data);
			}

    	$resultSet = $this->fetchAll($select);
		return $resultSet;
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
}
?>
