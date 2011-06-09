<?php
//updated in 8 june 2011 by rob

class Employee_Models_Contact
{
	protected $_contactId;
	protected $_name;
	protected $_gender;
	protected $_birth;
	protected $_age;
	protected $_titleName;
	protected $_titleSpec;
	protected $_deptName;
	protected $_dutyName;
	protected $_edu;
	protected $_enroll;
	protected $_political;
	protected $_idCard;
	protected $_ethnic;
	protected $_address;
	protected $_zip;
	protected $_phoneHome;
	protected $_phoneMob;
	protected $_residence;
	protected $_probStart;
	protected $_probEnd;
	protected $_profile;
	protected $_security;
	protected $_secIn;
	protected $_secDate;
	protected $_medical;
	protected $_relation1;
	protected $_name1;
	protected $_company1;
	protected $_address1;
	protected $_phone1;
	protected $_relation2;
	protected $_name2;
	protected $_company2;
	protected $_address2;
	protected $_phone2;
	protected $_relation3;
	protected $_name3;
	protected $_company3;
	protected $_address3;
	protected $_phone3;
	protected $_relation4;
	protected $_name4;
	protected $_company4;
	protected $_address4;
	protected $_phone4;
	protected $_remark;
	protected $_cTime;

	public function __construct(array $options=null)
	{
		if(is_array($options)){
 			$this->setOptions($options);
		}
	}

	public function __set($name, $value)
	{
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid contact property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid contact property');
		}
		return $this->$method();
	} 

	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
	}

	public function setContactId($contactId)
	{
		$this->_contactId = $contactId;
		return $this;
	}

	public function getContactId()
	{
		return $this->_contactId;
	}

	public function setName($name)
	{
		$this->_name = (string)$name;
		return $this;
	} 

	public function getName()
	{
		return $this->_name;
	}
	
	public function setGender($gender)
	{
		$this->_gender = $gender;
		return $this;
	} 

	public function getGender()
	{
		return $this->_gender;
	}

	public function setBirth($birth)
	{
		$this->_birth = $birth;
		return $this;
	}

	public function getBirth()
	{
		return $this->_birth;
	}
	
	public function setAge($age)
	{
		$this->_age = $age;
		return $this;
	}

	public function getAge()
	{
		return $this->_age;
	}

	public function setTitleName($titleName)
	{
		$this->_titleName= (string) $titleName;
		return $this;
	}

	public function getTitleName()
	{
		return $this->_titleName;
	}
//-------------------------------------------new-------------------------------------

	public function setTitleSpec($titleSpec)
	{
		$this->_titleSpec= (string) $titleSpec;
		return $this;
	}

	public function getTitleSpec()
	{
		return $this->_titleSpec;
	}
	
	public function setDeptName($deptName)
	{
		$this->_deptName= (string) $deptName;
		return $this;
	}

	public function getDeptName()
	{
		return $this->_deptName;
	}
	
	public function setDutyName($dutyName)
	{
		$this->_dutyName= (string) $dutyName;
		return $this;
	}

	public function getDutyName()
	{
		return $this->_dutyName;
	}
	
	public function setEdu($edu)
	{
		$this->_edu= (string) $edu;
		return $this;
	}

	public function getEdu()
	{
		return $this->_edu;
	}
	
	public function setEnroll($enroll)
	{
		$this->_enroll= (string) $enroll;
		return $this;
	}

	public function getEnroll()
	{
		return $this->_enroll;
	}
	
	public function setPolitical($political)
	{
		$this->_political= (string) $political;
		return $this;
	}

	public function getPolitical()
	{
		return $this->_political;
	}
//-------------------------------------------new end---------------------------------
	public function setIdCard($idCard)
	{
		$this->_idCard = $idCard;
		return $this;
	}

	public function getIdCard()
	{
		return $this->_idCard;
	}

	public function setEthnic($ethnic)
	{
		$this->_ethnic = $ethnic;
		return $this;
	}

	public function getEthnic()
	{
		return $this->_ethnic;
	}

	public function setAddress($address)
	{
		$this->_address = $address;
		return $this;
	}

	public function getAddress()
	{
		return $this->_address;
	}
