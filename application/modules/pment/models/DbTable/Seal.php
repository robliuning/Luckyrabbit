<?php
//Updated on 31th May by Rob

class Pment_Models_DbTable_Seal extends Zend_Db_Table_Abstract
{
	protected $_name = 'pm_seals';

	public function fetchAllJoin($key, $condition)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('p' => 'pm_seals'))
						->join(array('e'=>'em_contacts'),'e.contactId = p.contactId',array('contactName'));
		if($condition[1] != null)
		{
			if($condition[1] == "name")
			{
				$select->where('p.name like ?','%'.$key.'%');
				}
				elseif($condition[1] == "date")
				{
					$select->where('p.sealDate = ?',$key);
					}
				}
		$select->where('p.projectId = ?',$condition[0]);
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
		}

}
?>