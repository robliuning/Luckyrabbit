<?php
/*
	author lxj
  	date 2011.3.28
  	review rob
  	date 2011/4.7
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
    
    public function save(Employee_Models_Cpp $cpp) //check
    {
        $data = array(
        	'cppId' => $cpp->getCppId(),
            'contactId' => $cpp->getContactId(),
            'postId' => $cpp->getPostId(),
            'projectId' => $cpp->getProjectId(),
            'postType' => $cpp->getPostType(),
			'postCardId' => $cpp->getPostCardId(),
			'CertId' => $cpp->getCertId()
        );
        if (null === ($id = $cpp->getCppId())) {
            unset($data['cppId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('cppId = ?' => $cpp->getCppId()));
        }
    }
    
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
    
    public function delete($id) //check
    {
    	$result = $this->getDbTable()->delete('cppId = ' . (int)$id);
    	return $result;	
    	}
 
    /*public function fetchAllJoin($data,$condition) //check
    {
    	$resultSet = $this->getDbTable()->fetchAllJoin($data,$condition);
    	
    	$entries   = array();
    	
 		foreach ($resultSet as $row) 
 		{
            $entry = new Employee_Models_Cpp();
			$entry->setCppId($row->cppId)
				  ->setContactId($row->contactId)
				  ->setPostId($row->postId)
				  ->setProjectId($row->projectId)
                  ->setPostType($row->postType)
                  ->setPostCardId($row->postCardId)
				  ->setCertId($row->certId);
    		$contactId = $entry->getContactId();
    		$projectId = $entry->getProjectId();
    		$postId = $entry->getPostId();
    	
    		$contacts = new Employee_Models_ContactMapper();
    		$entry->setContactName($contacts->FindContactName($contactId));
    	    
    		$projects = new Project_Models_ProjectMapper();
    		$entry->setProjectName($projects->FindProjectName($projectId));
    	    	    
    		$posts = new General_Models_PostMapper();
    		$entry->setPostName($posts->FindPostName($postId));
			$entries[] = $entry;
			}
    		return $entries;
    }  */

	public function fetchAllJoin($key,$condition) //check
    {
    	if($condition == null)
    	{
    		$resultSet = $this->getDbTable()->fetchAll();
    		}
    		else
    		{
    			$resultSet = $this->getDbTable()->search($key,$condition);
    			}
    	
    	$entries   = array();
    	
 		foreach ($resultSet as $row) 
 		{
            $entry = new Employee_Models_Cpp();
			$entry->setCppId($row->cppId)
				  ->setContactId($row->contactId)
				  ->setPostId($row->postId)
				  ->setProjectId($row->projectId)
                  ->setPostType($row->postType)
                  ->setPostCardId($row->postCardId)
				  ->setCertId($row->certId);
    		$contactId = $entry->getContactId();
    		$projectId = $entry->getProjectId();
    		$postId = $entry->getPostId();
    	
    		$contacts = new Employee_Models_ContactMapper();
    		$entry->setContactName($contacts->FindContactName($contactId));
    	    
    		$projects = new Project_Models_ProjectMapper();
    		$entry->setProjectName($projects->FindProjectName($projectId));
    	    	    
    		$posts = new General_Models_PostMapper();
    		$entry->setPostName($posts->FindPostName($postId));
			$entries[] = $entry;
			}
    		return $entries;
    } 
    
    public function findArrayCpp($id) //check
    {
    	$entry = new Employee_Models_Cpp();
		
		$row = $this->getDbTable()->findArrayCpp($id);
		
		$contactId = $row['contactId'];
		$contacts = new Employee_Models_ContactMapper();
    	$row['contactName'] = $contacts->FindContactName($contactId);

		return $row;	
    	}
		
	public function findContact($projectId,$postId) //check
	{
		$entries = $this->getDbTable()->findContact($projectId,$postId);
		return $entries;
		}
	
	public function populateCppDd($form) //check
  	{
  		$posts = new General_Models_PostMapper();
		$arrayPosts = $posts->fetchAll(); 
		$projects = new Project_Models_ProjectMapper();
		$arrayProjects = $projects->fetchAllNames();

		foreach($arrayPosts as $post)
		{
			$form->getElement('postId')->addMultiOption($post->getPostId(),$post->getName());
			}
		foreach($arrayProjects as $project)
		{
			$form->getElement('projectId')->addMultiOption($project->getProjectId(),$project->getName());
			}
  		}
}
?>
