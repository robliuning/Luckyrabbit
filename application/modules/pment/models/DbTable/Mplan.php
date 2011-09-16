<?php
//updated in 4th July by Rob

class Pment_Models_DbTable_Mplan extends Zend_Db_Table_Abstract
{
	protected $_name = 'mm_mplans';
	
	public function fetchAllJoin($key,$condition)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('m' => 'mm_mplans'))
						->join(array('e'=>'em_contacts'),'e.contactId = m.contactId',array('contactName'))
						->joinLeft(array('c'=>'em_contacts'),'c.contactId = m.approvcId',array('approvName' => 'contactName'))
						->joinLeft(array('o'=>'em_contacts'),'o.contactId = m.approvfId',array('approvfName'=>'contactName'))
						->join(array('s'=>'ge_mtr_status'),'s.statusId = m.status',array('statusName'))
						->join(array('t'=>'ge_ptypes'),'t.typeId = m.typeId',array('typeName'));
		if($condition[1] != null)
		{
			if($condition[1] == "status")
			{
				if($key == 'a')
				{
					$select->where('m.status = 0');
					}
					elseif($key == 'b')
					{
						$select->where('m.status > 0');
						$select->where('m.status < 6');
						}
					elseif($key == 'c')
					{
						$select->where('m.status = 1');
						}
					elseif($key == 'd')
					{
						$select->where('m.status = 2');
						}
					elseif($key == 'e')
					{
						$select->where('m.status = 4');
						}
					elseif($key == 'f')
					{
						$select->where('m.status = 3 or m.status = 5');
						}
					elseif($key == 'g')
					{
						$select->where('m.status = 3');
						}
					elseif($key == 'h')
					{
						$select->where('m.status = 5');
						}
					elseif($key == 'i')
					{
						$select->where('m.status = 6');
						}
				}
			}
		$select->where('m.projectId = ?',$condition[0])
				->order('m.status')
				->order('m.pDate DESC');
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
	}
	
	public function fetchAllValidations($contactId)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('r' => 'mm_reviewers'))
						->join(array('m'=>'mm_mplans'),'r.planId = m.planId',array('m.planId','m.planName','m.typeId','m.projectId','m.yearNum','m.monNum','m.pDate','m.contactId'))
						->join(array('p'=>'pm_projects'),'p.projectId = m.projectId',array('name'))
						->join(array('e'=>'em_contacts'),'e.contactId = m.contactId',array('contactName'))
						->join(array('t'=>'ge_ptypes'),'t.typeId = m.typeId',array('typeName'))
						->where('r.contactId = ?',$contactId)
						->where('r.status = 0')
						->where('m.status = 3');
		$resultSet = $this->fetchAll($select);
		return $resultSet;
		}
}
?>