<?php
/*
  created: 2011.3.31
  author: rob
  version: v0.2
*/
class Employee_CppController extends  Zend_Controller_Action
{
   public function init()
	{
		/* Initialize action controller here */
	}
   public function preDispatch()
	{
	   $this->view->render("_sidebar.phtml");
	}
	public function indexAction()
    {
	 	$cpp = new Employee_Models_CppMapper();
      	$this->view->entries = $cpp->fetchAll();
	   	}
	public function editAction() /*�޸�*/
	{
	 
	 	}
 	public function addAction()/*�½�*/
    {

	}
	public function ajaxDeleteAction()/*ɾ��*/
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
	}
   public function ajaxDisplayAction() /*��ʾ*/
    {
		$this->_helper->layout()->disableLayout();
		$id=$this->_getParam('id',0);
	}
}
?>