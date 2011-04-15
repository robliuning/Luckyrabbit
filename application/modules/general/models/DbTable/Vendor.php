<?php
  //creation date 15-04-2011
  //creating by lincoy
  //completion date 15-04-2011

class General_Models_DbTable_Vendor extends Zend_Db_Table_Abstract
{
    protected $_name = 'ge_vendors';
	
	public function findVenName($id)
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from('ge_vendors',array('name'))
			->where('venId = ?',$id);
			
   		$entries = $this->fetchAll($select);
   		
   		return $entries;
	}
}
?>