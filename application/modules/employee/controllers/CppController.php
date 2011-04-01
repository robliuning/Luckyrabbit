<?php
/*
  created: 2011.3.31
  author: rob
  version: v0.2
*/
class Employee_PostController extends  Zend_Controller_Action
{
   public function init()
	{
	   /*初始化*/
	}
   public function preDispatch()
	{
	   /*边栏*/
	   $this->view->render("_sidebar.phtml");
	}
	public function indexAction()
    {
	   
	   	}
	public function editAction() /*修改*/
	{
	 
	 	}
 	public function addAction()/*新建*/
    {

	}
	public function ajaxDeleteAction()/*删除*/
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
	}
   public function ajaxDisplayAction() /*显示*/
    {
		$this->_helper->layout()->disableLayout();
		$id=$this->_getParam('id',0);
	}
}
?>