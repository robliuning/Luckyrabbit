<?php
//updated in 22th Jun by rob

class Pment_Models_DbTable_Subcontract extends Zend_Db_Table_Abstract
{
	protected $_name = 'sc_subcontracts'; 

	public function findArraySubcontract($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('scontrId = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}
	
	public function fetchAllJoin($key,$condition)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('s' => 'sc_subcontracts'))
						->join(array('c'=>'sc_contractors'),'c.contractorId = s.contractorId',array('name'));
		
		if($condition[1] != null)
		{
		
			if($condition[1] == "contractorName")
			{
					$select->where('c.name like ?','%'.$key.'%');
				}
				}
		$select->where('s.projectId = ?', $condition[0]);
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
		}
}
?>
