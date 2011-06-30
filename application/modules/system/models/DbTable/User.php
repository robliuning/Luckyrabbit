<?php
//updated in 9th June by Rob

class System_Models_DbTable_User extends Zend_Db_Table_Abstract
{
	protected $_name = 'users'; 

	public function getUserId($name)
	{
		$select = $this->select();
		$select->where('username = ?',$name);
		
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>
