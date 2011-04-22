<?php
/*
工程设备调拨
author:mingtingling
date:2011-4-17
vision:2.0
Modified by MeiMo
Date:Apr.21.2011
*/
class Equipment_TransferController extends Zend_Controller_Action
{
	public function init()
	{
	}
	public function preDisPatch()
	{
		$this->view->render("_sidebar.phtml");
	}
	public function indexAction()
	{
		$errorMsg = null;
		$transfers=new Equipment_Models_TransferMapper();
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayTransfers = array();
			$key = $formData['key'];
			if($key != null)
			{
				$condition = $formData['condition'];
				$transfers->fetchAllJoin($key,$condition);
				
				if(count($arrayTransfers) == 0)
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
			$arrayTransfers = $transfers->fetchAllJoin();
			}
		
		$this->view->arrayTransfers = $arrayTransfers;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "equipment";
		$this->view->controller = "index";
		$this->view->modelName = "机械设备调拨单";
	}
	public function addAction()
	{
		$addForm=new Equipment_Forms_TransferSave();
		$addForm->submit->setLabel("保存并继续添加");
		$addForm->submit2->setLabel("保存并返回");
		$transfers=new Equipment_Models_transferMapper();
        $transfers->populateTransferDb($addForm);
		if($this->getRequest()->isPost())
		{
          $btClicked=$this->getRequest()->getPost('submit');
		  $formData=$this->getRequest()->getPost();
		  if($addForm->isValid($formData))
			{
			   $transfer=new Equipment_Models_transfer();
			   $transfer->setProjectId($addForm->getValue('projectId'));
			   $transfer->setTrsDate($addForm->getValue('trsDate'));
			   $transfer->setOrigId($addForm->getValue('origId'));
			   $transfer->setDestId($addForm->getValue('destId'));
			   $transfer->setApplicId($addForm->getValue('applicId'));
			   $transfer->setApplicDate($addForm->getValue('applicDate'));
			   $transfer->setPlanType($addForm->getValue('planType'));
			   $transfer->setApprovId($addForm->getValue('approvId'));
			   $transfer->setApprovDate($addForm->getValue('approvDate'));
			   $transfer->setTotal($addForm->getValue('total'));
			   $transfer->setRemark($addForm->getValue('remark'));
               if($btClicked=="保存并继续添加")
				    {
					   $transfers->save($transfer);
					   $addForm->getElement('projectId')->setValue('');
				     $addForm->getElement('trsDate')->setValue('');
					   $addForm->getElement('origId')->setValue('');
					   $addForm->getElement('destId')->setValue('');
					   $addForm->getElement('applicId')->setValue('');
					   $addForm->getElement('applicDate')->setValue('');
             $addForm->getElement('planType')->setValue('');
					   $addForm->getElement('approvId')->setValue('');
				     $addForm->getElement('approvDate')->setValue('');
				     $addForm->getElement('total')->setValue('');
				     $addForm->getElement('remark')->setValue('');
					   }
					   else
				       {
						   $transfers->save($transfer);
						   $this->_redirect('/equipment/transfer');
					      }
			}/*end isValid()*/
            else
			{
				$addForm->populate($formData);
			}/*end not valid()*/
		}/*end isPost()*/
		$this->view->addForm=$addForm;
	}
	public function editAction()
	{
     $editForm=new Equipment_Forms_TransferSave();
	   $editForm->submit->setLabel("保存修改");
	   $editForm->submit2->setAttrib('class','hide');
	   $trsId=$this->_getParam('id',0);
	   $transfers=new Equipment_Models_TransferMapper();
	   $transfers->populateTransferDb($editForm);
       if($this->getRequest()->isPost())
		{
		   $btClicked=$this->getRequest()->getPost('submit');
		   $formData=$this->getRequest()->getPost();
		   if($editForm->isValid($formData))
			{
			   $transfer=new Equipment_Models_Transfer();
			   $transfer->setTrsId($trsId);
			   $transfer->setProjectId($editForm->getValue('projectId'));
			   $transfer->setTrsDate($editForm->getValue('trsDate'));
			   $transfer->setOrigId($editForm->getValue('origId'));
			   $transfer->setDestId($editForm->getValue('destId'));
			   $transfer->setApplicId($editForm->getValue('applicId'));
			   $transfer->setApplicDate($editForm->getValue('applicDate'));
			   $transfer->setPlanType($editForm->getValue('planType'));
			   $transfer->setApprovId($editForm->getValue('approvId'));
			   $transfer->setApprovDate($editForm->getValue('approvDate'));
			   $transfer->setTotal($editForm->getValue('total'));
			   $transfer->setRemark($editForm->getValue('remark'));	$transfers->save($transfer);
			   $this->_redirect('/equipment/transfer');
			}/*end isValid()*/
			else
			{
				$editForm->populate($formData);
			}/*end not isValid()*/
		}/*end isPost()*/
		else
		{
			if($trsId>0)
			{
				$arrayTransfer=$transfers->findArrayTransfer($trsId);
				$editForm->populate($arrayTransfer);
			}
			else
			{
				$this->_redirect('/equipment/transfer');
			}
		}/*end not isPost()*/
      $this->view->editForm=$editForm;
	  $this->view->trsId=$trsId;
	}
	public function ajaxdeleteAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$trsId=$this->_getParam('id',0);
		if($trsId)
		{
			$transfers=new Equipment_Models_TransferMapper();
            $transfers->delete($trsId);
		}
		else
		{
			$this->_redirect('equipment/transfer');
		}
	}
	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$trsId = $this->_getParam('id',0);
		if($trsId>0)
		{
			$transfers = new Equipment_Models_TransferMapper();
			$transfer = new Equipment_Models_Transfer();
			$transfers->find($trsId,$transfer);
			$this->view->transfer = $transfer;
		}
		else
		{
            $this->_redirect('/equipment/transfer');
		}
		}
}