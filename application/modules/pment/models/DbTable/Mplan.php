<?php
//updated in 4th July by Rob

class Pment_Models_DbTable_Mplan extends Zend_Db_Table_Abstract
{
	protected $_name = 'mm_mplans';
	
	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition[1] != null)
		{
			if($condition[1] == 'contactName')
			{
				$select->setIntegrityCheck(false)
						->from(array('e'=> 'em_contacts'),array('name'))
						->join(array('g'=>'mm_mplans'),'e.contactId = g.contactId')
						->where('e.name like ?','%'.$key.'%')
						->where('g.projectId =?',$condition[0]);
						}
			}
			else
			{
				$select->where('projectId = ?',$condition[0]);
				}
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>