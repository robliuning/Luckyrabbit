<?php
/*
created by lincoy
time of creating 3-27-2011
completed time 3-27-2011
*/

class Application_Model_VehicleMapper
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
            $this->setDbTable('Application_Model_DbTable_Vehicle');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Vehicle($vehicle)
    {
        $data = array(
			'plateNo' => $vehicle->getPlateNo(),
			'name' => $vehicle->getName(),
			'license' => $vehicle->getLicense(),
			'personID' => $vehicle->getPersonID(),
			'users' => $vehicle->getUsers(),
			'fuelCons' => $vehicle->getFuelCons(),
			'remark' => $vehicle->getRemark()
        );

        if (null === ($id = $vehicle->getPlateNo())) {
            unset($data['plateNo']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('plateNo = ?' => $plateNo));
        }
    }
    public function find($plateNo, Application_Model_Vehicle $vehicle)

    {

        $result = $this->getDbTable()->find($plateNo);

        if (0 == count($result)) {

            return;

        }

        $row = $result->current();

        $vehicle->setPlateNo($row->plateNo)
        		  ->setName($row->name)
                  ->setLicense($row->license)
                  ->setPersonIC($row->personIC)
                  ->setUsers($row->users)
                  ->setFuelCons($row->fuelCons)
                  ->setRemark($row->remark);
    }
 

    public function fetchAll()

    {

        $resultSet = $this->getDbTable()->fetchAll();

        $entries   = array();

        foreach ($resultSet as $row) {

            $entry = new Application_Model_Vehicle();
		    $entry ->setPlateNo($row->plateNo)
        		  ->setName($row->name)
                  ->setLicense($row->license)
                  ->setPersonIC($row->personIC)
                  ->setUsers($row->users)
                  ->setFuelCons($row->fuelCons)
                  ->setRemark($row->remark);


            $entries[] = $entry;

        }
        return $entries;
    }
}
?>