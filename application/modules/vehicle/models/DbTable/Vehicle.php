<?php
  //creation date 09-04-2011
  //creating by lincoy
  //completion date 09-04-2011

  
class Vehicle_Models_DbTable_Vehicle extends Zend_Db_Table_Abstract
{
    protected $_name = 've_vehicles';

	public function search($key, $condition)
	{
		$select = $this->getDbTable()->select()
			           ->setIntegrityCheck(false)	
			           ->from(array('e'=>'em_contacts'),array('name'))
			           ->join(array('v'=>'ve_vehicles'),'e.contactId = v.veId');
		if($condition == "plateNo")
		{
			$select->where("plateNo like ?","%$key%");
		}

    	$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
}
?>


