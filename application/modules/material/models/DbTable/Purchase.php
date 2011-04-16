<?php
  //creation date 15-04-2011
  //creating by lincoy
  //completion date 15-04-2011

class Material_Models_DbTable_Purchase extends Zend_Db_Table_Abstract
{
    protected $_name = 'mm_purchases';
	
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
						->join(array('m'=>'mm_plans'),'p.projectId = m.projectId')
						->where('p.name like ?','%'.$key.'%');
				}
				elseif($condition == 'venName')
				{
                   $select->setIntegrityCheck(false)
						->from(array('mv'=> 'mm_vendors'),array('name'))
						->join(array('mp'=>'mm_purchases'),'mp.venId = mv.venId')
						->where('mv.name like ?','%'.$key.'%');				
				   }
				   elseif($condition == 'buyerName')
					{
					   $select->setIntegrityCheck(false)
						->from(array('e'=> 'em_contacts'),array('name'))
						->join(array('m'=>'mm_purchases'),'e.contactId = m.buyerId')
						->where('e.name like ?','%'.$key.'%');
						}
						elseif($condition == 'approvName')
						{
							 $select->setIntegrityCheck(false)
								->from(array('e'=> 'em_contacts'),array('name'))
								->join(array('m'=>'mm_purchases'),'e.contactId = m.approvId')
								->where('e.name like ?','%'.$key.'%');
								}
					
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>