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
			$key = $formData['key'];
			if($key != null)
			{
				$condition = $formData['condition'];
				$equipments->fetchAllJoin($key,$condition);
				
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
		   $addForm->submit->setLabel("保存并继续添加");
		   $addForm->submit2->setLabel("保存并返回");
		   $equipments = new Equipment_Models_EquipmentMapper();
		   $equipments->populateEquipmentDb($addForm);/*下拉菜单*/
	       if($this->getRequest()->isPost())
		     {
			   $btClicked = $this->getRequest()->getPost('submit');
			   $formData = $this->getRequest()->getPost();
			   if($addForm->isValid($formData))
				 {
				   $equipment = new Equipment_Models_Equipment();
				   $equipment->setName($addForm->getValue('name'));
				   /*下面的有可能名称要修改typeId1,typeId2,typeId3*/
				   $equipment->setTypeId1($addForm->getValue('typeId1'));
           $equipment->setTypeId2($addForm->getValue('typeId2'));
				   $equipment->setTypeId3($addForm->getValue('typeId3'));
				   $equipment->setSpec($addForm->getValue('spec'));
				   $equipment->setUnit($addForm->getValue('unit'));
				   $equipment->setRemark($addForm->getValue('remark'));
				    if($btClicked=="保存并继续添加")
					     {
						    $equipments->save($equipment);
							/*以下有可能出错*/
							$addForm->getElement('name')->setValue('');
							$addForm->getElement('typeId')->setValue('');
							$addForm->getElement('spec')->setValue('');
							$addForm->getElement('unit')->setValue('');
							$addForm->getElement('remark')->setValue('');
						    }
							else
					        {
								$equipments->save($equipment);
								$this->_redirect('/equipment');
							   }
 
				 }
				 else
				 {
					 $addForm->populate($formData);
				 }
		     }
		$this->view->addForm = $addForm;
	}  
    
    public function editAction()
    {
			$editForm =	new Equipment_Forms_EquipmentSave();
			$editForm->submit->setLabel('保存修改');
			$editForm->submit2->setAttrib('class','hide');
			$equipments = new Equipment_Models_EquipmentMapper();
			$equipments->populateEquipmentDb($editForm);/*下拉条*/
			$eqpId=$this->_getParam('id',0);
	 if($editForm->getRequest()->isPost())
		{
		  		$btClicked = $this->getRequest()->getPost('submit');
          $formData = $this->getRequest()->getPost();
		  if($addForm->isValid($formData))
			{
			  $equipment = new Equipment_Models_Equipment();
			  $equipment->setEqpId($eqpId);
        $equipment->setName($editForm->getValue('name'));
			  /*有可能需要修改typeId1,typeId2,typeId3*/
			  $equipment->setTypeId1($editForm->getValue('typeId1'));
			  $equipment->setTypeId2($editForm->getValue('typeId2'));
			  $equipment->setTypeId3($editForm->getValue('typeId3'));
			  $equipment->setSpec($editForm->getValue('spec'));
			  $equipment->setUnit($editForm->getValue('unit'));
			  $equipment->setRemark($editForm->getValue('remark'));
			  $equipments->save($equipment);
			  $this->_redirect('/equipment');
			}/*end of isValid()*/
			else
			{
				$editForm->populate($formData);
			}/*not isValid()*/
		}/*end of isPost()*/
		else
		{
			  if($cqpId>0)
			   {
				  $arrayEquipment = $equipments->findArrayEquipment($cqpId);
				  $editForm->populate($arrayEquipment);
			     }
				 else
        		 {
					 $this->redirect('/equipment');
				 }
		}/*not isPost()*/
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
	public function ajaxdisplayAction() /*由于indexAction里面缺少remark这一项，所以需要写这个action*/
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$cqpId = $this->_getParam('id',0);
		if($cqpId>0)
		{
			$equipments = new Equipment_Models_EquipmentMapper();
			$equipment = new Equipment_Models_Equipment();
			$equipments->find($cqpId,$equipment);
			$this->view->equipment = $equipment;
		}/*legal*/
		else
		{
            $this->_redirect('/equipment');
		}/*illegal*/
	}
}
