<?php
//updated on 24th June by Rob

class File_Forms_FileSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text', 'display', array(
			'label' => '文件名(默认为上传文件名):',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'textarea', 'edition', array(
			'label' => '文号:',
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'select', 'inFlag', array(
			'label' => '内部文件:',
			'multiOptions'=>array('是'=>'是','否'=>'否'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'status', array(
			'label' => '复核状态:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'textarea', 'remark', array(
			'label' => '备注:',
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$element = new Zend_Form_Element_File('fileUpload');
		$element->setLabel('选择要上传的文件:')
				->setDestination('docs')
				->setRequired(true);
				// ensure only 1 file
		$element->addValidator('Count', false, 1);
				// limit to 100K
		$element->addValidator('Size', false, 50024000);
		$element->addValidator('Extension', false, array('pdf','doc','xls','dwg','ppt','rar'));
		$this->addElement($element, 'fileUpload');
		
		$this->addElement(
			'submit','submit',array(
			'ignore'=>true,
			'class'=>'btUploadImage radius',
			'name'=>'上传'
			)
		);
	}
}
?>