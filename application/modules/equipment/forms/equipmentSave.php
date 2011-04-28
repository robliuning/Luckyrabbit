<?php
/*
	Richard Song
	2011.4.27
*/
class Equipment_Forms_EquipmentSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text','name',array(
			'label'=>'机械设备名称:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'select','typeId1',array(  /*可能需要改*/
			'label'=>'一级类型:',
			'class'=>'tbMedium tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'select','typeId2',array(  /*可能需要改*/
			'label'=>'二级类型:',
			'class'=>'tbMedium tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'select','typeId3',array(  /*可能需要改*/
			'label'=>'三级类型:',
			'class'=>'tbMedium tbText',
			'required'=>true
			)
		);		
		$this->addElement(
			'text','spec',array(
			'label'=>'规格型号:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required'=>false
			)
		);
		$this->addElement(
			'text','unit',array(
			'label'=>'单位:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'textarea','remark',array(
			'label'=>'备注:',
			'class'=>'tbLarge tbText',
			'required'=>false,
			'cols' => 60,
			'rows' => 4
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