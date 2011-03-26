<?php
/*
created by кОаж
time of creating 3-26-2011
completed time 3-26-2011
*/

class Application_Model_DbTable_Contact extends Zend_Db_Table_Abstract
{
    protected $_name = 'em_contacts';

	public function getContact($contact)
	{
		$contactId = (int)$contactId;
		$row = $this->fetchRow('contactId = ' . $contactId);
		if (!$row) {
			throw new Exception("Could not find row $contactId");
		}
		return $row->toArray();
	}

	public function addContact(
								$contactId,
		                        $name,
		                        $gender,
		                        $birth,
		                        $idCard,
		                        $phoneNo,
		                        $otherContact,
		                        $address,
		                        $remark)
	{
		$data = array (
		    'contactId' => $contactId,
		    'name' => $name,
		    'gender' => $gender
			'birth' => $birth,
		    'idContact' => $idCard,
		    'phoneNo' => $phoneNo,
		    'otherContact' => $otherContact,
		    'address' => $address,
		    'remark' => $remark
		);
		$this->insert($data);
	}

	public function updateEmployee(
								$contactId,
		                        $name,
		                        $gender,
		                        $birth,
		                        $idCard,
		                        $phoneNo,
		                        $otherContact,
		                        $address,
		                        $remark)
	{
		$data = array (
		    'contactId' => $contactId,
		    'name' => $name,
		    'gender' => $gender
			'birth' => $birth,
		    'idContact' => $idCard,
		    'phoneNo' => $phoneNo,
		    'otherContact' => $otherContact,
		    'address' => $address,
		    'remark' => $remark
		);
		$this->update($data, 'contactId = ' . (int)contactId);
	}

	public function deleteContact($contactId)
	{
		$this->delete('contactId = ' . (int)$contactId);
	}
}
?>