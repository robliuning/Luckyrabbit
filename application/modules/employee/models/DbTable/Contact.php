<?php
/*
created by ËïÁÖ
time of creating 3-26-2011
completed time 3-26-2011
*/

class Employee_Models_DbTable_Contact extends Zend_Db_Table_Abstract
{
    protected $_name = 'em_contacts';

	public function getContact($contactId)
	{
		$contactId = (int)$contactId;
		$row = $this->fetchRow('contactId = ' . $contactId);
		if (!$row) {
			throw new Exception("Could not find row $contactId");
		}
		return $row->toArray();
	}

	public function addContact(
		                        $name,
		                        $gender,
		                        $titleName,
		                        $birth,
		                        $idCard,
		                        $phoneNo,
		                        $otherContact,
		                        $address,
		                        $remark)
	{
		$data = array (
		    'name' => $name,
		    'gender' => $gender,
		    'titleName' => $titleName,
			'birth' => $birth,
		    'idCard' => $idCard,
		    'phoneNo' => $phoneNo,
		    'otherContact' => $otherContact,
		    'address' => $address,
		    'remark' => $remark
		);
		$this->insert($data);
	}

	public function updateContact(
								$contactId,
		                        $name,
		                        $gender,
		                        $titleName,
		                        $birth,
		                        $idCard,
		                        $phoneNo,
		                        $otherContact,
		                        $address,
		                        $remark)
	{
		$data = array(
		    'contactId' => $contactId,
		    'name' => $name,
		    'gender' => $gender,
		    'titleName' => $titleName,
			'birth' => $birth,
		    'idCard' => $idCard,
		    'phoneNo' => $phoneNo,
		    'otherContact' => $otherContact,
		    'address' => $address,
		    'remark' => $remark
		);
		$this->update($data, 'contactId = ' . (int)$contactId);
	}

	public function deleteContact($contactId)
	{
		$this->delete('contactId = ' . (int)$contactId);
	}
	
	public function populateContactDd($form)
  	{		
  		$title=new General_Models_DbTable_Title();
		$titleOptions = $title->fetchAll();
  		foreach($titleOptions as $op)
		{
			$form->getElement('titleName')->addMultiOption($op->name,$op->name);
			}	
  		}
}
?>