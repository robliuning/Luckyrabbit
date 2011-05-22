<?php
//Author: Meimo
//Date: 2011.4.8


class Project_LogController extends Zend_Controller_Action
{
	public function init()
	{
		/*Initialize action controller here */
	}

	public function preDispatch(){
		$this -> view -> render("_sidebar.phtml");
	}

	public function indexAction()                    //新建
	{
	//this is an add action.
		$addForm = new Project_Forms_LogSave();
		$addForm->submit->setLabel('保存新建');
		$addForm->submit2->setAttrib('class','hide');
		$errorMsg = null;
		$logs = new Project_Models_LogMapper();
		$logs->populateLogDd($addForm);
	
		if($this->getRequest()->isPost())
    	{
			$formData = $this->getRequest()->getPost();
    		if($addForm->isValid($formData))
    		{
				$projectlog = new Project_Models_Log();
    			$projectlog->setProjectId($addForm->getValue('projectId'));
    			$projectlog->setLogDate($addForm->getValue('logDate'));
    			$projectlog->setWeather($addForm->getValue('weather'));
    			$projectlog->setTempHi($addForm->getValue('tempHi'));
    			$projectlog->setTempLo($addForm->getValue('tempLo'));
    			$projectlog->setProgress($addForm->getValue('progress'));
    			$projectlog->setQualityPbl($addForm->getValue('qualityPbl'));
    			$projectlog->setsafetyPbl($addForm->getValue('safetyPbl'));
    			$projectlog->setOtherPbl($addForm->getValue('otherPbl'));
				$projectlog->setRelatedFile($addForm->getValue('relatedFile')); 
				$projectlog->setMMinutes($addForm->getValue('mMinutes'));
    			$projectlog->setChangeSig($addForm->getValue('changeSig'));
    			$projectlog->setMaterial($addForm->getValue('material'));
    			$projectlog->setMachine($addForm->getValue('machine'));
    			$projectlog->setUtility($addForm->getValue('utility'));
				$projectlog->setRemark($addForm->getValue('remark'));
				
				//Missing validation: check if log exists
				$logs->save($projectlog);
				$errorMsg = General_Models_Text::$text_save_success;
				$addForm->reset();
				}
		   else
			{
			   $addForm->populate($formData);
		   }
		}
		$this->view->errorMsg = $errorMsg;
		$this->view->addForm = $addForm;
	}

	public function editAction()                       //编辑
	{	
		$editForm = new Project_Forms_LogSave();
		$editForm->submit->setLabel('保存修改');
		$editForm->submit2->setAttrib('class','hide');
		$editForm->getElement('projectId')->setAttrib('class','hide');
     	$editForm->getElement('projectId')->setLabel('');
    
		$logs = new Project_Models_LogMapper();
		$logs->populateLogDd($editForm);
		
		$plogId = $this->_getParam('id',0); 
   	
    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$projectlog = new Project_Models_Log();
				$projectlog->setPLogId($plogId);
    			$projectlog->setProjectId($editForm->getValue('projectId'));
    			$projectlog->setLogDate($editForm->getValue('logDate'));
    			$projectlog->setWeather($editForm->getValue('weather'));
    			$projectlog->setTempHi($editForm->getValue('tempHi'));
    			$projectlog->setTempLo($editForm->getValue('tempLo'));
    			$projectlog->setProgress($editForm->getValue('progress'));
    			$projectlog->setQualityPbl($editForm->getValue('qualityPbl'));
    			$projectlog->setSafetyPbl($editForm->getValue('safetyPbl'));
    			$projectlog->setOtherPbl($editForm->getValue('otherPbl'));
				$projectlog->setRelatedFile($editForm->getValue('relatedFile')); 
				$projectlog->setMMinutes($editForm->getValue('mMinutes'));
    			$projectlog->setChangeSig($editForm->getValue('changeSig'));
    			$projectlog->setMaterial($editForm->getValue('material'));
    			$projectlog->setMachine($editForm->getValue('machine'));
    			$projectlog->setUtility($editForm->getValue('utility'));
				$projectlog->setRemark($editForm->getValue('remark'));
    			$logs->save($projectlog); 
    			 
    			$this->_redirect('/project/log/display/id/'.$plogId);
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
					$arrayLog = $logs->findArrayLog($id);
    				$editForm->populate($arrayLog);
    				}
    				else
    				{
    					$this->_redirect('/project/Log');
    					}
    			}		
    	$this->view->editForm = $editForm;
    	$this->view->id = $plogId;     	
	}

	public function displayAction()
	{
		$logs = new Project_Models_LogMapper();
		$log = new Project_Models_Log();
		$pLogId = $this->_getParam('id',0);
		if($pLogId >0)
		{
       		$logs->find($pLogId,$log);   
	   		$this->view->plog = $log;      		
    		}

    		else
    		{
    			$this->_redirect('/project/Log');
    			}
	}
}
?>