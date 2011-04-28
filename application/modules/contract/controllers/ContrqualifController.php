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
	
	public function indexAction() //done
	{
 		$addForm = new Contract_Forms_ContrqualifSave();
	  	$addForm->submit->setLabel("保存新建");
	  	$addForm->submit2->setAttrib('class','hide');
		$errorMsg = null;
	  	$contrqualifs = new Contract_Models_ContrqualifMapper();
	  	$condition = 0;
	  	$serie = "施工总承包";
	  	$contrqualifs->populateContrqualifDd($addForm,$condition,$serie);
	  	
	  	if($this->getRequest()->isPost())
	    {
		   	$formData = $this->getRequest()->getPost();
		   	$addForm->getElement('qualifTypeId')->setRegisterInArrayValidator(false);//学都了
		   	if($addForm->isValid($formData))
			{
				$contrqualif = new Contract_Models_Contrqualif();
        		$contrqualif->setContractorId($addForm->getValue('contractorId'));
				$contrqualif->setQualifTypeId($addForm->getValue('qualifTypeId'));
				$contrqualif->setQualifGrade($addForm->getValue('qualifGrade'));             
       			$result = $contrqualifs->save($contrqualif);
				$errorMsg = General_Models_Text::$text_save_success;
				$addForm->getElement('contractorId')->setValue('');
				$addForm->getElement('qualifSerie')->setValue('');
				$addForm->getElement('qualifTypeId')->setValue('');
				$addForm->getElement('qualifGrade')->setValue('');
				}
		 		else
				{
			 		$addForm->populate($formData);
					}
		}
		$this->view->errorMsg = $errorMsg;
		$this->view->addForm = $addForm;
	}
	
	public function editAction()  //done
	{
    	$editForm = new Contract_Forms_ContrqualifSave();
		$editForm->submit->setLabel("保存修改");
	  	$editForm->submit2->setAttrib('class','hide');
	  	$editForm->getElement('contractorId')->setAttrib('class','hide');
	  	$editForm->getElement('contractorId')->setLabel('');
	  	
	  	$contrqualifs = new Contract_Models_ContrqualifMapper();
	  	$condition = 0;
	  	$serie = "施工总承包";
	  	$contrqualifs->populateContrqualifDd($editForm,$condition,$serie); 
	  	$cqId = $this->_getParam('id',0);
	 
	  	if($this->getRequest()->isPost())
		{
			$formData=$this->getRequest()->getPost();
			$editForm->getElement('qualifTypeId')->setRegisterInArrayValidator(false);
		  	if($editForm->isValid($formData))
			{
				$contrqualif = new Contract_Models_Contrqualif();
				$contrqualif->setCqId($cqId);				
				$contrqualif->setContractorId($editForm->getValue('contractorId'));
				$contrqualif->setQualifTypeId($editForm->getValue('qualifTypeId'));
				$contrqualif->setQualifGrade($editForm->getValue('qualifGrade'));
        		$result = $contrqualifs->save($contrqualif);
				$this->_redirect('/contract/index/display/id/'.$editForm->getValue('contractorId'));
				}
		 		else
				{
			    	$editForm->populate($formData); //uncheck
					}
			}
			else
			{
				if($cqId>0)
				{
					$arrayContrqualif = $contrqualifs->findArrayContrQualif($cqId);
					$condition = 1;
					$serie = (string)$arrayContrqualif['qualifSerie'];
				  	$contrqualifs->populateContrqualifDd($editForm,$condition,$serie);
					$editForm->populate($arrayContrqualif);
					}
					else
					{
						$this->_redirect('/contract/contrqualif');
						}
				}
				
		$contractorId = $editForm->getValue('contractorId');
		$this->view->contractorId = $contractorId;
		$contractors = new Contract_Models_ContractorMapper();
		$contractorName = $contractors->findContractorName($contractorId);
		$this->view->contractorName = $contractorName;		
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
			try{
				$contrqualif->delete($cqId);
				echo "s";
			}
				catch(Exception $e)
				{
					echo "f";
			}
		}
		else
	 	{
			$this->_redirect('/contract');
		}
 	}
 	
 	public function ajaxdisplayAction() //done
 	{
 		$this->_helper->layout()->disableLayout();
 		$cqId = $this->_getParam('id',0);
    	if($cqId > 0)
		{
			$contrqualifs = new Contract_Models_ContrqualifMapper();
			$contrqualif = new Contract_Models_Contrqualif();
			$contrqualifs->find($cqId,$contrqualif);
      		$this->view->contrqualif = $contrqualif;
		}
		else
		{
			$this->_redirect('/contract/contrqualif');
		  }
 	}
 	
 	public function populateddAction() //done
 	{
 		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
 		$key = $this->_getParam('id');
 		if($key != null)
 		{
 			$contrqualifs = new Contract_Models_ContrqualifMapper();
 			
 			$arrayQualiftypes = $contrqualifs->findQualiftypes($key);
 			$json = Zend_Json::encode($arrayQualiftypes);
 			echo $json;  	
 			}
 			else
			{
				$this->_redirect('/contract/contrqualif');
		  	}
 	}
}