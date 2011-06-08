<?php
//Updated on 29th May by Rob

class Pment_Models_ImageMapper
{
	protected $_dbTable;
	
	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}
	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->setDbTable('Pment_Models_DbTable_Image');
		}
		return $this->_dbTable;
	}
	public function save(Pment_Models_Image $image)
	{
		$data = array(
			'imageId' => $image->getImageId(),
			'projectId' => $image->getProjectId(),
			'prgType' => $image->getPrgType(),
			'prgId' => $image->getPrgId(),
			'imageSn' => $image->getImageSn(),
			'description' => $image->getDescription()
		);
		if (null === ($id = $image->getImageId())) {
			unset($data['imageId']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('imageId = ?' => $image->getImageId()));
		}
	}

	public function fetchAllJoin($key = null,$condition = null) //check
	{
		if($condition == null)
		{
			$resultSet = $this->getDbTable()->fetchAll();
			}
			else
			{
				$resultSet = $this->getDbTable()->search($key,$condition);
				}

		$images = array();

		foreach($resultSet as $row){
			$image = new Pment_Models_Image();
			$image ->setImageId($row->imageId)
				->setProjectId($row->projectId)
				->setPrgType($row->prgType)
				->setPrgId($row->prgId)
				->setImageSn($row->imageSn)
				->setDescription($row->description)
				->setCTime($row->cTime);
				
			$images[] = $image;
			}
		return $images;
		}

	public function delete($id)
	{
		$this->getDbTable()->delete('imageId = ' . (int)$id);
	}
}
?>