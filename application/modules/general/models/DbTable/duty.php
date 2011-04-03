<?php

/* create by lxj
   2011-03-28   v 1.1
 */

class General_Models_DbTable_Duty extends Zend_Db_Table_Abstract
{
	protected $_name = 'ge_duties';

	public function getDuty($dutyId)
	{
		$dutyId = (int)$dutyId;
		$row = $this->fetchRow('duytId = ' . $dutyId);
		if (!$row) {
			throw new Exception("Could not find row $dutyId");
		}
		return $row->toArray();
	}

	public function addDuty(
								$dutyId,
								$name
								)
	{
		$data = array (
			'dutyId' => $dutyId,
			'name' => $name
		);
		$this->insert($data);
	}

	public function updateDuty(
								$dutyId,
								$name
								)
	{
		$data = array (
			'dutyId' => $dutyId,
			'name' => $name
		);
		$this->update($data, 'dutyId = ' . (int)$dutyId);
	}

	public function deleteDuty($dutyId)
	{
		$this->delete('dutyId = ' . (int)$dutyId);
	}
}

?>
