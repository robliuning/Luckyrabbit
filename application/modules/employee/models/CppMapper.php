<?php

/*create by lxj
  2011-03-28	v1.1
  rewrite by lxj
  2011-04-03	v0.2
  */

class Employee_Models_CppMapper
{
	protected $_dbTable;
	
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Employee_Models_DbTable_Cpp');
        }
        return $this->_dbTable;
    }
    /*public function save(Employee_Models_Cpp $cpp)
    {
        $data = array(
            'contactId' => $cpp->getContactId(),
            'postId' => $cpp->getPostId(),
            'projectId' => $cpp->getProjectId(),
            'postType' => $cpp->getPostType(),
			'postCardId' => $cpp->getPostCardId(),
			'CertId' => $cpp->getCertId()
        );
        if (null === ($id = $cpp->getPostId())) {
            unset($data['postId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('postId = ?' => $postId));
        }
    }*/
    public function find($cppId, Employee_Model_Cpp $cpp)

    {

        $result = $this->getDbTable()->find($cppId);

        if (0 == count($result)) {

            return;

        }

        $row = $result->current();

        $cpp->setCId($row->cId)
				  ->setContactId($row->contactId)
				  ->setPostId($row->postId)
				  ->setProjectId($row->projectId)
                  ->setPostType($row->postType)
                  ->setPostCardId($row->postCardId)
                  ->setCertId($row->certId);
    }
 

    public function fetchAll($data,$condition)
    {
		$select = $this->getDbTable()->select();
		if($condition == "projectId")
		{
			$select->where("projectId = ?",$data);
			}
		elseif($condition == "postId")
		{
			$select->where("postId = ?",$data);
			}
		elseif($condition == "contactId")
		{
			$select->where("contactId = ?",$data);
			}
		//1 fetch all rows from cpp table
    	$resultSet = $this->getDbTable()->fetchAll($select);
    	$cpps   = array();
 		foreach ($resultSet as $row) 
 		{
            $cpp = new Employee_Models_Cpp();
			$cpp->setCId($row->CId)
				  ->setContactId($row->contactId)
				  ->setPostId($row->postId)
				  ->setProjectId($row->projectId)
                  ->setPostType($row->postType)
                  ->setPostCardId($row->postCardId)
				  ->setCertId($row->certId);
    		
    		$cpp = $this->assignNames($cpp);
    		//2 fetch contact name by contact id from em_contact table		
			$cpps[] = $cpp;
			}
			//return it to controlloer
    		return $cpps;
    }
    public function getCpp($cppId)
    {
    	$cpp = new Employee_Models_Cpp();
		$select = $this->getDbTable()->select();
		$select->where("cId = ?",$cId);
		$resultSet = $this->getDbTable()->fetchAll($select);
		foreach ($resultSet as $row) 
 		{
			$cpp->setCId($row->cId)
				  ->setContactId($row->contactId)
				  ->setPostId($row->postId)
				  ->setProjectId($row->projectId)
                  ->setPostType($row->postType)
                  ->setPostCardId($row->postCardId)
				  ->setCertId($row->certId);
    		$cpp = $this->assignNames($cpp);
    		//2 fetch contact name by contact id from em_contact table		
			}
			return $cpp;	
    	}
    
    public function assignNames($cpp)
    {
    	    $contacts = new Employee_Models_DbTable_Contact();
    		$select = $contacts->select()
			->setIntegrityCheck(false)
			->from('em_contacts',array('name'))
			->where('contactId = ?',$cpp->getContactId());
			
   			$contact = $contacts->fetchAll($select);
   			foreach($contact as $co)
   			{
   				$cpp->setContactName($co->name);
   				}
    		//3 fetch project name by project id from pm_project table
    		$projects = new Project_Models_DbTable_Project();
    		$select = $projects->select()
			->setIntegrityCheck(false)
			->from('pm_projects',array('name'))
			->where('projectId = ?',$cpp->getProjectId());
			
   			$project = $projects->fetchAll($select);
   			foreach($project as $pr)
   			{
   				$cpp->setProjectName($pr->name);
   				}
    		//4 fetch post name by post id from ge_post table
			$posts = new General_Models_DbTable_Post();
    		$select = $posts->select()
			->setIntegrityCheck(false)
			->from('ge_posts',array('name'))
			->where('postId = ?',$cpp->getPostId());
			
   			$post = $posts->fetchAll($select);
   			foreach($post as $po)
   			{
   				$cpp->setPostName($po->name);
   				}				
   			return $cpp;	  	
    	}
}
?>
