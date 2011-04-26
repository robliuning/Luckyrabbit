<?php
  //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011

class General_Models_DbTable_Pentype extends Zend_Db_Table_Abstract
{
    protected $_name = 'ge_pentypes';
	
	public function findPentypeName($id)
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from('ge_pentypes',array('name'))
			->where('typeId = ?',$id);
			
   		$entries = $this->fetchAll($select);
   		
   		return $entries;
	}
	
	public function fetchAllNames() 
	{
		$select = $this->select()
				->setIntegrityCheck(false)
				->from('ge_pentypes',array('typeId','name'));
		$entries = $this->fetchAll($select);
		
		return $entries;	
		}
}
?>