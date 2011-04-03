<?php
  //creation date 03-04-2011
  //creating by lincoy
  //completion date 03-04-2011
class Project_Models_ProjectLog
{
	protected $_projectId;
	protected $_logDate;
	protected $_weather;
	protected $_tempHi;
	protected $_tempLo;
	protected $_progress;
	protected $_qualityPbl;
	protected $_safetyPbl;
	protected $_otherPbl;
	protected $_relatedFile;
	protected $_mMinutes;
	protected $_changeSig;
	protected $_material;
	protected $_machine;
	protected $_utility;
	protected $_remark;
	protected $_ctime;

	public function setProjectId($projectId)
	{
		$this->_projectId = $projectId;
		return $this;
	}
	public function getProjectId()
	{
		return $this->_projectId;
	}
	/*************************************************/

	public function setLogDate($logDate)
	{
		$this->_logDate = $logDate;
		return $this;
	}
	public function getLogDate()
	{
		return $this->_logDate;
	}
	/*************************************************/

	public function setWeather($weather)
	{
		$this->_weather = $weather;
		return $this;
	}
	public function getWeather()
	{
		return $this->_weather;
	}
	/*************************************************/

	public function setTempHi($tempHi)
	{
		$this->_tempHi = $tempHi;
		return $this;
	}
	public function getTempHi()
	{
		return $this->_tempHi;
	}
	/*************************************************/

	public function setTempLo($tempLo)
	{
		$this->_tempLo = $tempLo;
		return $this;
	}
	public function getTempLo()
	{
		return $this->_tempLo;
	}
	/*************************************************/

	public function setProgress($progress)
	{
		$this->_progress = $progress;
		return $this;
	}
	public function getProgress()
	{
		return $this->_progress;
	}
	/*************************************************/

	public function setQualityPbl($qualityPbl)
	{
		$this->_qualityPbl = $qualityPbl;
		return $this;
	}
	public function getQualityPbl()
	{
		return $this->_qualityPbl;
	}
	/*************************************************/

	public function setSafetyPbl($safetyPbl)
	{
		$this->_safetyPbl = $safetyPbl;
		return $this;
	}
	public function getSafetyPbl()
	{
		return $this->_safetyPbl;
	}
	/*************************************************/

	public function setOtherPbl($otherPbl)
	{
		$this->_otherPbl = $otherPbl;
		return $this;
	}
	public function getOtherPbl()
	{
		return $this->_otherPbl;
	}
	/*************************************************/

	public function setRelatedFile($relatedFile)
	{
		$this->_relatedFile = $relatedFile;
		return $this;
	}
	public function getRelatedFile()
	{
		return $this->_relatedFile;
	}
	/*************************************************/

	public function setMMinutes($mMinutes)
	{
		$this->_mMinutes = $mMinutes;
		return $this;
	}
	public function getMMinutes()
	{
		return $this->_mMinutes;
	}
	/*************************************************/

	public function setChangeSig($changeSig)
	{
		$this->_changeSig = $changeSig;
		return $this;
	}
	public function getChangeSig()
	{
		return $this->_changeSig;
	}
	/*************************************************/

	public function setMaterial($material)
	{
		$this->_material = $material;
		return $this;
	}
	public function getMaterial()
	{
		return $this->_material;
	}
	/*************************************************/

	public function setMachine($machine)
	{
		$this->_machine = $machine;
		return $this;
	}
	public function getMachine()
	{
		return $this->_machine;
	}
	/*************************************************/

	public function setUtility($utility)
	{
		$this->_utility = $utility;
		return $this;
	}
	public function getUtility()
	{
		return $this->_utility;
	}
	/*************************************************/

	public function setRemark($remark)
	{
		$this->_remark = $remark;
		return $this;
	}
	public function getRemark()
	{
		return $this->_remark;
	}
	/*************************************************/

	public function setCTime($cTime)
	{
		$this->_cTime = $cTime;
		return $this;
	}
	public function getCTime()
	{
		return $this->_cTime;
	}
	/*************************************************/
	
}
?>