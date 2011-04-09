<?php
/*
author:ming tingling
create date:2011.4.4
review rob 
date 2011.4.8
*/
class Contract_IndexController extends Zend_Controller_Action
{
	public function init()
	{
		/*初始化*/
	}
	public function preDisPatch()
	{
		$this->view->render("_sidebar.phtml");
	}
	public function indexAction()
	{
       $contractors=new Contract_Models_ContractorMapper();
	   $this->view->arrayContractors = $contractors->fetchAll(); 
	}
	public function editAction()  /*修改*/
	{
      $editForm=new Contract_Forms_ContractSave();
	  $editForm->submit->setLabel("保存修改");
	  $editForm->submit2->setAttrib('class','hide');
	  /*下拉条*/
	  $contractors=new Contract_Models_DbTable_Contract();
      $contractors->populateContractDb($editForm);
	  /*end*/

	}
}