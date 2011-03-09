<?php
	class Application_Model_Employee
	{
		protected $_eId;
		protected $_eName;
		protected $_email;
		protected $_created
		
		public function __set($name,$value);
		public function __get($name);
		
		public function setId($eId);
		public function getId();
		
		public function setEname($eName);
		public function getEname();
		
		public function setEmail($email);
		public function getEmail();
		
		public function setCreated($date);
		public function getCreated();
		
		}
	class Application_Model_EmployeeMapper
	{
		public function save(Application_Model_Employee $employee);
		public function find($id);
		public function fetchAll();
		}
?>