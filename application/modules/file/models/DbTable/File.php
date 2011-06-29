<?php
//updated in 23th Jun by rob

class File_Models_DbTable_File extends Zend_Db_Table_Abstract
{
	protected $_name = 'fm_files'; 

	public function Search($key, $condition)
	{
		$select = $this->select();
		if($condition[1] != null)
		{
			if($condition[1] == "fileId")
			{
				$select->where('fileId like ?','%'.$key.'%')
						->where('specId = ?',$condition[0]);
				}
				elseif($condition[1] == 'display')
				{
					$select->where('display like ?','%'.$key.'%')
							->where('specId = ?',$condition[0]);
					}
					elseif($condition[1] == 'edition')
					{
						$select->where('edition like ?','%'.$key.'%')
								->where('specId = ?',$condition[0]);
						}
			}
			else
			{
				$select->where('specId = ?',$condition[0]);
				}
			$resultSet = $this->fetchAll($select);
			return $resultSet;
	}
}
?>
