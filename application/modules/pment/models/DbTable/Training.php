<?php
//Updated on 31th May by Rob

class Pment_Models_DbTable_Training extends Zend_Db_Table_Abstract
{
	protected $_name = 'pm_trainings';

	public function search($key,$condition)
	{
		$select = $this->select();
		if($condition[1] != null)
		{
			if($condition[1] == 'name')
			{
				$select->where('name like ?','%'.$key.'%')
						->where('projectId = ?',$condition[0]);
				}
				elseif($condition[1] == 'date')
				{
 						$select->where('traDate = ?',$key)
						->where('projectId = ?',$condition[0]);
					}
			}
			else
			{
				$select->where('projectId = ?',$condition[0]);
				}
		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
	
	public function fetchAllJoin($key, $condition)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('p' => 'pm_trainings'))
						->join(array('e'=>'em_contacts'),'e.contactId = p.contactId',array('contactName'));
		if($condition[1] != null)
		{
			if($condition[1] == "name")
			{
				$select->where('p.name like ?','%'.$key.'%');
				}
				elseif($condition[1] == "date")
				{
				$select->where('p.traDate = ?',$key);
					}
				}
		$select->where('p.projectId = ?',$condition[0]);
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
		}

}
?>