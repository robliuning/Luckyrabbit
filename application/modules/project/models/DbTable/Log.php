<?php
  //creation date 04-04-2011
  //creating by lincoy
  //completion date 04-04-2011

class Project_Models_DbTable_Log extends Zend_Db_Table_Abstract
{
    protected $_name = 'pm_projectlogs';
	
	public function getLog($projectId)
	{
		$projectId = (int)$projectId;
		$row = $this->fetchRow('projectId = '.$projectId);
		if(!$row){
			throw new Exception("Could not find row $projectId");
		}
		return $row->toArray();
	}

	public function addLog( 
		                        $projectId,
		                        $logDate,
		                        $weather,
		                        $tempHi,
		                        $tempLo,
		                        $progress,
		                        $qualityPbl,
		                        $safetyPbl,
		                        $otherPbl,
		                        $relatedFile,
		                        $mMinutes,
		                        $changeSig,
		                        $material,
		                        $machine,
		                        $utility,
		                        $remark
		                        )
	{
		$data = array(
			'projectId' => $projectId,
			'logDate' => $logDate,
			'weather' => $weather,
			'tempHi' => $tempHi,
			'tempLo' => $tempLo,
			'progress' => $progress,
			'qualityPbl' => $qualityPbl,
			'safetyPbl' => $safetyPbl,
			'otherPbl' => $otherPbl,
			'relatedFile' => $relatedFile,
			'mMinutes' => $mMinutes,
			'changeSig' => $changeSig,
			'material' => $material,
			'machine' => $machine,
			'utility' => $utility,
			'remark' => $remark
			);
		$this->insert($data);
	}

	public function updateLog(
		                        $projectId,
				                $logDate,
		                        $weather,
		                        $tempHi,
		                        $tempLo,
		                        $progress,
		                        $qualityPbl,
		                        $safetyPbl,
		                        $otherPbl,
		                        $relatedFile,
		                        $mMinutes,
		                        $changeSig,
		                        $material,
		                        $machine,
		                        $utility,
		                        $remark
		                      )
	{
		$data = array(
			'projectId' => $projectId,
			'logDate' => $logDate,
			'weather' => $weather,
			'tempHi' => $tempHi,
			'tempLo' => $tempLo,
			'progress' => $progress,
			'qualityPbl' => $qualityPbl,
			'safetyPbl' => $safetyPbl,
			'otherPbl' => $otherPbl,
			'relatedFile' => $relatedFile,
			'mMinutes' => $mMinutes,
			'changeSig' => $changeSig,
			'material' => $material,
			'machine' => $machine,
			'utility' => $utility,
			'remark' => $remark
			);
		$this->update($data,'projectId = '.(int)$projectId);
	}

	public function deleteLog($projectId)
	{
		$this->delete('projectId = '.(int)$projectId);
	}

 /*	public function populateDd($form)         //填充structype
	{
		$strucTypes = new General_Models_DbTable_StrucType();
		$options = $strucTypes->fetchAll();
		foreach($options as $op)
		{
			$form->getElement('structType')->addMultiOption($op->strucTypesId,$op->name);
			}
	}  */
}
?>