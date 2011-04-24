<?php
  
 /*write by lxj
 2011-04-16   v0.2*/

class Asset_Models_DbTable_Depre extends Zend_Db_Table_Abstract
{
    protected $_name = 'as_depres';
	
	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'quantity')
		{
			$select->where('quantity like ?','%'.$key.'%');
			}
			elseif($condition == 'purName')
			{
                  $select->setIntegrityCheck(false)
					->from(array('e'=> 'as_purchase'),array('name'))
					->join(array('a'=>'as_depres'),'e.purId = a.purId')
					->where('e.name like ?','%'.$key.'%');				
				  }
				  elseif($condition == 'projectName')
				  {
					  $select->setIntegrityCheck(false)
						->from(array('e'=> 'pm_projects'),array('name'))
						->join(array('a'=>'as_depres'),'e.projectId = a.projectId')
						->where('e.name like ?','%'.$key.'%');
					}
					elseif($condition == 'inDate')
					{
						$select->where('inDate like ?','%'.$key.'%');
						}
						elseif($condition == 'outDate')
						{
							$select->where('outDate like ?','%'.$key.'%');
							}
							elseif($condition == 'depre')
							{
								$select->where('depre like ?','%'.$key.'%');
								}
								elseif($condition == 'depreAmt')
								{
									$select->where('depreAmt like ?','%'.$key.'%');
									}
					
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}
}
?>