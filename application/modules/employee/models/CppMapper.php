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
            'postId' => $post->getPostId(),
            'name' => $post->getName(),
            'type' => $post->getType(),
            'cardId' => $post->getCardId(),
			'CertId' => $post->getCertId(),
			'remark' => $post->getRemark()
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

        $resultSet = $this->getDbTable()->fetchAll();

        $entries   = array();

        foreach ($resultSet as $row) {

            $entry = new Application_Model_Post();

			$entry->setPostId($row->postId)
				  ->setName($row->name)
                  ->setType($row->type)
                  ->setCardId($row->cardId)
				  ->setCertId($row->certId)
				  ->setRemark($row->remark);
                  
            $entries[] = $entry;

        }

        return $entries;

    }
}
?>
