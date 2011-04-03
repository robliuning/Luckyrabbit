<?php
  //creation date 03-4-2011
  //creating by lincoy
  //completion date 03-04 -2011


class General_Models_DbTable_Structype extends Zend_Db_Table_Abstract
{
	protected $_name = 'ge_structype';

	public function getStructype($strucTypesId)
	{
		$strucTypesId = (int)$strucTypesId;
		$row = $this->fetchRow('strucTypesId = ' . $strucTypesId);
		if (!$row) {
			throw new Exception("Could not find row $");
		}
		return $row->toArray();
	}

	public function addStructype(
								$strucTypesId,
								$name
								)
	{
		$data = array (			
			'strucTypesId' => $strucTypesId,
			'name' => $name
		);
		$this->insert($data);
	}

	public function updateStructype(
								$strucTypesId,
								$name
								)
	{
		$data = array (
			'strucTypesId' => $strucTypesId,
			'name' => $name
		);
		$this->update($data, 'strucTypesId = ' . (int)$strucTypesId);
	}

	public function deleteStructype($strucTypesId)
	{
		$this->delete('strucTypesId = ' . (int)$strucTypesId);
	}
}
?>