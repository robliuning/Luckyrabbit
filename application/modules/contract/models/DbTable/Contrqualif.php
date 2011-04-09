<?php

/* create by lxj
   2011-04-08   v 0.2
   rewrite by lxj
   2011-04-09   v 0.2
   */

class Contract_Models_DbTable_Contract extends Zend_Db_Table_Abstract
{
    protected $_name = 'sc_contr_qualif'; 

	public function getContrqualif($cqId)
	{
		$cqId = (int)$cqId;
		$row = $this->fetchRow('cqId = ' . $cqId);
		if (!$row) {
			throw new Exception("Could not find row $cqId");
		}
		return $row->toArray();
	}

	public function addContrqualif(
								$contractorId,
								$qualifSerie,
								$qualifType,
								$qualifGrade
								)
	{
		$data = array (
			'contractorId' => $contractorId,
			'qualifSerie' => $qualifSerie,
			'qualifType' => $qualifType,
			'qualifGrade' => $qualifGrade
		);
		$this->insert($data);
	}

	public function updateContrqualif(
								$cqId,
								$contractorId,
								$qualifSerie,
								$qualifType,
								$qualifGrade,
								)
	{
		$data = array (
			'cqId' => $cqId,
			'contractorId' => $contractorId,
			'qualifSerie' => $qualifSerie,
			'qualifType' => $qualifType,
			'qualifGrade' => $qualifGrade
		);

		$this->update($data, 'cqId = '.(int)$cqId);
	}

	public function deleteContrqualif($cqId)
	{
		$this->delete('cqId = '.(int)$cqId);
	}

}

?>
