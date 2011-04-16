<?php
/*
Author: Meimo
Date: 2011.4.14
*/
class Material_ExportController extends Zend_Controller_Action
{
	public function init()
	{
		//Initialize action controller here
	}

	public function preDispatch()
	{
         $this->view->render("_sidebar.phtml");
	}

	public function indexAction()
	{
		//
		$exports = new Material_Models_ExportMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayExports = array();
			$key = $formData['key'];
			if($key!==null)
			{
				$condition = $formData['condition'];
				$arrayExports = $exports->fetchAllJoin($key,$condition);
				if(count($arrayExports)==0)
				{
					$errorMsg = 2;
					//waring a message  :  no match result
				}
			}
			else
			{
				$errorMsg = 1;
				//waring a message  :  please input a key word
			}
		}
		else
		{
			$arrayExports = $exports->fetchAllJoin();
		}
		$this->view->arrayExports = $arrayExports;
		$this->view->errorMsg = $errorMsg;
	}

	public function addAction()
	{
		//
		$addForm = new Material_Forms_ExportSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$addForm->approvId->setAttrib('class','hide');
		$addForm->approvDate->setAttrib('class','hide');

		$exports = new Material_Models_ExportMapper();
		$exports->populateExportDd($addForm);

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$export = new Material_Models_Export();
				$export->setProjectId($addForm->getValue('projectId'));
				$export->setExpType($addForm->getValue('expType'));
				$export->setExpDate($addForm->getValue('expDate'));
				$export->setDestId($addForm->getValue('destId'));
				$export->setApplicId($addForm->getValue('applicId'));
				$export->setApplicDate($addForm->getValue('applicDate'));
				$export->setexportType($addForm->getValue('exportType'));
				$export->setTotal($addForm->getValue('total'));
				$export->setRemark($addForm->getValue('remark'));
				$exports->save($export);
				if($btClicked=='保存继续新建')
				{
					$addForm->getElement('projectId')->setValue('');
					$addForm->getElement('expType')->setValue('');
					$addForm->getElement('expDate')->setValue('');
					$addForm->getElement('destId')->setValue('');
					$addForm->getElement('applicId')->setValue('');
					$addForm->getElement('applicDate')->setValue('');
					$addForm->getElement('exportType')->setValue('');
					$addForm->getElement('total')->setValue('');
					$addForm->getElement('remark')->setValue('');
					}
					else
					{
						$this->_redirect('/material/export');
						}
			}
			else
			{
				$this->populate($formData);
			}
		}
		 $this->view->addForm = $addForm;
	}

	public function editAction()
	{
		//
		$editForm = new Material_Forms_exportSave();
		$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');

		$exports = new Material_Models_ExportMapper();
    	$expId = $this->_getParam('id',0);

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
			{
				$export = new Material_Models_Export();
				$export->setexpId($expId);
				$export->setProjectId($editForm->getValue('projectId'));
				$export->setExpType($editForm->getValue('expType'));
				$export->setExpDate($editForm->getValue('expDate'));
				$export->setDestId($editForm->getValue('destId'));
				$export->setApplicId($editForm->getValue('applicId'));
				$export->setApplicDate($editForm->getValue('applicDate'));
				$export->setPlanType($editForm->getValue('PlanType'));
				$export->setApprovId($editForm->getValue('approvId'));
				$export->setApprovDate($editForm->getValue('approvDate'));
				$export->setTotal($editForm->getValue('total'));
				$export->setRemark($editForm->getValue('remark'));
				$exports->save($export);

				$this->_redirect('/material/export');
			}
			else
    			{
    				$editForm->populate($formData);
    				}
		}
		else
    	{
    		if($expId >0)
    		{
    			$arrayExport = $exports->findArrayExport($expId);
    			$editForm->populate($arrayExport);
    			}
    			else
    			{
    				$this->_redirect('/material/export');
    				}
    		}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $expId; 

	}

	public function ajaxdeleteAction()
	{
		//
		$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$expId = $this->_getParam('id',0);
    	if($expId > 0)
    	{
    		$exports = new Material_Models_ExportMapper();
    		$exports->delete($expId);
    		echo "1";
    		}
    		else
    		{
    			$this->_redirect('/material/export');
    			}

	}
}
?>