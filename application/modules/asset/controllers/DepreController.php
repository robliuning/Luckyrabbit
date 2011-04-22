<?php
/*
固定资产折旧
author:mingtingling
date:2011-4-17
vision:2.0
*/
class Asset_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }
    public function preDisPatch()
	{
		$this->view->render("_sidebar.phtml");
	}
    public function indexAction()
    {
		$errorMsg = null;
		$depres=new Asset_Models_DepreMapper();
		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			$arrayDepres = array();
			$key = $formData['key'];
			if($key != null)
			{
				$condition = $formData['condition'];
				$depres->fetchAllJoin($key,$condition);
				
				if(count($arrayDepres) == 0)
				{
					$errorMsg = 0;
					//warning will be displayed: "没有找到符合条件的结果。"
					}
				}
				else
				{
					$errorMsg = 1;
					//warning will be displayed: "请输入搜索关键字。"
					}
		}
		else
		{
			$arrayDepres = $depres->fetchAllJoin();
			}
		
		$this->view->arrayDepres = $arrayDepres;
		$this->view->errorMsg = $errorMsg;
		$this->view->module = "asset";
		$this->view->controller = "index";
		$this->view->modelName = "固定资产折旧信息";
    }
    public function addAction()
    {
           $addForm=new Asset_Forms_DepreSave();
		   $addForm->submit->setLabel("保存并继续添加");
		   $addForm->submit2->setLabel("保存并返回");
		   $depres=new Asset_Models_DepreMapper();
		   $depres->populateDepreDb($addForm);/*下拉条*/
	       if($this->getRequest()->isPost())
		     {
			   $btClicked=$this->getRequest()->getPost('submit');
			   $formData=$this->getRequest()->getPost();
			   if($addForm->isValid($formData))
				 {
				   $depre=new Asset_Models_Depre();
				   $depre->setPurId($addForm->getValue('purId'));
				   $depre->setProjectId($addForm->getValue('projectId'));
				   $depre->setQuantity($addForm->getValue('quantity'));
				   $depre->setInDate($addForm->getValue('inDate'));
				   $depre->setOutDate($addForm->getValue('outDate'));
				   $depre->setDepre($addForm->getValue('depre'));
				   $depre->setdepreAmt($addForm->getValue('depreAmt'));
				   $depre->setRemark($addForm->getValue('remark'));
				     if($btClicked=="保存并继续添加")
					     {
						    $depres->save($depre);
							/*下面可能会出错*/
							$addForm->getElement('purId')->setValue('purId');
							$addForm->getElement('projectId')->setValue('projectId');
							$addForm->getElement('quantity')->setValue('');
							$addForm->getElement('inDate')->setValue('');
							$addForm->getElement('outDate')->setValue('');
							$addForm->getElement('depre')->setValue('');
							$addForm->getElement('depreAmt')->setValue('');
							$addForm->getElement('remark')->setValue('');
						    }
							else
					        {
								$depres->save($depre);
								$this->_redirect('/asset/depre');
							   }
 
				 }
				 else
				 {
					 $addForm->populate($formData);
				 }
		     }
		$this->view->addForm=$addForm;
	}  
    
    public function editAction()
    {
     $editForm=	new Asset_Forms_DepreSave();
	 $editForm->submit->setLabel('保存修改');
	 $editForm->submit2->setAttrib('class','hide');
     $depres=new Asset_Models_DepreMapper();
	 $depres->populateDepreDb($editForm);/*下拉条*/
     $depId=$this->_getParam('id',0);
	 if($editForm->getRequest()->isPost())
		{
          $formData=$this->getRequest()->getPost();
		  if($addForm->isValid($formData))
			{
			  $depre=new Asset_Models_Depre();
			  $depre->setDepId($depId);
              $depre->setProjectId($editForm->getValue('projectId'));
              $depre->setQuantity($editForm->getValue('quantity'));
              $depre->setInDate($editForm->getValue('inDate'));
              $depre->setOutDate($editForm->getValue('outDate'));
              $depre->setDepre($editForm->getValue('depre'));
              $depre->setDepreAmt($editForm->getValue('depreAmt'));
			  $depre->setRemark($editForm->getValue('remark'));
              $depres->save($depre);
			  $this->_redirect('/asset/depre');
			}/*end of isValid()*/
			else
			{
				$editForm->populate($formData);
			}/*not isValid()*/
		}/*end of isPost()*/
		else
		{
			  if($depId>0)
			   {
				  $arrayDepre=$depres->findArrayDepre($depId);
				  $editForm->populate($arrayDepre);
			     }
				 else
        		 {
					 $this->redirect('/asset/depre');
				 }
		}/*not isPost()*/
		$this->view->editForm=$editForm;
		$this->view->depId=$depId;
    }
    
    public function ajaxdeleteAction()
    {
     $this->_helper->layout()->disableLayout();
	 $this->_helper->viewRenderer->setNoRender(true);
	 $depId=$this->_getParam('id',0);
	 if($depId>0)
		{
		 $depres=new Asset_Models_DepreMapper();
		 $depres->delete($depId);
 		  }/*legal*/
          else
		  {
           $this->_redirect('/asset/depre');
		  }/*illegal*/
    }
	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$depId=$this->_getParam('id',0);
		if($depId>0)
		{
			$depres=new Asset_Models_DepreMapper();
			$depre=new Asset_Models_Depre();
			$depres->find($depId,$depre);
			$this->view->depre=$depre;
		}/*legal*/
		else
		{
            $this->_redirect('/asset/depre');
		}/*illegal*/
	}
}