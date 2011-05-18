<?php
//updated on 14th May By Rob


class Vehicle_Models_DbTable_Vehicle extends Zend_Db_Table_Abstract
{
	protected $_name = 've_vehicles';

	public function fetchAllVeId($key,$condition)
	{
		$select = $this->select()
						->setIntegrityCheck(false)	
						->from(array('ve_vehicles'),array('veId'));
		if($condition == "plateNo")
		{
			$select->where("plateNo like ?","%$key%");
		}
		return $this->fetchAll($select);
	}

	public function fetchAllPalteNo()
	{
		$select = $this->select()
					->setIntegrityCheck(false)	
					->from(array('ve_vehicles'),array('plateNo','veId','name'));
		return $this->fetchAll($select);
	}
	
	public function findPlateNo($id)
	{		
		$select = $this->select()
						->setIntegrityCheck(false)	
						->from(array('ve_vehicles'),array('plateNo'))
						->where('veId = ?',$id);
		return $this->fetchAll($select);
		
		}
	
	public function findContactId($id)
	{
		$select = $this->select()
						->setIntegrityCheck(false)	
						->from(array('ve_vehicles'),array('contactId'))
						->where('veId = ?',$id);
		return $this->fetchAll($select);
		}

	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'plateNo')
		{
			$select->where('plateNo like ?','%'.$key.'%');
			}
			elseif($condition == 'name')
			{
				$select->where('name like ?','%'.$key.'%');
				}
				elseif($condition == 'contactName')
				{
					$select->setIntegrityCheck(false)
						->from(array('e'=> 'em_contacts'),array('name'))
						->join(array('v'=>'ve_vehicles'),'e.contactId = v.contactId')
						->where('e.name like ?','%'.$key.'%');
					}
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>