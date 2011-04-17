<?php

/*write by lxj
  2011-04-16 v0.2*/

class Equipment_Models_DbTable_Transfer extends Zend_Db_Table_Abstract
{
    protected $_name = 'eq_transfers';
	
	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'trsDate')
		{
			$select->where('startDate like ?','%'.$key.'%');
			}
			elseif($condition == 'projectName')
			{
				$select->setIntegrityCheck(false)
						->from(array('p'=> 'pm_projects'),array('name'))
						->join(array('e'=>'eq_transfers'),'p.projectId = e.projectId')
						->where('p.name like ?','%'.$key.'%');
				}
				elseif($condition == 'origName')
				{
                   $select->setIntegrityCheck(false)
						->from(array('g'=> 'ge_sites'),array('name'))
						->join(array('e'=>'eq_transfers'),'e.siteId = g.origId')
						->where('g.name like ?','%'.$key.'%');				
				   }
				   elseif($condition == 'DestName')
					{
					   $select->setIntegrityCheck(false)
						->from(array('g'=> 'ge_sites'),array('name'))
						->join(array('e'=>'eq_transfers'),'g.siteId = e.destId')
						->where('g.name like ?','%'.$key.'%');
						}
						elseif($condition == 'approvName')
						{
							$select->setIntegrityCheck(false)
								->from(array('e'=> 'em_contacts'),array('name'))
								->join(array('q'=>'eq_transfers'),'e.contactId = q.approvId')
								->where('e.name like ?','%'.$key.'%');
								}
								elseif($condition == 'applicName')
								{
									$select->setIntegrityCheck(false)
										->from(array('e'=> 'em_contacts'),array('name'))
										->join(array('q'=>'eq_transfers'),'e.contactId = q.applicId')
										->where('e.name like ?','%'.$key.'%');
										}
										elseif($condition == 'planType')
										{
											$select->where('planType like ?','%'.$key.'%');
										}


					
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>