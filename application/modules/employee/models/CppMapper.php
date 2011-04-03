<?php

/*create by lxj
  2011-03-28	v1.1
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
    public function save(Employee_Models_Cpp $cpp)
    {
        $data = array(
            'contactId' => $cpp->getContactId(),
            'postId' => $cpp->getPostId(),
            'projectId' => $cpp->getProjectId(),
            'postType' => $cpp->getPostType(),
			'postCardId' => $cpp->getPostCardId(),
			'CertId' => $cpp->getCertId()
        );
        if (null === ($id = $post->getPostId())) {
            unset($data['postId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('postId = ?' => $postId));
        }
    }
    public function find($postId, Application_Model_Post $post)

    {

        $result = $this->getDbTable()->find($post);

        if (0 == count($result)) {

            return;

        }

        $row = $result->current();

        $post->setPostId($row->postId)
				  ->setName($row->name)
				  ->setType($row->type)
                  ->setCardId($row->cardId)
                  ->setCertId($row->certId)
                  ->setRemark($row->remark);
    }
 

    public function fetchAll()
    {
    //1 fetch all rows from cpp table
    	$resultSet = $this->getDbTable()->fetchAll();
    	$cpps   = array();
 		foreach ($resultSet as $row) 
 		{
            $cpp = new Employee_Models_Cpp();
			$cpp->setContactId($row->contactId)
				  ->setPostId($row->postId)
				  ->setProjectId($row->projectId)
                  ->setPostType($row->postType)
                  ->setPostCardId($row->postCardId)
				  ->setCertId($row->certId);
    		//2 fetch contact name by contact id from em_contact table
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
			$cpps[] = $cpp;
			}
			//return it to controlloer
    		return $cpps;
    }
}
?>
