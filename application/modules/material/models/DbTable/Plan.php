<?php
  //creation date 15-04-2011
  //creating by lincoy
  //completion date 15-04-2011

class Material_Models_DbTable_Plan extends Zend_Db_Table_Abstract
{
    protected $_name = 'mm_plans';
	
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
						->join(array('m'=>'mm_plans'),'p.projectId = m.projectId')
						->where('p.name like ?','%'.$key.'%');
				}
				elseif($condition == 'applicName')
				{
                   $select->setIntegrityCheck(false)
						->from(array('e'=> 'em_contacts'),array('name'))
						->join(array('g'=>'mm_plans'),'e.contactId = g.applicId')
						->where('e.name like ?','%'.$key.'%');				
				   }
				   elseif($condition == 'approvName')
					{
					   $select->setIntegrityCheck(false)
						->from(array('e'=> 'em_contacts'),array('name'))
						->join(array('m'=>'mm_plans'),'e.contactId = m.approvId')
						->where('e.name like ?','%'.$key.'%');
						}
					
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>