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

	public function fetchAllJoin($key, $condition)
	{
		$select = $this->select()
						->setIntegrityCheck(false)
						->from(array('v'=>'ve_vehicles'))
						->join(array('e'=>'em_contacts'),'e.contactId = v.contactId',array('cName'=>'contactName'))
						->join(array('f'=>'em_contacts'),'v.pilot = f.contactId',array('pilotName'=>'contactName'));

		if($condition == 'plateNo')
		{
			$select->where('v.plateNo like ?','%'.$key.'%');
			}
			elseif($condition == 'name')
			{
				$select->where('v.name like ?','%'.$key.'%');
				}
				elseif($condition == 'contactName')
				{
					$select->setIntegrityCheck(false)
							->where('e.contactName like ?','%'.$key.'%');
					}
		$paginator = Zend_Paginator::factory($select);
		return $paginator;
		}
}
?>