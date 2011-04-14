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
        // action body
		$materials = new Material_Models_MaterialMapper();
		$this->view->arrayMaterial = $materials->fetchAllJoin();
    }
    
    public function addAction()
    {
    $addForm = new Material_Forms_MaterialSave();
	$addForm->submit->setLable('保存并继续添加');
	$addform->submit2->setLable('保存并返回');

	if($this->getRequest()->isPost())
		{
		$btClicked = $this->getRequest()->getPost('submit');
		$formData = $this->getRequest()->getPost();
		if($addForm->isValid($formData))
			{
			$material = new Material_Models_Material();
			$material->setName($addFrom->getValue('name'));
			$material->setType($addFrom->getValue('type'));
			$material->setSpec($addFrom->getValue('spec'));
			$material->setUnit($addFrom->getValue('unit'));
			$material->setRemark($addFrom->getValue('remark'));
			$materials->save($material);
			if($btClicked=='保存并继续添加')
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
			else
				{
				$this->populate($formData);
			}
		}
		 $this->view->addForm = $addForm;
	}
	

    }
    
    public function editAction()
    {
    $editForm = new Material_Models_MaterialSave();
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
				$material->setType($editForm->getValue('type'));
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
    	$this->view->id = $material; 

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
    
    public function searchAction()
    {
    	//key => user input 
    	//conditon => material name,type and spc
		$materials = new Material_Models_MaterialMapper();

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$material = new Material_Models_Material();
				$material->setMtrId($mtrId);
				$material->setName($editForm->getValue('name'));
				$material->setType($editForm->getValue('type'));
				$material->setSpec($editForm->getValue('spec'));
				$material->setUnit($editForm->getValue('unit'));
				$material->setRemark($editForm->getValue('remark'));
				$materials->fetchAllJoin()
		}


    }
}

?>