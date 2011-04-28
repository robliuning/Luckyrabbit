<?php

/*create by lxj
  date 2011.3.28
  rewrite by lxj rob
  date 2011.4.7
  rewrite by lxj
  date 2011-04-08  v 0.2
  */

class Contract_Models_DbTable_Subcontract extends Zend_Db_Table_Abstract
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
		if($condition == "projectName")
		{
				$select->setIntegrityCheck(false)
						->from(array('p'=>'pm_projects'),array('name'))
						->join(array('s'=>'sc_subcontracts'),'p.projectId = s.projectId')
						->where('p.name like ?','%'.$key.'%');
			}
			elseif($condition == "contractorName")
			{
				$select->setIntegrityCheck(false)
						->from(array('c'=>'sc_contractors'),array('name'))
						->join(array('s'=>'sc_subcontracts'),'c.contractorId = s.contractorId')
						->where('c.name like ?','%'.$key.'%');
				}
				elseif($condition == "projectId")
				{
					$select->where("projectId = ?",$key);
					}
    		$resultSet = $this->fetchAll($select);
			return $resultSet;
	}
}
?>
