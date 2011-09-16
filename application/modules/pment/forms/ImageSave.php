<?php
//updated on 24th May by Rob

class Pment_Forms_ImageSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$element = new Zend_Form_Element_File('imageUpload');
		$element->setLabel('选择要上传的图片:')
				->setDestination('images/upload')
				->setRequired(true);
				// ensure only 1 file
		$element->addValidator('Count', false, 1);
				// limit to 100K
		$element->addValidator('Size', false, 2024000);
				// only JPEG, PNG, and GIFs
		$element->addValidator('Extension', false, 'jpg');
		$this->addElement($element, 'imageUpload');

		$this->addElement(
			'textarea', 'description', array(
			'label' => '图片描述:',
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		
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