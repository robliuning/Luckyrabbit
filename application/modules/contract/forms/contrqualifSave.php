<?php
/*
author:mingtingling
create date:2011.4.9
vision:2.0
*/
class Contract_Forms_ContrqualifSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$this->addElement(
			/*承包商编号*/
			'select','contractorId',array(
			'label'=>'承包商:',
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			/*资质序列*/
			'select','qualifSerie',array(
			'label'=>'资质序列:',
			'multiOptions'=>array('0'=>'施工总承包','1'=>'专业承包','2'=>'劳务分包'),
			'class'=>'tbMedium tbText',
			'required'=>true
			)
		);
		$this->addElement(
			/*资质类别*/	
			'select','qualifTypeId',array(
			'label'=>'资质类别:',
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			/*资质等级*/
			'select','qualifGrade',array(
			'label'=>'资质等级:',
			'multiOptions'=>array('0'=>'特级','1'=>'一级','2'=>'二级','3'=>'三级'),
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
		$this->setElementDecorators(array(
			'ViewHelper',
			'Errors',
			array(array('data'=>'HtmlTag'),
				array('tag'=>'td','class'=>'element')),
			array('Label',array('tag'=>'td')),
			array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
			)
		);

		$this->setDecorators(array(
			'FormElements',
			array('HtmlTag',array('tag'=>'table')),
			'Form'
			)
		);
	}
}