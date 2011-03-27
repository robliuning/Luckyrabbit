<?php
/*
created by lincoy
time of creating 3-27-2011
completed time 3-27-2011
*/

class Application_Model_VeRecordMapper
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
            $this->setDbTable('Application_Model_DbTable_VeRecord');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_VeRecord $veRecord)
    {
        $data = array(
			'recordID' => $veRecord->getRecordID(),
		     'name' => $veRecord->getName(),
			 'dateOfUse' => $veRecord->getDateOfUse(),
			 'purpose' => $veRecord->getPurpose(),
			 'milesBf' => $veRecord->getMilesBf(),
			 'milesAf' => $veRecord->getMilesAf(),
			 'pilot' => $veRecord->getPilot(),
			 'otherUsers' => $veRecord->getOtherUsers(),
			 'remark' => $veRecord->getRemark()
        );
        if (null === ($id = $veRecord->getRecordID())) {
            unset($data['recordID']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('recordID = ?' => $recordID));
        }
    }
    public function find($recordID, Application_Model_VeRecord $VeRecord)

    {

        $result = $this->getDbTable()->find($recordID);

        if (0 == count($result)) {

            return;

        }

        $row = $result->current();

        $contact  ->setRecordID($row->recordID)
        		  ->setName($row->name)
                  ->setDateOfUse($row->dateOfUse)
                  ->setPurpose($row->purpose)
                  ->setMilesBf($row->milesBf)
                  ->setMilesAf($row->milesAf)
                  ->setPilot($row->pilot)
                  ->setOtherUsers($row->otherUsers)
                  ->setRemark($row->remark);
    }
 

    public function fetchAll()

    {

        $resultSet = $this->getDbTable()->fetchAll();

        $entries   = array();

        foreach ($resultSet as $row) {

            $entry = new Application_Model_VeRecord();
		    $entry ->setRecordID($row->recordID)
        		   ->setName($row->name)
                   ->setDateOfUse($row->dateOfUse)
                   ->setPurpose($row->purpose)
                   ->setMilesBf($row->milesBf)
                   ->setMilesAf($row->milesAf)
                   ->setPilot($row->pilot)
                   ->setOtherUsers($row->otherUsers)
                   ->setRemark($row->remark);

            $entries[] = $entry;

        }
        return $entries;
    }
}
?>