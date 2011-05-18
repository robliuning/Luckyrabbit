<?php
  
 /*write by lxj
 2011-04-16   v0.2*/

class Equipment_Models_DbTable_Plan extends Zend_Db_Table_Abstract
{
    protected $_name = 'eq_plans';
	
	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'planType')
		{
			$select->where('planType like ?','%'.$key.'%');
			}
			elseif($condition == 'projectName')
			{
				$select->setIntegrityCheck(false)
						->from(array('p'=> 'pm_projects'),array('name'))
						->join(array('e'=>'eq_plans'),'p.projectId = e.projectId')
						->where('p.name like ?','%'.$key.'%');
				}
				elseif($condition == 'applicName')
				{
                   $select->setIntegrityCheck(false)
						->from(array('e'=> 'em_contacts'),array('name'))
						->join(array('q'=>'eq_plans'),'e.contactId = q.applicId')
						->where('e.name like ?','%'.$key.'%');				
				   }
					
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>