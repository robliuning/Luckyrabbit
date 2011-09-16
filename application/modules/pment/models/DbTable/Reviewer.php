<?php
//Updated on 31th May by Rob

class Pment_Models_DbTable_Reviewer extends Zend_Db_Table_Abstract
{
	protected $_name = 'mm_reviewers';

	public function fetchAllJoin($key, $condition)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('p' => 'mm_reviewers'))
						->join(array('e'=>'em_contacts'),'e.contactId = p.contactId',array('contactName'));
		if($condition = 'planId')
		{
			$select->where('p.planId = ?',$key);
			}
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
		}
	
	public function findReviewer($planId,$contactId)
	{
		$select = $this->select()
						->where('planId = ?',$planId)
						->where('contactId = ?',$contactId);
		$resultSet = $this->fetchAll($select);
		return $resultSet;	}

	public function fetchAllNames($planId)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('p' => 'mm_reviewers'))
						->join(array('e'=>'em_contacts'),'e.contactId = p.contactId',array('contactName'))
						->where('p.planId = ?',$planId);
		$resultSet = $this->fetchAll($select);
		return $resultSet;
		}
		
	public function fetchAllIds($planId)
	{
		$select = $this->select()
						->from("mm_reviewers",array("contactId"))
						->where('planId = ?',$planId);
		$resultSet = $this->fetchAll($select);
		return $resultSet;
		}
}
?>