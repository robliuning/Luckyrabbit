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
	
	public function Search($key, $condition)
	{
		$select = $this->select();
		if($condition[1] != null)
		{
			if($condition[1] == "contractorName")
			{
					$select->setIntegrityCheck(false)
						->from(array('c'=>'sc_contractors'),array('name'))
						->join(array('s'=>'sc_subcontracts'),'c.contractorId = s.contractorId')
						->where('c.name like ?','%'.$key.'%')
						->where('s.projectId = ?',$condition[0]);
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
