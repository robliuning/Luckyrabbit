<?php
//2011.3.17  rob
//1.Data to populate db.deptName, dutyName, titleName will be added later
//2.Validation of inputs is missing (better with ajax)
//3.Set focus for each form
//4.For add and edit, the employeemapper has been skipped, the dbTable is used directly.
//5.Reconsider the use of zend_form
//6.Messagebox for sucessful adding, editting and deleting
//7.Missing Paginator for displayAction
//8.Need to validate the deletion result

class Vehicle_VeRecordController extends Zend_Controller_Action
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
    	$verecord = new Application_Model_VeRecordMapper();
      	$this->view->entries = $verocord->fetchAll();
    }
    
    
  
  public function editAction()                                   //修改
    {
    	$editForm = new Employee_form_edit();
    	$editForm->submit->setLabel('保存修改');
    	$editForm->submit2->setAttrib('class','hide');
    	$this->view->form = $editForm;
    	$this->view->id = $this->_getParam('id');
    	
    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$recordID = $this->_getParam('id');
    			$name = $editForm->getValue('name');
    			$dateOfUse = $editForm->getValue('dateOfUse');
    			$purpose = $editForm->getValue('purpose');
    			$milesBf = $editForm->getValue('milesAf');
    			$pilot = $editForm->getValue('pilot');
    			$otherUsers = $editForm->getValue('otherUsers');  
    			$remark = $editForm->getValue('remark');
    			    			
    			$verecs = new Application_Model_DbTable_VeRecord();
    			$verecs->updateVeRecord($recordID,$name,$dateOfUse,$purpose,$milesBf,$milesAf,$pilot,$otherUsers,$remark);    			
    			
    			
    			
    			$this->_redirect('/vehicle/VeRecord');
    			}
    			else
    			{
    				$editForm->populate($formData);
    				}
    		}
    		else
    		{
    			$id=$this->_getParam('id',0);
    			if($id >0)
    			{
    			    $verecs = new Application_Model_DbTable_VeRecord();
    				$editForm->populate($verecs->getVeRecord($recordID));
    				}
    				else
    				{
    					$this->_redirect('/vehicle/VeRecord');
    					}
    			}
    	}


    
    public function addAction()                       //新建
    {
        $editForm = new Vehicle_Form_VeRecordSave();
        $editForm->submit->setLabel('保存继续新建');
        $editForm->submit2->setLabel('保存返回上页');
    	$tbId = $editForm->getElement('recordID');
    	$tbId->setValue('车辆使用记录在保存新建后自动生成');
    	$this->view->form = $editForm;
    	
    	if($this->getRequest()->isPost())
    	{
    		$dec = $this->getRequest()->getPost('submit');
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$recordID = $editForm->getValue('recordID');
    			$name = $editForm->getValue('name');
    			$dateOfUse = $editForm->getValue('dateOfUse');
    			$purpose = $editForm->getValue('purpose');
    			$milesBf = $editForm->getValue('milesBf');
    			$milesAf = $editForm->getValue('milesAf');
    			$pilot = $editForm->getValue('pilot');
    			$otherUsers = $editForm->getValue('otherUsers');
    			$remark = $editForm->getValue('remark');
    			    			
    			$verecs = new Application_Model_DbTable_VeRecord();
    			$verecs->addVeRecord($recordID,$name,$dateOfUse,$purpose,$milesBf,$milesAf,$pilot,$otherUsers,$remark);   
    			if($dec == '保存继续新建')
    			{
   					$editForm->getElement('recordID')->setValue('');
   					$editForm->getElement('name')->setValue('');
   					$editForm->getElement('dateOfUse')->setValue('');
   					$editForm->getElement('purpose')->setValue('0');
   					$editForm->getElement('milesBf')->setValue('0');
   					$editForm->getElement('milesAf')->setValue('');
   					$editForm->getElement('pilot')->setValue('');
					$editForm->getElement('otherUsers')->setValue('');
   					$editForm->getElement('remark')->setValue('');
   					}
   					else
    				{
    					$this->_redirect('/Vehicle/VeRecord');
    					} 			
    			}
    			else
    			{
    				$editForm->populate($formData);
    				}
    		}
    }
    
   
  
   public function deleteAction()                //删除
    {
        $this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   
   
   		$id=$this->_getParam('id',0);
    	if($id >0)
    	{
    		$verecs = new Application_Model_DbTable_VeRecord();
    		$verecs->deleteVeRecord($id);
    		echo "1";
    		}
    		else
    		{
    			$this->_redirect('/vehicle/VeRecord');
    			}
    }
   	
   //	public function searchAction()
   //{
   	
   //	}
   	
  
  
   	public function displayAction()              //浏览
   	{
   		$this->_helper->layout()->disableLayout();
   		$id=$this->_getParam('id',0);
    	if($id >0)
    	{
   		    $verecs = new Application_Model_DbTable_VeRecord();
   			$verec = $verecs->getVeRecord($id);
   			$this->view->verecord = $verec;
   			}
    		else
    		{
   				$this->_redirect('/vehicle/VeRecord');
   				}
   		}
}
?>