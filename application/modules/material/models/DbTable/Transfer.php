<?php
  //creation date 16-04-2011
  //creating by lincoy
  //completion date 16-04-2011

class Material_Models_DbTable_Transfer extends Zend_Db_Table_Abstract
{
    protected $_name = 'mm_transfers';
	
	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'trsDate')
		{
			$select->where('trsDate like ?','%'.$key.'%');
			}
			elseif($condition == 'projectName')
			{
				$select->setIntegrityCheck(false)
						->from(array('p'=> 'pm_projects'),array('name'))
						->join(array('m'=>'mm_transfers'),'p.projectId = m.projectId')
						->where('p.name like ?','%'.$key.'%');
				}
				elseif($condition == 'applicName')
				{
                   $select->setIntegrityCheck(false)
						->from(array('e'=> 'em_contacts'),array('name'))
						->join(array('m'=>'mm_transfers'),'e.contactId = m.applicId')
						->where('e.name like ?','%'.$key.'%');				
				   }
				   elseif($condition == 'approvName')
					{
					   $select->setIntegrityCheck(false)
						->from(array('e'=> 'em_contacts'),array('name'))
						->join(array('m'=>'mm_transfers'),'e.contactId = m.approvId')
						->where('e.name like ?','%'.$key.'%');
						}
						elseif($condition == 'origName')
						{
							$select->setIntegrityCheck(false)
								->from(array('g'=> 'ge_sites'),array('name'))
								->join(array('m'=>'mm_exports'),'m.origId = g.siteId')
								->where('g.name like ?','%'.$key.'%');
							 }
							elseif($condition == 'destName')
							{
								 $select->setIntegrityCheck(false)
									->from(array('g'=> 'ge_sites'),array('name'))
									->join(array('m'=>'mm_exports'),'m.destId = g.siteId')
									->where('g.name like ?','%'.$key.'%');
									}

					
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>