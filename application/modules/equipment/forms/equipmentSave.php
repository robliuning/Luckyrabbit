<?php
/*
��е�豸��Ϣ��
author:mingtingling
date:2011-4-16
vision:2.0
*/
class Equipment_Forms_EquipmentSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text','name',array(
			'label'=>'��е�豸����:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'select','typeId1',array(  /*������Ҫ��*/
			'label'=>'һ������:',
			'class'=>'tbMedium tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'select','typeId2',array(  /*������Ҫ��*/
			'label'=>'��������:',
			'class'=>'tbMedium tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'select','typeId3',array(  /*������Ҫ��*/
			'label'=>'��������:',
			'class'=>'tbMedium tbText',
			'required'=>true
			)
		);		
		$this->addElement(
			'text','spec',array(
			'label'=>'����ͺ�:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required'=>false
			)
		);
		$this->addElement(
			'text','unit',array(
			'label'=>'��λ:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'textarea','remark',array(
			'label'=>'��ע:',
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