//-------------------------------------------new-------------------------------------
	public function setZip($zip)
	{
		$this->_zip = $zip;
		return $this;
	}

	public function getZip()
	{
		return $this->_zip;
	}

	public function setPhoneHome($phoneHome)
	{
		$this->_phoneHome = $phoneHome;
		return $this;
	}
	public function getPhoneHome()
	{
		return $this->_phoneHome;
	}
	public function setPhoneMob($phoneMob)
	{
		$this->_phoneMob = $phoneMob;
		return $this;
	}

	public function getPhoneMob()
	{
		return $this->_phoneMob;
	}

	public function setResidence($residence)
	{
		$this->_residence = $residence;
		return $this;
	}

	public function getResidence()
	{
		return $this->_residence;
	}

	public function setProbStart($probStart)
	{
		$this->_probStart = $probStart;
		return $this;
	}

	public function getProbStart()
	{
		return $this->_probStart;
	}

	public function setProbEnd($probEnd)
	{
		$this->_probEnd = $probEnd;
		return $this;
	}

	public function getProbEnd()
	{
		return $this->_probEnd;
	}

	public function setProfile($profile)
	{
		$this->_profile = $profile;
		return $this;
	}

	public function getProfile()
	{
		return $this->_profile;
	}

	public function setSecurity($security)
	{
		$this->_security = $security;
		return $this;
	}

	public function getSecurity()
	{
		return $this->_security;
	}

	public function setSecIn($secIn)
	{
		$this->_secIn = $secIn;
		return $this;
	}

	public function getSecIn()
	{
		return $this->_secIn;
	}

	public function setSecDate($secDate)
	{
		$this->_secDate = $secDate;
		return $this;
	}

	public function getSecDate()
	{
		return $this->_secDate;
	}
	
	public function setMedical($medical)
	{
		$this->_medical = $medical;
		return $this;
	}

	public function getMedical()
	{
		return $this->_medical;
	}

	public function setRelation1($relation1)
	{
		$this->_relation1 = $relation1;
		return $this;
	}

	public function getRelation1()
	{
		return $this->_relation1;
	}

	public function setRelation2($relation2)
	{
		$this->_relation2 = $relation2;
		return $this;
	}

	public function getRelation2()
	{
		return $this->_relation2;
	}

	public function setRelation3($relation3)
	{
		$this->_relation3 = $relation3;
		return $this;
	}

	public function getRelation3()
	{
		return $this->_relation3;
	}

	public function setRelation4($relation4)
	{
		$this->_relation4 = $relation4;
		return $this;
	}

	public function getRelation4()
	{
		return $this->_relation4;
	}

	public function setName1($name1)
	{
		$this->_name1 = $name1;
		return $this;
	}

	public function getName1()
	{
		return $this->_name1;
	}

	public function setName2($name2)
	{
		$this->_name2 = $name2;
		return $this;
	}

	public function getName2()
	{
		return $this->_name2;
	}

	public function setName3($name3)
	{
		$this->_name3 = $name3;
		return $this;
	}

	public function getName3()
	{
		return $this->_name3;
	}

	public function setName4($name4)
	{
		$this->_name4 = $name4;
		return $this;
	}

	public function getName4()
	{
		return $this->_name4;
	}
	public function setAddress1($address1)
	{
		$this->_address1 = $address1;
		return $this;
	}

	public function getAddress1()
	{
		return $this->_address1;
	}

	public function setAddress2($address2)
	{
		$this->_address2 = $address2;
		return $this;
	}

	public function getAddress2()
	{
		return $this->_address2;
	}

	public function setAddress3($address3)
	{
		$this->_address3 = $address3;
		return $this;
	}

	public function getAddress3()
	{
		return $this->_address3;
	}

	public function setAddress4($address4)
	{
		$this->_address4 = $address4;
		return $this;
	}

	public function getAddress4()
	{
		return $this->_name4;
	}

	public function setCompany1($company1)
	{
		$this->_company1 = $company1;
		return $this;
	}

	public function getCompany1()
	{
		return $this->_company1;
	}

	public function setCompany2($company2)
	{
		$this->_company2 = $company2;
		return $this;
	}

	public function getCompany2()
	{
		return $this->_company2;
	}

	public function setCompany3($company3)
	{
		$this->_company3 = $company3;
		return $this;
	}

	public function getCompany3()
	{
		return $this->_company3;
	}

	public function setCompany4($company4)
	{
		$this->_company4 = $company4;
		return $this;
	}

	public function getCompany4()
	{
		return $this->_company4;
	}

	public function setPhone1($phone1)
	{
		$this->_phone1 = $phone1;
		return $this;
	}

	public function getPhone1()
	{
		return $this->_phone1;
	}

	public function setPhone2($phone2)
	{
		$this->_phone2 = $phone2;
		return $this;
	}

	public function getPhone2()
	{
		return $this->_phone2;
	}

	public function setPhone3($phone3)
	{
		$this->_phone3 = $phone3;
		return $this;
	}

	public function getPhone3()
	{
		return $this->_phone3;
	}

	public function setPhone4($phone4)
	{
		$this->_phone4 = $phone4;
		return $this;
	}

	public function getPhone4()
	{
		return $this->_phone4;
	}
//-------------------------------------------new end---------------------------------
	public function setRemark($remark)
	{
		$this->_remark = $remark;
		return $this;
	}

	public function getRemark()
	{
		return $this->_remark;
	}

	public function setCTime($cTime)
	{
		$this->_cTime = $cTime;
		return $this;
	}

	public function getCTime()
	{
		return $this->_cTime;
	}
}
?>