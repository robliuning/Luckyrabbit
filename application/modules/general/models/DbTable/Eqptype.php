<?php

/*write by lxj
 2011-04-17 v0.2
 */

class General_Models_DbTable_EqpType extends Zend_Db_Table_Abstract
{
    protected $_name = 'ge_eqptypes';

    public function findTypeName($id)
    {
    	$select = $this->select()
			->setIntegrityCheck(false)
			->from('ge_eqptypes',array('name'))
			->where('typeId = ?',$id);
			
   		$entries = $this->fetchAll($select);
   		
   		return $entries;
    	}
}
?>
