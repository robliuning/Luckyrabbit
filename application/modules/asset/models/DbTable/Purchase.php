<?php
  
 /*write by lxj
 2011-04-16   v0.2*/

class Asset_Models_DbTable_Purchase extends Zend_Db_Table_Abstract
{
    protected $_name = 'as_purchase';

	public function findPurchaseName($id)
    {
    	$select = $this->select()
			->setIntegrityCheck(false)
			->from('as_purchase',array('name'))
			->where('purId = ?',$id);
			
   		$entries = $this->fetchAll($select);
   		
   		return $entries;
    	}
	
	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'name')
		{
			$select->where('name like ?','%'.$key.'%');
			}
			elseif($condition == 'contactName')
			{
                  $select->setIntegrityCheck(false)
					->from(array('e'=> 'em_contacts'),array('name'))
					->join(array('a'=>'as_purchase'),'e.contactId = a.contactId')
					->where('e.name like ?','%'.$key.'%');				
				  }
				  elseif($condition == 'approvName')
				  {
					  $select->setIntegrityCheck(false)
						->from(array('e'=> 'em_contacts'),array('name'))
						->join(array('a'=>'as_purchase'),'e.contactId = a.approvId')
						->where('e.name like ?','%'.$key.'%');
					}
					elseif($condition == 'spec')
					{
						$select->where('spec like ?','%'.$key.'%');
						}
					
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>