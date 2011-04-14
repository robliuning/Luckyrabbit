<?php
//Author: Meimo
//Date: 2011.4.14
class Material_PlanController extends Zend_Controller_Action
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
		$materials = new Material_Models_MaterialMapper();
		
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			
			$key = $formData['key'];
			$condition = $formData['condition'];
			$arrayMaterials = $materials->fetchAllJoin($key,$condition);
		}
		else
		{
			$arrayMaterials = $materials->fetchAllJoin();
			}
		
		$this->view->arrayMaterials = $arrayMaterials;
    }
    
    public function addAction()
    {
    	$addForm = new Material_Forms_MaterialSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$materials = new Material_Models_MaterialMapper();

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
				$materials->save($material);
				if($btClicked=='保存继续新建')
				{
					$addFrom->getElement('name')->setValue('');
					$addFrom->getElement('type')->setValue('');
					$addFrom->getElement('spec')->setValue('');
					$addFrom->getElement('unit')->setValue('');
					$addFrom->getElement('remark')->setValue('');
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
	}
    
    public function editAction()
    {
    	$editForm = new Material_Forms_MaterialSave();
		$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');

		$materials = new Material_Models_MaterialMapper();
    	$mtrId = $this->_getParam('id',0);

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
				$materials->save($material);

				$this->_redirect('/material');
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