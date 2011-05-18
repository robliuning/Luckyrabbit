<?php
//机械设备信息
//Init by Rob
//Date: 2011.4.16
/*
author:mingtingling
date:2011-4-16
vision:2.0
Modified by MeiMo
Date:Apr.21.2011
*/

class Equipment_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }
    public function preDisPatch()
	{
		$this->view->render("_sidebar.phtml");
	}
    public function indexAction()
    {
		$errorMsg = null;
		$equipments = new Equipment_Models_EquipmentMapper();
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayEquipments = array();
			$key = trim($formData['key']);
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayEquipments = $equipments->fetchAllJoin($key,$condition);
				
				if(count($arrayEquipments) == 0)
				{
					$errorMsg = General_Models_Text::$text_searchErrorNr;
					//warning will be displayed: "没有找到符合条件的结果。"
					}
				}
				else
				{
					$errorMsg = General_Models_Text::$text_searchErrorNi;
					//warning will be displayed: "请输入搜索关键字。"
					}
		}
		else
		{
			$arrayEquipments = $equipments->fetchAllJoin();
			}
		
		$this->view->arrayEquipments = $arrayEquipments;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "equipment";
		$this->view->controller = "index";
		$this->view->modelName = "机械设备信息";
    }
    public function addAction()
    {
    	$addForm = new Equipment_Forms_EquipmentSave();
		$addForm->submit->setLabel("保存继续新建");
		$addForm->submit2->setLabel("保存返回上页");
		$errorMsg = null;
		
		$equipments = new Equipment_Models_EquipmentMapper();
		$equipments->populateEqptypeDd($addForm);
		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$equipment = new Equipment_Models_Equipment();
				$equipment->setName($addForm->getValue('name'));
				$equipment->setTypeId($addForm->getValue('typeId'));
				$equipment->setSpec($addForm->getValue('spec'));
				$equipment->setUnit($addForm->getValue('unit'));
				$equipment->setRemark($addForm->getValue('remark'));
				$equipments->save($equipment);
				$errorMsg = General_Models_Text::$text_save_success;  
				if($btClicked=="保存继续新建")
				{
					$addForm->getElement('name')->setValue('');
					$addForm->getElement('typeId')->setValue('');
					$addForm->getElement('spec')->setValue('');
					$addForm->getElement('unit')->setValue('');
					$addForm->getElement('remark')->setValue('');
				    }
					else
			       	{
						$this->_redirect('/equipment');
					}
				 }
				 else
				 {
					 $addForm->populate($formData);
				 }
		     }
		$this->view->errorMsg = $errorMsg;
		$this->view->addForm = $addForm;
	}  
    
    public function editAction()
    {
		$editForm =	new Equipment_Forms_EquipmentSave();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$equipments = new Equipment_Models_EquipmentMapper();
		$equipments->populateEqptypeDd($editForm);
		$eqpId = $this->_getParam('id',0);
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($editForm->isValid($formData))
			{
				$equipment = new Equipment_Models_Equipment();
				$equipment->setEqpId($eqpId);
				$equipment->setName($editForm->getValue('name'));
				$equipment->setTypeId($editForm->getValue('typeId'));
				$equipment->setSpec($editForm->getValue('spec'));
				$equipment->setUnit($editForm->getValue('unit'));
				$equipment->setRemark($editForm->getValue('remark'));
				$equipments->save($equipment);
				$this->_redirect('/equipment');
			}
			else
			{
				$editForm->populate($formData);
			}
		}
		else
		{
			if($eqpId>0)
			{
				$arrayEquipment = $equipments->findArrayEquipment($eqpId);
				$editForm->populate($arrayEquipment);
				}
				else
				{
					$this->_redirect('/equipment');
				}
		}
		$this->view->editForm = $editForm;
		$this->view->cqpId = $eqpId;
    }
    
  public function ajaxdeleteAction()
    {
     $this->_helper->layout()->disableLayout();
		 $this->_helper->viewRenderer->setNoRender(true);
	 	 $cqpId = $this->_getParam('id',0);
	 		if($cqpId>0)
			{
		 		$equipments = new Equipment_Models_EquipmentMapper();
		 		$equipments->delete($cqpId);
 		  	}/*legal*/
      		else
		  	{
           $this->_redirect('/equipment');
		  }/*illegal*/
    }
    
	public function ajaxdisplayAction() 
	{
		$this->_helper->layout()->disableLayout();
		
		$eqpId = $this->_getParam('id',0);
		if($eqpId>0)
		{
			$equipments = new Equipment_Models_EquipmentMapper();
			$equipment = new Equipment_Models_Equipment();
			$equipments->find($eqpId,$equipment);
			$this->view->equipment = $equipment;
		}/*legal*/
		else
		{
            $this->_redirect('/equipment');
		}/*illegal*/
	}
	    
    public function ajaxpopulatemiddAction()
    {
   		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$id = $this->_getParam('id',0);
    	if($id >0)
    	{ 			
    		$equipments = new Equipment_Models_EquipmentMapper();
 			
 			$arrayEquipments = $equipments->findEquipmentNames($id);
 			$json = Zend_Json::encode($arrayEquipments);
 			echo $json;  		
   			}
    		else
    		{
   				$this->_redirect('/equipment');
   				}
    }
    
    public function ajaxpopulatemtddAction()
    {
   		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);		
    	$equipments = new Equipment_Models_EquipmentMapper();
 			
 		$arrayEquipments = $equipments->findEquipmentTypes();
 		$json = Zend_Json::encode($arrayEquipments);
 		echo $json;  		
    } 
}
