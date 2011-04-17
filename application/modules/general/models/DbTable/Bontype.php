<?php
  //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011

class General_Models_DbTable_Bontype extends Zend_Db_Table_Abstract
{
    protected $_name = 'ge_bontypes';
	
	public function findBontypeName($id)
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from('ge_bontypes',array('name'))
			->where('typeId = ?',$id);
			
   		$entries = $this->fetchAll($select);
   		
   		return $entries;
	}
}
?>