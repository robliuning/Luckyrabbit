<?php
  //creation date 09-04-2011
  //creating by lincoy
  //completion date

  
class Vehicle_Models_DbTable_Verecord extends Zend_Db_Table_Abstract
{
    protected $_name = 've_verecords';

	public function fetchAllJoin($data = null,$condition=null)
	{
		$select = $this->select()
			->from(array('ve => ve_vehicles'),array('plateNo','contactId'))
			->join(array('re => ve_verecords'),'ve.veId = re.veId');

		if($condition == 'plateNo')
		{
			$select->where('plateNo = ?',$data);
			}
			elseif($condition == "pilot")
			{
				$select->where("pilot like ?","%$date%");
				}

		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}

		
}
?>


