<?php

class Employee_Models_EmployeeMapper
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
            $this->setDbTable('Employee_Models_DbTable_Employee');
        }
        return $this->_dbTable;
    }
    public function save(Employee_Models_Employee $employee,$option) //check
    {
        $data = array(
            'empId' => $employee->getEmpId(),
            'deptName' => $employee->getDeptName(),
            'dutyName' => $employee->getDutyName(),
            'status' => $employee->getStatus(),
        );
        if ($option == 'add') {
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('empId = ?' => $employee->getEmpId()));
        }
    }
    
    public function find($empId, Employee_Models_Employee $employee)
    {

        $result = $this->getDbTable()->find($empId);

        if (0 == count($result)) {

            return;

        }

        $row = $result->current();

        $employee ->setEmpId($row->empId)
        		  ->setDeptName($row->deptName)
                  ->setDutyName($row->dutyName)
                  ->setStatus($row->status);
    
    	$contacts = new Employee_Models_ContactMapper();
    	$empName = $contacts->findContactName($employee->getEmpId());
    	$employee->setEmpName($empName);
    }
    
    public function delete($id) //check
    { 	
    	$this->getDbTable()->delete('empId = ' . (int)$id);
    	}
 
    public function findArrayEmployee($id) //check
    {
		$id = (int)$id;
		$entries = $this->getDbTable()->findArrayEmployee($id);
		$entry = $entries[0]->toArray();
		return $entry;
	}
    
	public function fetchAllJoin($key = null,$condition = null) 
    {
    	if($condition == null)
    	{
    		$resultSet = $this->getDbTable()->fetchAll();
    		}
    		else
    		{
    			$resultSet = $this->getDbTable()->search($key,$condition);
    			}
   		
   		$entries = array();
   		
   		foreach($resultSet as $row){
			$entry = new Employee_Models_Employee();
   			
   			$entry->setEmpId($row->empId)
   				->setDeptName($row->deptName)
   				->setDutyName($row->dutyName)
   				->setStatus($row->status);
			
			$empId = $entry->getEmpId($row->empId);
			$contacts = new Employee_Models_ContactMapper();
			$contact = $contacts->findArrayContact($empId);
			$entry->setTitleName($contact['titleName']);
			$entry->setEmpName($contact['name']);
			$entry->setPhoneNo($contact['phoneNo']);
			
			$entries[] = $entry;
   			}
   			
    	return $entries;
    	}
    
    
    public function populateEmployeeDd($form) //check
  	{
  		$depts = new General_Models_DeptMapper();
		$arrayDepts = $depts->fetchAll(); 
		$duties = new General_Models_DutyMapper();
		$arrayDuties = $duties->fetchAll();

		foreach($arrayDepts as $dept)
		{
			$form->getElement('deptName')->addMultiOption($dept->getName(),$dept->getName());
			}
		foreach($arrayDuties as $duty)
		{
			$form->getElement('dutyName')->addMultiOption($duty->getName(),$duty->getName());
			}
  	}
}
?>
