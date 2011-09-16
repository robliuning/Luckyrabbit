<?php
//updated in 9th June by luoxinji

class System_Models_DbTable_Online extends Zend_Db_Table_Abstract
{
	protected $_name = 'sy_uonlines'; 
	
	public function fetchAllJoin($key, $condition)
	{
		$select = $this->select()
					->setIntegrityCheck(false)
					->from(array('c' => 'em_contacts'), array('contactName'))
					->join(array('u' => 'sy_users'), 'c.contactId = u.contactId')
					->join(array('s' => 'sy_uonlines'), 'u.id = s.userId');
		if($condition != null)
		{
			if($condition == 'contactName')
			{
				$select->where('c.contactName like ?', '%'.$key.'%');
			}
		}
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
	}
}
?>