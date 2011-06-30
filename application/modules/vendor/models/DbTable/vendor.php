<?php
//updated in 13th June by Rob

class Vendor_Models_DbTable_Vendor extends Zend_Db_Table_Abstract
{
	protected $_name = 'mm_vendors'; 

	public function Search($key, $condition)
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
}
?>
