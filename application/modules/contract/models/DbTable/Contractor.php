<?php
//updated in 13th June by Rob

class Contract_Models_DbTable_Contractor extends Zend_Db_Table_Abstract
{
	protected $_name = 'sc_contractors'; 

	public function findArrayContract($contractorId)
	{
		$contractorId = (int)$contractorId;
		$row = $this->fetchRow('contractorId = ' . $contractorId);
		if (!$row) {
			throw new Exception("Could not find row $contractorId");
		}
		return $row->toArray();
	}

	public function search($key, $condition)
	{
		$select = $this->select();
		if($condition == "name")
		{
			$select->where("name like ?",'%'.$key.'%');
			}
			elseif($condition == "contact")
			{
				$select->where("contact like ?",'%'.$key.'%');
				}

		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
	
	public function findContractorName($id)
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from('sc_contractors',array('name'))
			->where('contractorId = ?',$id);
			
		$entries = $this->fetchAll($select);
		
		return $entries;
		}
		
	public function fetchAllJoin($key, $condition)
	{
		$select = $this->select()
						->from(array('s'=>'sc_contractors'));
		if($condition == "name")
		{
			$select->where("s.name like ?",'%'.$key.'%');
			}
			elseif($condition == "contact")
			{
				$select->where("s.contact like ?",'%'.$key.'%');
				}
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
	}
	
	public function fetchAllContractorIds()
	{
		$select = $this->select()
						->from(array('s'=>'sc_contractors'));
		$resultSet = $this->fetchAll($select);
		return $resultSet;
		}
}

?>
