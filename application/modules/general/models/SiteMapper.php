<?php
  //creation date 15-04-2011
  //creating by lincoy
  //completion date 15-04-2011

class General_Models_SiteMapper
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
            $this->setDbTable('General_Models_DbTable_Site');
        }
        return $this->_dbTable;
    }

	public function save(General_Models_Site $site) 
    {
        $data = array(
            'siteId' => $site->getSiteId(),
			'name' => $site->getName()
        );
        if (null === ($id = $site->getSiteId())) {
            unset($data['siteId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('siteId = ?' => $site->getSiteId()));
        }
    }

	public function delete($siteId)
	{
		$this->getDbTable()->delete("siteId = ".(int)$siteId);
	}

	public function findSiteName($id)
	{
		$arrayNames = $this->getDbTable()->findSiteName($id);
		
		$name = $arrayNames[0]->name;
		
		return $name;
	}	

}
?>