<?php
/*
author:ming tingling
create date:2011.4.4
review rob 
date 2011.4.8
rewrite:mingtingling
date:2011.4.9
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
	  $contractors=new Contract_Models_ContractorMapper();
      $contractorId=$this->_getParam('id',0);
	  if($this->getRequest()->isPost())
		{
		      $formData=$this->getRequest()->getPost();
               if($editForm->isValid($formData))
			     { 
				      $contractor=new  Contract_Models_Contractor();
                      $contractor->setContractorId($contractorId);
					  $contractor->setName($editForm->getValue('name'));
					  $contractor->setLicenseNo($editForm->getValue('licenseNo'));
					  $contractor->setBusiField($editForm->getValue('busiField'));
					  $contractor->setPhoneNo($editForm->getValue('phoneNo'));
                      $contractor->setOtherContact($editForm->getValue('otherContact'));
					  $contractor->setAddress($editForm->getValue('address'));
					  $contractor->setRemark($editForm->getValue('remark'));
					  $contractors->save($contractor);
					  $this->_redirect('/contract/contractor');
			     }
			   else
			    {
				   $editForm->populate($formData);
			    }
		}
     else
		{
		       if($contractorId>0)
			      {
				    $arrayContractor=$contractors->findArrayContractor($contractorId);
					$editForm->populate($arrayContractor);
			      }
			  else
			     {
				   $this->_redirect('/contract/contractor');
			     }
		}
		$this->view->editForm=$editForm;
		$this->view->contractorId=$contractorId;
	}

public function addAction() // 添加
 {
	 $addForm=new Contract_Forms_ContractSave();
	 $addForm->submit->setLabel("保存继续新建:");
	 $addForm->submit2->setLabel("保存返回上页");
	 $contractors=new Contract_Models_ContractorMapper();
	 if($this->getRequest()->isPost())
	   {
		   $btClicked=$this->getRequest()->getPost('submit');
		   $formData=$this->getRequest()->getPost();
		   if($addForm->isValid($formData))
		      {
			     $contractor=new Contract_Models_Contractor();
				 $contractor->setName($addForm->getValue('name'));
				 $contractor->setArtiPerson($addForm->getValue('artiPerson'));
				 $contractor->setLicenseNo($addForm->getValue('licenseNo'));
				 $contractor->setBusiField($addForm->getValue('busiField'));
				 $contractor->setPhoneNo($addForm->getValue('phoneNo'));
				 $contractor->setOtherContact($addForm->getValue('otherContact'));
				 $contractor->setAddress($addForm->getValue('address'));
				 $contractor->setRemark($addForm->getValue('remark'));
                 $result=$contractors->save($contractor);
				 $addForm->getElement('name')->setValue('');
				 $addForm->getElement('artiPerson')->setValue(' ');
				 $addForm->getElement('licenseNo')->setValue(' ');
                 $addForm->getElement('busiField')->setValue(' ');
				 $addForm->getElement('phoneNo')->setValue(' ');
				 $addForm->getElement('otherContact')->setValue(' ');
				 $addForm->getElement('address')->setValue(' ');
				 $addForm->getElement('remark')->setValue(' ');
				 if($btClicked=="保存返回上页")
				     {
					   $this->_redirect('/contract/contractor');
				     }
		      }
	   }
	   else
	   {
		    $addForm->populate($formData);
	   }
	   $this->view->addForm=$addForm;
 }
 public function ajaxdeleteAction() /*删除*/
 {
	 $this->_helper->layout()->disableLayout();
	 $this->_helper->viewRenderer->setNoRender(true);
	 $contractorId=$this->_getParam('id',0);
	 if($contractorId>0)
	     {
		   $contractors=new Contract_Models_ContractorMapper();
		   $result=$contractors->delete($contractorId);
	     }
	 else
	    {
		 $this->_redirect('/contract');
	    }
 }
}