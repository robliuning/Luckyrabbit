<?php

/*create by lxj
  2011-03-28	v1.1
  */

class Application_Model_ProjectMapper
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
            $this->setDbTable('Application_Model_DbTable_Project');
        }
        return $this->_dbTable;
    }
	public function save(Application_Model_Project $project)   /* waiting for modifying "if ... else" */
    {
		$data = array(
			'contactId' => $project->getContactId(),
			'postId' => $project->getPostId(),
            'projectId' => $project->getProjectId()
        );
        if (null === ($id = $project->getProjectId())) {
            unset($data['projectId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('projectId = ?' => $projectId));
        }
    }
    public function find($projectId, Application_Model_Project $project)

    {

        $result = $this->getDbTable()->find($projectId);

        if (0 == count($result)) {

            return;

        }

        $row = $result->current();

		$project->setContactId($row->contactId)
				  ->setPostId($row->postId)
			      ->setProjectId($row->projectId);
    }
 

    public function fetchAll()

    {

        $resultSet = $this->getDbTable()->fetchAll();

        $entries   = array();

        foreach ($resultSet as $row) {

            $entry = new Application_Model_Project();

			$entry->setContactId($row->contactId)
				  ->setPostId($row->postId)
				  ->setProjectId($row->projectId);
                  
            $entries[] = $entry;

        }

        return $entries;

    }
}
?>
