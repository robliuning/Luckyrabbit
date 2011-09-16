<?php
//Updated on 31th May by Rob

class Pment_Models_DbTable_Comment extends Zend_Db_Table_Abstract
{
	protected $_name = 'mm_comments';

	public function fetchAllComments($mtrId)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('m' => 'mm_comments'))
						->join(array('e'=>'em_contacts'),'e.contactId = m.contactId',array('contactName'))
						->where('m.mtrId = ?',$mtrId)
						->order('m.addDate DESC');
		$resultSet = $this->fetchAll($select);
		return $resultSet;
		}
}
?>