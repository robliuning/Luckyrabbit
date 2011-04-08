<?php

/*create by lxj
  2011-04-04	v1.1
  rewrite by lxj
  2011-04-08   v0.2
  */

class Contract_Models_DbTable_Contract extends Zend_Db_Table_Abstract
{
    protected $_name = 'sc_contractors'; 

	public function findArrayContract($ContractId)
	{
		$ContractId = (int)$ContractId;
		$row = $this->fetchRow('ContractId = ' . $ContractId);
		if (!$row) {
			throw new Exception("Could not find row $ContractId");
		}
		return $row->toArray();
	}

	public function deleteContract($contractId)
	{
		$this->delete('contractId = '.(int)$contractorId);
	}


	public function addContract(
								$name,
								$artiPerson,
								$licenseNo,
								$busiField,
								$phoneNo,
                                $otherContact, 
                                $address,
                                $remark
								)
	{
		$data = array (
			'name' => $name,
			'artiPerson' => $artiPerson,
			'licenseNo' => $licenseNo,
			'busiField' => $busiField,
			'phoneNo' => $phoneNo,
			'otherContact' => $otherContact,
			'address' => $address,
			'remark' => $remark
		);
		$this->insert($data);
	}

	public function updateContract(
								$contractorId,
								$name,
								$artiPerson,
								$licenseNo,
								$busiField,
								$phoneNo,
                                $otherContact,
                                $address,
                                $remark
								)
	{
		$data = array (
			'contractorId' => $contractorId,
			'name' => $name,
			'artiPerson' => $artiPerson,
			'licenseNo' => $licenseNo,
			'busiField' => $busiField,
			'phoneNo' => $phoneNo,
            'otherContact' => $otherContact,
            'address' => $address,
            'remark' => $remark
		);

		$this->update($data, 'contractId = '.(int)$contractorId);
	}

	public function Search($key, $condition)
	{
		$select = $this->select();
		if($condition == "name")
		{
			$select->where("name like ?","%$key%");
			}
		elseif($condition == "artiPerson")
		{
			$select->where("artiPerson like ?","%$key%");
			}
		elseif($condition == "address")
		{
			$select->where("address like ?","%$key%");
			}
		elseif($condition == "remark")
		{
			$select->where("remark like ?","%$key%");
			}

    	$resultSet = $this->fetchAll($select);
		return $resultSet;
	}


}

?>
