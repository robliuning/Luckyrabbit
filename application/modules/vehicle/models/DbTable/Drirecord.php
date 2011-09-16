<?php
//updated on 14th May By Rob

class Vehicle_Models_DbTable_Drirecord extends Zend_Db_Table_Abstract
{
	protected $_name = 've_drirecords';

	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'plateNo')
		{
			$select->setIntegrityCheck(false)
				->from(array('ve' => 've_vehicles'),array('plateNo'))
				->join(array('dri' => 've_drirecords'),'ve.veId = dri.veId')
				->where('ve.plateNo like ?','%'.$key.'%');
			}
			elseif($condition == 'veId')
			{
				$select->where('veId = ?',$key);
				}
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
	
	public function checkRecordExist($id,$year,$month)
	{
		$checkRe = false;
		$select = $this->select();
		$select->where('veId = ?',$id)
			->where('rYear = ?',$year)
			->where('rMonth = ?',$month);
		$resultSet = $this->fetchAll($select);
		if(count($resultSet) != 0)
		{
			$checkRe = true;
			}
		return $checkRe;
		}
	
	public function fetchAllJoin($key, $condition)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('dri' => 've_drirecords'))
						->join(array('ve' => 've_vehicles'),'ve.veId = dri.veId',array('plateNo'));
		if($condition == 'plateNo')
		{
			$select->where('ve.plateNo like ?','%'.$key.'%');
			}
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
		}
}
?>