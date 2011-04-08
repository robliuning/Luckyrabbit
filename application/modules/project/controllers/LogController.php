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
	   $addForm->submit->setLable('保存新建');
    	$editForm->submit2->setAttrib('class','hide');

	$logs = new Project_Models_LogMapper();
	$logs->populateLogDb($addForm);
	
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
    			$projectlog->setSaftyPbl($addForm->getValue('saftyPbl'));
    			$projectlog->setOtherPbl($addForm->getValue('otherPbl'));
				$projectlog->setRelatedFile($addForm->getValue('relatedFile')); 
				$projectlog->setMMiniutes($addForm->getValue('mMinutes'));
    			$projectlog->setChangeSig($addForm->getValue('changeSig'));
    			$projectlog->setMaterial($addForm->getValue('material'));
    			$projectlog->setMachine($addForm->getValue('machine'));
    			$projectlog->setUtility($addForm->getValue('utility'));
				$projectlog->setRemark($addForm->getValue('remark'));
				$logs->save($projectlog);

				$addForm->getElement('logDate')->setValue('');
				$addForm->getElement('weather')->setValue('');
				$addForm->getElement('tempHi')->setValue('');
				$addForm->getElement('tempLo')->setValue('');
				$addForm->getElement('progress')->setValue('');
				$addForm->getElement('qualityPbl')->setValue('');
				$addForm->getElement('saftyPbl')->setValue('');
				$addForm->getElement('otherPbl')->setValue('');
				$addForm->getElement('relatedFile')->setValue('');
				$addForm->getElement('mMinutes')->setValue('');
				$addForm->getElement('changeSig')->setValue('');
				$addForm->getElement('material')->setValue('');
				$addForm->getElement('machine')->setValue('');
				$addForm->getElement('utility')->setValue('');
				$addForm->getElement('remark')->setValue('');
				}
		   else
			{
			   $addForm->($formData);
		   }
		}
		$this->view->addForm = $addForm;
	}

	public function ajaxSearch()                  //查看
	{
	   $this->_helper->layout()->disableLayout();
       $this->_helper->viewRenderer->setNoRender(true);
		
	   $startDate = "2011-4-5";
	   $endDate = "2011-4-8";
   	   $pLogId = $this->_getParam('id',0);
    	if($pLogId >0)
    	{
   		    $logs = new Project_Models_LogMapper();
   			$arrayLogs = $logs->fetchAllDates($startDate,$endDate,$pLogId);
   			$this->view->arraylogs = $arrayLogs;
   			}
    		else
    		{
   				$this->_redirect('/project/log');
   				}
	}


	public function editAction()                       //编辑
	{	$editForm->submit2->setAttrib('class','hide');
		//this is an edit action.
		$editForm = new Project_Forms_ProjectlogSave();
    	$editForm->submit->setLabel('保存修改');
    

		$logs = new Project_Models_LogMapper();
		$logs->populateLogDd($editForm);
		
		$plogId = $this->_getParam('id',0); 
   	
    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if($editForm->isValid($formData))
    		{
    			$projectlog = new Project_Models_Log();
				$projectlog->setPLogId($editForm->$this->_getParam('pLogId'));
    			$projectlog->setProjectId($editForm->getValue('projectId'));
    			$projectlog->setLogDate($editForm->getValue('logDate'));
    			$projectlog->setWeather($editForm->getValue('weather'));
    			$projectlog->setTempHi($editForm->getValue('tempHi'));
    			$projectlog->setTempLo($editForm->getValue('tempLo'));
    			$projectlog->setProgress($editForm->getValue('progress'));
    			$projectlog->setQualityPbl($editForm->getValue('qualityPbl'));
    			$projectlog->setSaftyPbl($editForm->getValue('saftyPbl'));
    			$projectlog->setOtherPbl($editForm->getValue('otherPbl'));
				$projectlog->setRelatedFile($editForm->getValue('relatedFile')); 
				$projectlog->setMMiniutes($editForm->getValue('mMinutes'));
    			$projectlog->setChangeSig($editForm->getValue('changeSig'));
    			$projectlog->setMaterial($editForm->getValue('material'));
    			$projectlog->setMachine($editForm->getValue('machine'));
    			$projectlog->setUtility($editForm->getValue('utility'));
				$projectlog->setRemark($editForm->getValue('remark'));
    			$logs->save($projectlog); 
    			 
    			$this->_redirect('/project/Log');
    			}
    			else
    			{
    				$editForm->populateLogDb($formData);
    				}
    		}
    		else
    		{
    			$id=$this->_getParam('id',0);
    			if($id >0)
    			{
    			    $arrayLog = $logs->find($projectId);
    				$editForm->populateLogDb($arrayLog);
    				}
    				else
    				{
    					$this->_redirect('/project/Log');
    					}
    			}		
    	$this->view->form = $editForm;
    	$this->view->id = $plogId;     	
	}

	public function displayAction()
	{
		$logs = new Project_Models_LogMapper();
		$pLog = new Project_Models_Log();
		$pLogId = $this->_getParam('id',0);
		if($pLogId >0)
       {
       		$log = $logs->find($pLogId);   
	   		$this ->view->pLog = $pLog;      		
    		}

    		else
    		{
    			$this->_redirect('/project/Log');
    			}
	}


}
?>