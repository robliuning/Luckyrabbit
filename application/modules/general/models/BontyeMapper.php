<?php
 //creation date 17-04-2011
  //creating by lincoy
  //completion date 17-04-2011

class General_Models_BontypeMapper
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
            $this->setDbTable('General_Models_DbTable_Bontype');
        }
        return $this->_dbTable;
    }

	public function save(General_Models_Bontype $bontype) 
    {
        $data = array(
            'typeId' => $bontype->getTypeId(),
			'name' => $bontype->getName()
        );
        if (null === ($id = $bontype->getTypeId())) {
            unset($data['typeId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('typeId = ?' => $bontype->getTypeId()));
        }
    }

	public function delete($typeId)
	{
		$this->getDbTable()->delete("typeId = ".(int)$typeId);
	}

	public function findBontypeName($id)
	{
		$arrayNames = $this->getDbTable()->findBontype($id);
		$name = $arrayNames[0]->name;
		return $name;
	}

}
?>
