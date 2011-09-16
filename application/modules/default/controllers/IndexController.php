<?php

class IndexController extends Zend_Controller_Action
{
	public function init()
	{
		/* Initialize action controller here */
		$this->view->module = $this->_request->getModuleName();
		$this->view->controller = $this->_request->getControllerName();
	}

	public function indexAction()
	{
		$projects = new Project_Models_ProjectMapper();
		$vehicles = new Vehicle_Models_VehicleMapper();
		
		$arrayProjects = $projects->fetchAllJoin();
		$arrayVehicles = $vehicles->fetchAllJoin();
		
		$this->view->arrayProjects = $arrayProjects;
		$this->view->arrayVehicles = $arrayVehicles;
		
		$messages = new Admin_Models_MessageMapper();
		$validations = new Pment_Models_MplanMapper();
		
		$userId = $this->getUserId();
		$arrayMessages = $messages->fetchAllNews($userId);
		$arrayValidations = $validations->fetchAllValidations($userId);
		
		$this->view->arrayMessages = $arrayMessages;
		$this->view->arrayValidations = $arrayValidations;
	}

	protected function getUserId()
	{
		$userNamespace = new Zend_Session_Namespace('userNamespace');
		return $userNamespace->userId;
		}
}
?>