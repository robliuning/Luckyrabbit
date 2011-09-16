<?php
//Updated in 9th June by Rob

class Pment_Models_CppMapper
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
			$this->setDbTable('Pment_Models_DbTable_Cpp');
		}
		return $this->_dbTable;
	}

	public function save(Pment_Models_Cpp $cpp)
	{
		$data = array(
			'cppId' => $cpp->getCppId(),
			'contactId' => $cpp->getContactId(),
			'postId' => $cpp->getPostId(),
			'projectId' => $cpp->getProjectId(),
			'qualif' => $cpp->getQualif(),
			'startDate' => $cpp->getStartDate(),
			'responsi' => $cpp->getResponsi(),
			'remark' => $cpp->getRemark(),
			'certId' => $cpp->getCertId()
		);
		if (null === ($id = $cpp->getCppId())) {
			unset($data['cppId']);
			return $this->getDbTable()->insert($data);
		} else {
			return $this->getDbTable()->update($data, array('cppId = ?' => $cpp->getCppId()));
		}
	}

	public function find($cppId, Pment_Models_Cpp $cpp)
	{
		$result = $this->getDbTable()->find($cppId);

		if (0 == count($result)) {
			return;
		}

		$row = $result->current();

		$cpp->setCppId($row->cppId)
				->setContactId($row->contactId)
				->setPostId($row->postId)
				->setProjectId($row->projectId)
				->setQualif($row->qualif)
				->setStartDate($row->startDate)
				->setResponsi($row->responsi)
				->setRemark($row->remark)
				->setCertId($row->certId)
				->setCTime($row->cTime);
		$contactId = $cpp->getContactId();
		$projectId = $cpp->getProjectId();
		$postId = $cpp->getPostId();
	
		$contacts = new Employee_Models_ContactMapper();
		$cpp->setContactName($contacts->findContactName($contactId));
		
		$projects = new Project_Models_ProjectMapper();
		$cpp->setProjectName($projects->findProjectName($projectId));
				
		$posts = new General_Models_PostMapper();
		$post = $posts->findPostName($postId);
		$cpp->setPostName($post['name']);
		$cpp->setPostDetail($post['detail']);
	}

	public function delete($id)
	{
		$result = $this->getDbTable()->delete('cppId = ' . (int)$id);
		return $result;	
		}

	public function fetchAllJoin($key = null,$condition = null)
	{
		
		$paginator = $this->getDbTable()->fetchAllJoin($key,$condition);
		
		return $paginator;
		/*if($condition == null)
		{
			$resultSet = $this->getDbTable()->fetchAll();
			}
			else
			{
				$resultSet = $this->getDbTable()->search($key,$condition);
				}
		
		$entries = array();
		
		foreach ($resultSet as $row) 
		{
			$entry = new Pment_Models_Cpp();
			$entry->setCppId($row->cppId)
				->setContactId($row->contactId)
				->setPostId($row->postId)
				->setProjectId($row->projectId)
				->setQualif($row->qualif)
				->setStartDate($row->startDate)
				->setCertId($row->certId);
				
			$contactId = $entry->getContactId();
			$projectId = $entry->getProjectId();
			$postId = $entry->getPostId();
		
			$contacts = new Employee_Models_ContactMapper();
			$entry->setContactName($contacts->findContactName($contactId));
			
			$projects = new Project_Models_ProjectMapper();
			$entry->setProjectName($projects->findProjectName($projectId));
					
			$posts = new General_Models_PostMapper();
			$post = $posts->findPostName($postId);
			$entry->setPostName($post['name']);
			
			$entries[] = $entry;
			}
			return $entries;*/
	}

	public function findArrayCpp($id)
	{
		$entry = new Pment_Models_Cpp();
		
		$row = $this->getDbTable()->findArrayCpp($id);
		
		$contactId = $row['contactId'];
		$contacts = new Employee_Models_ContactMapper();
		$row['contactName'] = $contacts->FindContactName($contactId);

		return $row;
		}

	public function findContact($projectId,$postId) //need to be checked
	{
		$entries = $this->getDbTable()->findContact($projectId,$postId);
		return $entries;
		}

	public function populateCppDd($form)
	{
		$posts = new General_Models_PostMapper();
		$arrayPosts = $posts->fetchAll(); 

		foreach($arrayPosts as $post)
		{
			$form->getElement('postId')->addMultiOption($post->getPostId(),$post->getName());
			}
		}

	public function formValidator($form,$formType)
	{	
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('contactName')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('qualif')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('certId')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('startDate')->setAllowEmpty(false)
								->addValidator($emptyValidator);

		$dateValidator = new Zend_Validate_Date();
		$dateValidator->setMessage(General_Models_Text::$text_notDate);
		$form->getElement('startDate')->addValidator($dateValidator);
		
		return $form;
	}

	public function dataValidator($formData,$formType)
	{
		$errorMsg = null;
		$trigger = 0;

		if($formData['contactId'] == null)
		{
			$trigger = 1;
			$errorMsg = General_Models_Text::$text_vehicle_contact_notFound."<br/>".$errorMsg;
			}

		$array['trigger'] = $trigger;
		$array['errorMsg'] = $errorMsg;
		return $array;
	}
}
?>