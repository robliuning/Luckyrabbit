<?php
//updated in 14th July by Rob

class System_Models_DbTable_Improvement extends Zend_Db_Table_Abstract
{
	protected $_name = 'sy_improvements';
	
	public function search($key,$condition)
	{
		$select = $this->select();
		if($condition == "typeName")
		{
			$select->setIntegrityCheck(false)
				->from(array('t' => 'sy_imptypes'),array('impName'))
				->join(array('i' => 'sy_improvements'),'i.typeId = t.id')
				->where('t.name like ?','%'.$key.'%');
			}
			elseif($condition == "modName")
			{
				$select->setIntegrityCheck(false)
					->from(array('t' => 'sy_modnames'),array('cName'))
					->join(array('i' => 'sy_improvements'),'i.modId = t.modId')
					->where('ve.plateNo like ?','%'.$key.'%');
				}
		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
	
	public function fetchAllJoin($key, $condition)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('i' => 'sy_improvements'))
						->join(array('u'=>'sy_users'),'i.userId = u.id')
						->join(array('e'=>'em_contacts'),'e.contactId = u.contactId',array('contactName'))
						->join(array('m'=>'sy_modnames'),'i.modId = m.modId',array('cName'))
						->join(array('t'=>'sy_imptypes'),'i.typeId = t.id',array('impName'));

		if($condition == "modName")
		{
			$select->where('m.modName like ?','%'.$key.'%');
			}
			elseif($condition == "typeName")
			{
				$select->where('t.impName like ?','%'.$key.'%');
				}
		
		$paginator = Zend_Paginator::factory($select);
		return $paginator;

	}
}
?>
