<?php
/*
author:ming tingling
create date:2011.4.4
vision:2.0
rewrite:mingtingling
rewrite date:2011.4.9
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
	public function indexAction()
	{
      $contrqualifs=new Contract_Models_ContrqualifMapper();
	  $data=array(
		  'cqId'=$contrqualifs->getCqId();
	      'contractorId'=$contrqualifs->getContractorId();
		  'qualifSerie'=$contrqualifs->getQualifSerie();
		  'qualifGrade'=$contrqualifs->getQualifGrade();
		  );
	$this->view->contrqualifs=$data;
	}
	public function editAction()  /*修改*/
	{
      $editForm=new Contract_Forms_ContrqualifSave();
	  $editForm->submit->setLabel("保存修改");
	  $editForm->submit2->setAttrib('class','hide');
	  $contrqualifs=new Contract_Models_ContrqualifMapper();
	  $contrqualifs->populateDd($editForm); /*下拉条*/
	  $cqId=$this->_getParam('id',0);
	  if($this->getRequest()->isPost())
		{
		  $formData=$this->getRequest()->getPost();
		  if($editForm->isValid($formData))
			{
			     $contrqualif=new Contract_Models_Contrqualif();
				 $contrqualif->setContractorId($editForm->getValue('contractorId'));
				 $contrqualif->setQualifSerie($editForm->getValue('qualifSerie'));
				 $contrqualif->setQualifGrade($editForm->getValue('qualifGrade'));
                 $contrqualifs->save($contrqualif);
				 $this->_redirect('/contract/contrqualif');
			}
		 else
			{
			    $editForm->populate($formData);
			}
		}
	else
		{
		   if($cqId>0)
			{
			    $arrayContrQualif=$contrqualifs->findArrayContrQualif($cqId);
				$editForm->populate($arrayContrQualif);
			}
		   else
			{
			   $this->_redirect('/contract/contrqualif');
			}
		}
	 $this->view->editForm=$editForm;
	 $this->view->cqId=$cqId;
	}
public function addAction() /*添加*/
 {
	  $addForm=new Contract_Forms_ContrqualifSave();
	  $addForm->submit->setLabel("保存继续新建");
	  $addForm->submit2->setLabel("保存返回上页");
	  $contrqualifs=new Contract_Models_ContrqualifMapper();
	  $contrqualifs->populateDd($addForm); /*下拉条*/
	  if($this->getRequest()->isPost())
	    {
		   $btClicked=$this->getRequest()->getPost('submit');
		   $formData=$this->getRequest()->getPost();
		   if($addForm->isValid($formData))
			{
			     $contrqualif=new Contract_Models_Contrqualif();
                 $contrqualif->setContractorId($addForm->getValue('contractorId'));
				 $contrqualif->setQualifSerie($addForm->getValue('qualifSerie'));
				 $contrqualif->setQualifType($addForm->getValue('qualifType'));
				 $contrqualif->setQualifGrade($addForm->getValue('qualifGrade'));
                 $result=$contrqualifs->save($contrqualif);
				 $addForm->getElement('contractorId')->setValue(' ');
				 $addForm->getElement('qualifSerie')->setValue(' ');
				 $addForm->getElement('qualifType')->setValue(' ');
				 $addForm->getElement('qualifGrade')->setValue(' ');
				 if($btClicked=="保存返回上页")
				   {
					 $this->_redirect('contract/contrqualif');
				   }
			}
		 else
			{
			 $addForm->populate($formData);
			}
	    }
 }
 public function ajaxdeleteAction() /*删除*/
 {
	 $this->_helper->layout()->disableLayout();
	 $this->_helper->viewRenderer->setNoRender(true);
	 $cqId=$this->_getParam('id',0);
	 if($cqId>0)
	 {
		 $contrqualifs=new Contract_Forms_ContrqualifSave();
		 $result=$contrqualif->delete($cqId);
	 }
    else
	 {
		$this->_redirect('/contract');
	 }
 }
}