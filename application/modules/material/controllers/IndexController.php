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
		$materials = new Material_Models_MaterialMapper();
		$errorMsg = null;
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayMaterials = array();
			$key = trim($formData['key']);
			if($key!=null)
			{
				$condition = $formData['condition'];
				$arrayMaterials = $materials->fetchAllJoin($key,$condition);
				if(count($arrayMaterials) == 0)
				{
					$errorMsg = General_Models_Text::$text_searchErrorNr;
					}
				}
				else
				{
					$errorMsg = General_Models_Text::$text_searchErrorNi;
					}
		}
		else
		{
			$arrayMaterials = $materials->fetchAllJoin();
		}
		$this->view->arrayMaterials = $arrayMaterials;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "material";
		$this->view->controller = "index";
		$this->view->modelName = "材料信息"; 
    }
    
    public function addAction()
    {
		$addForm = new Material_Forms_materialSave();
		$addForm->submit->setLabel('保存继续新建');
		$addForm->submit2->setLabel('保存返回上页');
		$errorMsg = null;
		$materials = new Material_Models_MaterialMapper();
		$materials->populateMtrtypeDd($addForm);

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
				$errorMsg = General_Models_Text::$text_save_success;
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
		$this->view->errorMsg = $errorMsg;
		$this->view->addForm = $addForm;
	}
    
    public function editAction()
    {
    	$editForm = new Material_Forms_MaterialSave();
		$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');

		$materials = new Material_Models_MaterialMapper();
		$materials->populateMtrtypeDd($editForm);
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
			try{
				$materials->delete($mtrId);
				echo "s";
			}
			catch(Exception $e)
			{
				echo "f";
			}
    		}
    	else
    	{
    		$this->_redirect('/material');
    	}
    }
    
    public function ajaxdisplayAction()
    {
    	$this->_helper->layout()->disableLayout();
   		$id = $this->_getParam('id',0);
    	if($id >0)
    	{
   		  	$materials = new Material_Models_MaterialMapper();
   		  	$material = new Material_Models_Material();
   			$materials->find($id,$material);
   			$this->view->material = $material;
   			}
    		else
    		{
   				$this->_redirect('/material');
   				}
    }
    
    public function ajaxpopulatemiddAction()
    {
   		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$id = $this->_getParam('id',0);
    	if($id >0)
    	{ 			
    		$materials = new Material_Models_MaterialMapper();
 			
 			$arrayMaterials = $materials->findMaterialNames($id);
 			$json = Zend_Json::encode($arrayMaterials);
 			echo $json;  		
   			}
    		else
    		{
   				$this->_redirect('/material');
   				}
    }
    
    public function ajaxpopulatemtddAction()
    {
   		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);		
    	$materials = new Material_Models_MaterialMapper();
 			
 		$arrayMaterials = $materials->findMaterialTypes();
 		$json = Zend_Json::encode($arrayMaterials);
 		echo $json;  		
    } 
}
?>