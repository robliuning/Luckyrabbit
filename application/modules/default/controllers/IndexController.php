<?php

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		$projects = new Project_Models_ProjectMapper();
		$vehicles = new Vehicle_Models_VehicleMapper();
		
		$arrayProjects = $projects->fetchAllJoin();
		$arrayVehicles = $vehicles->fetchAllJoin();
		
		$this->view->arrayProjects = $arrayProjects;
		$this->view->arrayVehicles = $arrayVehicles;
	}


}

?>