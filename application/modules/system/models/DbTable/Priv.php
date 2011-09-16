<?php
//updated in 13th June by Rob

class System_Models_DbTable_Priv extends Zend_Db_Table_Abstract
{
	protected $_name = 'sy_privs'; 

	public function loadMenu($groupId)
	{
		$select = $this->select()
					->setIntegrityCheck(false)
					->distinct()
					->from(array('s'=>'sy_privs'),'s.modId')
					->join(array('m'=>'sy_modules'),'s.modId = m.modId',array('modEName','modCName'))
					->where('s.groupId = ?',$groupId)
					->where('s.priv = 1');
		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
	
	public function loadSidebar($groupId,$modEName)
	{
		$select = $this->select()
					->setIntegrityCheck(false)
					->distinct()
					->from(array('s'=>'sy_privs'),'s.conId')
					->join(array('b'=>'sy_sidebars'),'s.conId = b.conId',array('sidName'))
					->join(array('m'=>'sy_modules'),'s.modId = m.modId')
					->join(array('c'=>'sy_controllers'),'s.conId = c.conId')
					->where('s.groupId = ?',$groupId)
					->where('s.priv = 1')
					->where('m.modEName = ?',$modEName);
		$resultSet = $this->fetchAll($select);
		return $resultSet;	
	}
	
	public function getModCName($modEName)
	{
		$select = $this->select()
					->setIntegrityCheck(false)
					->from('sy_modules','modCName')
					->where('modEName = ?',$modEName);
		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
	
	public function getActCName($actEName)
	{
		$select = $this->select()
					->setIntegrityCheck(false)
					->from('sy_actions','actCName')
					->where('actEName = ?',$actEName);
		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
	
	public function getSidName($modEName,$conName)
	{
		$select = $this->select()
					->setIntegrityCheck(false)
					->from(array('s'=>'sy_sidebars'),array('sidName'))
					->join(array('m'=>'sy_modules'),'s.modId = m.modId')
					->join(array('c'=>'sy_controllers'),'s.conId = c.conId')
					->where('m.modEName = ?',$modEName)
					->where('c.conName = ?',$conName);
		$resultSet = $this->fetchAll($select);
		return $resultSet;	}
		
	public function fetchArrayFuncs($groupId,$modEName,$conName)
	{
		$select = $this->select()
					->setIntegrityCheck(false)
					->from(array('s'=>'sy_privs'),array('priv'))
					->join(array('m'=>'sy_modules'),'s.modId = m.modId')
					->join(array('c'=>'sy_controllers'),'s.conId = c.conId')
					->join(array('a'=>'sy_actions'),'a.actId = s.actId',array('actEName'))
					->where('m.modEName = ?',$modEName)
					->where('c.conName = ?',$conName)
					->where('s.groupId = ?',$groupId);
		$resultSet = $this->fetchAll($select);
		return $resultSet;
	}
	
	public function getPriv($groupId,$modEName,$conName,$actEName)
	{
		$select = $this->select()
					->setIntegrityCheck(false)
					->from(array('s'=>'sy_privs'),array('priv'))
					->join(array('m'=>'sy_modules'),'s.modId = m.modId')
					->join(array('c'=>'sy_controllers'),'s.conId = c.conId')
					->join(array('a'=>'sy_actions'),'a.actId = s.actId')
					->where('m.modEName = ?',$modEName)
					->where('a.actEName = ?',$actEName)
					->where('c.conName = ?',$conName)
					->where('s.groupId = ?',$groupId);
		$resultSet = $this->fetchAll($select);
		return $resultSet;	}
}
?>
