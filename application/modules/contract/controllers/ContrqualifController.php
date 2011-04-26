<?php
/*
author:ming tingling
create date:2011.4.4
vision:2.0
rewrite:mingtingling
rewrite date:2011.4.9
Modified by MeiMo,Apr.22.2011
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
 			$addForm = new Contract_Forms_ContrqualifSave();
	  	$addForm->submit->setLabel("保存继续新建");
	  	$addForm->submit2->setAttrib('class','hide');
	  	
	  	$contrqualifs = new Contract_Models_ContrqualifMapper();
	  	
	  	$contrqualifs->populateAllDd($addForm);
	  	
	  	if($this->getRequest()->isPost())
	    {
		   	$formData = $this->getRequest()->getPost();
		   	if($addForm->isValid($formData))
			{
				$contrqualifs = new Contract_Models_Contrqualif();
        $contrqualif->setContractorId($addForm->getValue('contractorId'));
				$contrqualif->setQualifTypeId($addForm->getValue('qualifTypeId'));
				$contrqualif->setQualifGrade($addForm->getValue('qualifGrade'));             
       	$result = $contrqualifs->save($contrqualif);
				$addForm->getElement('contractorId')->setValue('');
				$addForm->getElement('qualifTypeId')->setValue('');
				$addForm->getElement('qualifGrade')->setValue('');
				}
		 		else
				{
			 		$addForm->populate($formData);
					}
	    	}
	    $this->view->addForm = $addForm;
	}
	
	public function editAction()  /*修改*/
	{
    $editForm = new Contract_Forms_ContrqualifSave();
	  $editForm->submit->setLabel("保存修改");
	  $editForm->submit2->setAttrib('class','hide');

	  $contrqualifs = new Contract_Models_ContrqualifMapper();
	  $contrqualifs->populateAllDd($editForm); 
	  $cqId=$this->_getParam('id',0);
	 
	  	if($this->getRequest()->isPost())
		{
			$formData=$this->getRequest()->getPost();
		  	if($editForm->isValid($formData))
			{
				$contrqualifs = new Contract_Models_Contrqualif();
				$contrqualif->setCqId($cqId);				
				$contrqualif->setContractorId($editForm->getValue('contractorId'));
				$contrqualif->setQualifTypeId($editForm->getValue('qualifTypeId'));
				$contrqualif->setQualifGrade($editForm->getValue('qualifGrade'));
        $result = $contrqualifs->save($contrqualif);
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
					$arrayContrqualif = $contrqualifs->findArrayContrQualif($cqId);
					$editForm->populate($arrayContrqualif);
					}
					else
					{
						$this->_redirect('/contract/contrqualif');
						}
				}
				
	$this->view->editForm=$editForm;
	$this->view->cqId=$cqId;
	}

 public function ajaxdeleteAction() /*删除*/
 {
	$this->_helper->layout()->disableLayout();
	$this->_helper->viewRenderer->setNoRender(true);
	$cqId = $this->_getParam('id',0);
		if($cqId>0)
		{
		 $contrqualifs = new Contract_Forms_ContrqualifSave();
		 $result = $contrqualif->delete($cqId);
			}
    else
	 {
		$this->_redirect('/contract');
			}
 }
 	public function ajaxdisplayAction()
 	{
 			$cpId = $this->_getParam('id',0);
    if($cpId>0)
		{
			$contrqualifs = new Contract_Models_ContrqualifMapper();
			$object = new Contract_Models_Contrqualif();
			$arrayContrqualifs = $contrqualifs->find($contrqualifs,$object);
      $this->view->arrayContrqualifs = $arrayContrqualifs;
			}
		else
		{
			$this->_redirect('/contract/contrqualif');
		  }
 		}
}