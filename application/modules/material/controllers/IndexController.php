<?php
//Author: Meimo
//Date: 2011.4.14
class Material_IndexController extends Zend_Controller_Action
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
    	$errorMsg = null;
		$materials = new Material_Models_MaterialMapper();
		$errorMsg = null;
		if($this->getRequet()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayMaterials = array();
			$key = $formData['key'];
			if($key != null)
			{
				$condition = $formData['condition'];
				$arrayMaterials = $materials->fetchAllJoin($key,$condition);
				if(count($arrayMaterials) == 0)
				{
					$errorMsg = 2;
					}
				}
				else
				{
					$errorMsg = 1;
					}
		}
		else
		{
			$arrayMaterials = $materials->fetchAllJoin();
		}
		$this->view->arrayMaterials = $arrayMaterials;
		$this->view->errorMsg = $errorMsg;
    }
    
    public function addAction()
    {
    	$addForm = new Material_Forms_MaterialSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$addForm->approvId->setAttrib('class','hide');
		$addForm->approvDate->setAttrib('class','hide');

		$materials = new Material_Models_MaterialMapper();
		$result = null;

		if($this->getRequest()->isPost())
		{
			$btClicked = $this->getRequest()->getPost('submit');
			$formData = $this->getRequest()->getPost();
			if($addForm->isValid($formData))
			{
				$material = new Material_Models_Material();
				$material->setName($addForm->getValue('name'));
				$material->setTypeId($addForm->getValue('typeId'));
				$material->setSpec($addForm->getValue('spec'));
				$material->setUnit($addForm->getValue('unit'));
				$material->setRemark($addForm->getValue('remark'));
				$result = $materials->save($material);
				if($btClicked=='保存继续新建')
				{
					$addForm->getElement('name')->setValue('');
					$addForm->getElement('typeId')->setValue('');
					$addForm->getElement('spec')->setValue('');
					$addForm->getElement('unit')->setValue('');
					$addForm->getElement('remark')->setValue('');
					}
					else
					{
						$this->_redirect('/material');
						}
			}
			else
			{
				$this->populate($formData);
			}
		}
		 $this->view->addForm = $addForm;
		 $this->view->result = $result;
	}
    
    public function editAction()
    {
    	$editForm = new Material_Forms_MaterialSave();
		$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');

		$materials = new Material_Models_MaterialMapper();
    	$mtrId = $this->_getParam('id',0);
    	$result = null;

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
			{
				$material = new Material_Models_Material();
				$material->setMtrId($mtrId);
				$material->setName($editForm->getValue('name'));
				$material->setTypeId($editForm->getValue('typeId'));
				$material->setSpec($editForm->getValue('spec'));
				$material->setUnit($editForm->getValue('unit'));
				$material->setRemark($editForm->getValue('remark'));
				$result = $materials->save($material);

				//$this->_redirect('/material');
			}
			else
    			{
    				$editForm->populate($formData);
    				}
		}
		else
    	{
    		if($mtrId >0)
    		{
    			$arrayMaterial = $materials->findArrayMaterial($mtrId);
    			$editForm->populate($arrayMaterial);
    			}
    			else
    			{
    				$this->_redirect('/material');
    				}
    		}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $mtrId; 
    	$this->view->result = $result;
    }
    
    public function ajaxdeleteAction()
    {
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$mtrId = $this->_getParam('id',0);
    	if($mtrId > 0)
    	{
    		$materials = new Material_Models_MaterialMapper();
    		$materials->delete($mtrId);
    		echo "1";
    		}
    		else
    		{
    			$this->_redirect('/material');
    			}
    }
}

?>