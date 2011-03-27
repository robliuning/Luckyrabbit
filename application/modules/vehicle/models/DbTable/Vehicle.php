<?php
/*
created by lincoy
time of creating 3-27-2011
completed time 3-27-2011
*/

class Application_Model_DbTable_Vehicle extends Zend_Db_Table_Abstract
{
    protected $_name = 've_vehicle';

	public function getVehicle($vehicle)
	{
		$plateNo = (string)$plateNo;   //���ƺ�
		$row = $this->fetchRow('plateNo = ' . $plateNo);
		if (!$row) {
			throw new Exception("Could not find row $plateNo");
		}
		return $row->toArray();
	}

	public function addVehicles(
								$plateNo,
		                        $name,
		                        $license,
		                        $personIC,
		                        $users,
		                        $fuelCons,
		                        $remark)
	{
		$data = array (
		    'plateNo' => $plateNo,
		    'name' => $name,
		    'license' => $license
			'personIC' => $personIC,
		    'users' => $users,
		    'fuelCons' => $fuelCons,
		    'remark' => $remark
		);
		$this->insert($data);
	}

	public function updateVehicle(
								$plateNo,
		                        $name,
		                        $license,
		                        $personIC,
		                        $users,
		                        $fuelCons,
		                        $remark)
	{
		$data = array (
		    'plateNo' => $plateNo,
		    'name' => $name,
		    'license' => $license
			'personIC' => $personIC,
		    'users' => $users,
		    'fuelCons' => $fuelCons,
		    'remark' => $remark
		);
		$this->update($data, 'plateNo = ' . (string)$plateNo);
	}

	public function deleteVehicle($plateNo)
	{
		$this->delete('plateNo = ' . (string)$plateNo);
	}
}
?>