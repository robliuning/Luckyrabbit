<?php
//Updated on 31th May by Rob

class Pment_Models_DbTable_Bhistory extends Zend_Db_Table_Abstract
{
	protected $_name = 'mm_bhistory';
	
	public function fetchAllBhistories($planId,$status)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('p' => 'mm_bhistory'))
						->join(array('e'=>'em_contacts'),'e.contactId = p.contactId',array('contactName'))
						->where('p.planId = ?',$planId)
						->where('p.status = ?',$status)
						->order('p.editDate DESC');
		$resultSet = $this->fetchAll($select);
		return $resultSet;
		}
}
?>