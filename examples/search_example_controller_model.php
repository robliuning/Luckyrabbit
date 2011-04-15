<?php
//example code for search
//author: rob
//date: 2011.4.15

//code in controller
	public function xxxAction()
    {
    	$errorMsg = null;
		$materials = new Material_Models_MaterialMapper();
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayMaterials = array();
			$key = $formData['key'];
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayMaterials = $materials->fetchAllJoin($key,$condition);
				if(count($arrayMaterials) == 0)
				{
					$errorMsg = 0;
					//warning will be displayed: "没有找到符合条件的结果。"
					}
				}
				else
				{
					$errorMsg = 1;
					//warning will be displayed: "请输入搜索关键字。"
					}
		}
		else
		{
			$arrayMaterials = $materials->fetchAllJoin();
			}
		
		$this->view->arrayMaterials = $arrayMaterials;
		$this->view->errorMsg = $errorMsg;
    }
    
//code in corresponding mapper
	public function fetchAllJoin($key = null,$condition = null) //this function is used for both display all and search, differ from arguments
    {
    	if($condition == null)
    	{
    		$resultSet = $this->getDbTable()->fetchAll(); //no need to specify $key
    		}
    		else
    		{
    			$resultSet = $this->getDbTable()->search($key,$condition); //if the function is called with arguments, then we define it as a search request
    			}
   		
   		$entries = array();
   		
   		foreach($resultSet as $row){
   			$entry = new Material_Models_Material();
   			
   			$entry->setMtrId($row->mtrId)
   				->setName($row->name)
   				->setTypeId($row->typeId)
   				->setSpec($row->spec)
   				->setUnit($row->unit)
   				->setRemark($row->remark);
   				
   			$typeId = $entry->getTypeId();  //remember to retrieve relevant names from other modules
   			$mtrtypes = new General_Models_MtrtypeMapper();
   			$typeName = $mtrtypes->findTypeName($typeId);
   			$entry->setTypeName($typeName);
   			 				
   			$entries[] = $entry; 
   			}
    	return $entries;
    	}
//code in corresponding dbTable
	public function search($key,$condition)
	{
		$select = $this->select();
		
		if($condition == 'name') //condition defined which col in the table to be set for where clause
		{
			$select->where('name like ?','%'.$key.'%'); //remember to use like
			}
			elseif($condition == 'type') //for the $key which refers to col in other table, remenber to use join 
			{
				$select->setIntegrityCheck(false)
						->from(array('m'=> 'mm_materials'))
						->join(array('t'=>'ge_mtrtypes'),'m.typeId = t.typeId')
						->where('t.Name like ?','%'.$key.'%');
				}
				elseif($condition == 'spec')
				{
					$select->where('spec like ?','%'.$key.'%');
					}
					
		$resultSet = $this->fetchAll($select);
		
		return $resultSet;
	}

?>