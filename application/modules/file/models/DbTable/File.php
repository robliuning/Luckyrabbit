<?php
//updated in 23th Jun by rob

class File_Models_DbTable_File extends Zend_Db_Table_Abstract
{
	protected $_name = 'fm_files'; 

	public function fetchAllJoin($key, $condition)
	{
		$select = $this->select()
					->setIntegrityCheck(false)
					->from(array('f'=>'fm_files'),array('file_id','file_name','file_display','file_size','file_type','file_edition','contactId','file_inFlag','file_projFlag','projectId','file_status','file_parent'))
					->join(array('c'=>'em_contacts'),'f.contactId = c.contactId',array('contactName'))
					->where('specId = ?',$condition[0]);
		if($condition[1] != null)
		{
			if($condition[1] == "fileId")
			{
				$select->where('file_id like ?','%'.$key.'%');
				}
				elseif($condition[1] == 'display')
				{
					$select->where('file_display like ?','%'.$key.'%');
					}
					elseif($condition[1] == 'edition')
					{
						$select->where('file_edition like ?','%'.$key.'%');
						}
			}
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
		}
}
?>
