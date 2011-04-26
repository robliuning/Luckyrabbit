<?php
  //creation date 15-04-2011
  //creating by lincoy
  //completion date 15-04-2011

class General_Models_DbTable_Site extends Zend_Db_Table_Abstract
{
    protected $_name = 'ge_sites';
	
	public function findSiteName($id)
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from('ge_sites',array('name'))
			->where('siteId = ?',$id);
			
   		$entries = $this->fetchAll($select);
   		
   		return $entries;
	}
}
?>