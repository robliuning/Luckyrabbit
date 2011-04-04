<?php
/*
author:ming tingling
create date:2011.4.4
vision:2.0
*/
class Contract_ContrqualifController extends Zend_Controller_Action
{
	public function init()
	{
		/*初始化*/
	}
	public function preDisPatch()
	{
		$this->view->render("_sidebar.phtml");
	}
	public function indexAction()   /*其实是add*/
	{
       $contractor=new Contract_Models_ContractMapper();
	   $this->view->entries=$contracotr->fetchAll(); /*调用models/contractorMapper.php的fetchAll方法，没有参数*/
	}
	public function editAction()  /*修改*/
	{
      $editForm=new Contract_Forms_ContractSave();
	  $editForm->submit->setLabel("保存修改");
	  $editForm->submit2->setAttrib('class','hide');
	  /*下拉条*/
	  $contractors=new Contract_Models_DbTable_Contract();
      
	  /*end*/
	}
}