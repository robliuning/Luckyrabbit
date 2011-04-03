<?php

/* create by lxj
   date: 2011-03-28   v 1.1
   reviewed by rob 2011.4.3
 */

class General_Models_DbTable_Dept extends Zend_Db_Table_Abstract
{
	protected $_name = 'ge_depts';

	public function getDept($deptId)
	{
		$deptId= (int)$deptId;
		$row = $this->fetchRow('deptId = ' . $deptId);
		if (!$row) {
			throw new Exception("Could not find row $deptId");
		}
		return $row->toArray();
	}

	public function addDept(
								$deptId,
								$name
								)
	{
		$data = array (
			'deptId' => $deptId,
			'name' => $name
		);
		$this->insert($data);
	}

	public function updateDept(
								$deptId,
								$name
								)
	{
		$data = array (
			'deptId' => $deptId,
			'name' => $name
		);
		$this->update($data, 'deptId = ' . (int)$deptId);
	}

	public function deleteDept($deptId)
	{
		$this->delete('deptId = ' . (int)$deptId);
	}
}

?>