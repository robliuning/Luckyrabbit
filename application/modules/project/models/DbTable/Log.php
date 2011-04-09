<?php
  //creation date 04-04-2011
  //creating by lincoy
  //completion date 

class Project_Models_DbTable_Log extends Zend_Db_Table_Abstract
{
    protected $_name = 'pm_projectlogs';

	public function fetchAllDates($startDate,$endDate,$projectId)  //  根据projectId获得 projectLogId  and logDate
	{
		$select = $this->select()
			->setIntegrityCheck(false)
			->from('pm_projectlogs',array('pLogId','logDate'))		
			->where('projectId = ?',$projectId)
            //->where("'logDate' between $startDate and $endDate")
          	->where('logDate > ?', $startDate)
             ->where('logDate < ?', $endDate)
			->order('cTime DESC');
			
		$entries = $this->fetchAll($select);
		
		return $entries;
	}
}
?>