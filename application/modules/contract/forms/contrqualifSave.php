<?php
/*
	Richard Song
	2011.4.27
*/
class Contract_Forms_ContrqualifSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'select','contractorId',array(
			'label'=>'承包商:',
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'select','qualifSerie',array(
			'label'=>'资质序列:',
			'multiOptions'=>array('施工总承包'=>'施工总承包','专业承包'=>'专业承包','劳务分包'=>'劳务分包'),
			'class'=>'tbMedium tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'select','qualifTypeId',array(
			'label'=>'资质类别:',
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'text','qualifGrade',array(
			'label'=>'资质等级:',
			'class'=>'tbMedium tbText',
			'required'=>false
			)
		);

		$this->addElement(
			'submit','submit',array(
			'ignore'=>true,
			'class'=>'btConfirm radius',
			'name'=>'submit'
			)
		);
		$this->addElement(
			'submit','submit2',array(
			'ignore'=>true,
			'class'=>'btConfirm radius',
			'name'=>'submit'
			)
		);

		$this->setElementDecorators(
			array(
				'ViewHelper',
				'Errors',
				array(array('data'=>'HtmlTag'),
				array('tag'=>'td','class'=>'element')),
				array('Label',array('tag'=>'td')),
				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
			)
		);
		$this->setDecorators(
			array(
				'FormElements',
				array('HtmlTag',array('tag'=>'table')),
				'Form'
			)
		);
	}
}