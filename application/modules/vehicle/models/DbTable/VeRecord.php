<?php
/*
created by lincoy
time of creating 3-27-2011
completed time 3-27-2011
*/

class Application_Model_DbTable_VeRecord extends Zend_Db_Table_Abstract
{
    protected $_name = 've_verecord';

	public function getVeRecord($VeRecord)
	{
		$recordID = (int)$recordID;
		$row = $this->fetchRow('recordID = ' . $recordID);
		if (!$row) {
			throw new Exception("Could not find row $recordID");
		}
		return $row->toArray();
	}

	public function addVeRecord(
								$recordID,
		                        $name,
		                        $dateOfUse,
		                        $purpose,
		                        $milesBf,
		                        $milesAf,
		                        $pilot,
		                        $otherUsers,
		                        $remark)
	{
		$data = array (
		    'recordID' => $recordID,
		    'name' => $name,
		    'dateOfUse' => $dateOfUse
			'purpose' => $purpose,
		    'milesBf' => $milesBf,
		    'milesAf' => $milesAf,
		    'pilot' => $pilot,
		    'otherUsers' => $otherUsers,
		    'remark' => $remark
		);
		$this->insert($data);
	}

	public function updateVeRecord(
								$recordID,
		                        $name,
		                        $dateOfUse,
		                        $purpose,
		                        $milesBf,
		                        $milesAf,
		                        $pilot,
		                        $otherUsers,
		                        $remark)
	{
		$data = array (
		    'recordID' => $recordID,
		    'name' => $name,
		    'dateOfUse' => $dateOfUse
			'purpose' => $purpose,
		    'milesBf' => $milesBf,
		    'milesAf' => $milesAf,
		    'pilot' => $pilot,
		    'otherUsers' => $otherUsers,
		    'remark' => $remark
		);
		$this->update($data, 'recordID = ' . (int)$recordID);
	}

	public function deleteVeRecord($recordID)
	{
		$this->delete('recordID = ' . (int)$recordID);
	}
}
?>