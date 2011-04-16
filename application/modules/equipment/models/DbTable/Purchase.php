<?php
  
/*write by lxj
 2011-04-16 v0.2*/

class Equipment_Models_DbTable_Purchase extends Zend_Db_Table_Abstract
{
    protected $_name = 'eq_purchases';
	
	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'purDate')
		{
			$select->where('purDate like ?','%'.$key.'%');
			}
			elseif($condition == 'projectName')
			{
				$select->setIntegrityCheck(false)
						->from(array('p'=> 'pm_projects'),array('name'))
						->join(array('e'=>'eq_purchases'),'p.projectId = e.projectId')
						->where('p.name like ?','%'.$key.'%');
				}
				elseif($condition == 'venName')
				{
                   $select->setIntegrityCheck(false)
						->from(array('g'=> 'ge_vendors'),array('name'))
						->join(array('e'=>'eq_purchases'),'e.venId = g.venId')
						->where('g.name like ?','%'.$key.'%');				
				   }
				   elseif($condition == 'buyerName')
					{
					   $select->setIntegrityCheck(false)
						->from(array('e'=> 'em_contacts'),array('name'))
						->join(array('q'=>'eq_purchases'),'e.contactId = q.buyerId')
						->where('e.name like ?','%'.$key.'%');
						}
						elseif($condition == 'approvName')
						{
							 $select->setIntegrityCheck(false)
								->from(array('e'=> 'em_contacts'),array('name'))
								->join(array('q'=>'eq_purchases'),'e.contactId = q.approvId')
								->where('e.name like ?','%'.$key.'%');
								}
					
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>