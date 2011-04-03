<?php

/* create by lxj
   2011-03-28   v 1.1
 */

class General_Models_DbTable_Title extends Zend_Db_Table_Abstract
{
	protected $_name = 'ge_titles';

	public function getTitle($titleId)
	{
		$titleId = (int)$titleId;
		$row = $this->fetchRow('titleId = ' . $titleId);
		if (!$row) {
			throw new Exception("Could not find row $");
		}
		return $row->toArray();
	}

	public function addTitle(
								$titleId,
								$name
								)
	{
		$data = array (			
			'titleId' => $titleId,
			'name' => $name
		);
		$this->insert($data);
	}

	public function updateTitle(
								$titleId,
								$name
								)
	{
		$data = array (
			'titleId' => $titleId,
			'name' => $name
		);
		$this->update($data, 'titleId = ' . (int)$titleId);
	}

	public function deleteTitle($titleId)
	{
		$this->delete('titleId = ' . (int)$titleId);
	}
}
?>