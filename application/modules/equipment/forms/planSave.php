<?php
/*
��е�豸����ƻ���
author:mingtingling
date:2011-4-16
vision:2.0
*/
class Equipment_Forms_PlanSave extends Zend_Form
{
   public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'select','planType',array(
			'label'=>'�ƻ�����:',
			'class'=>'tbMedium tbText',
			'required'=>true,
			'multiOptions'=> array('0'=>'�ռƻ�','1'=>'�ܼƻ�','2'=>'�¼ƻ�','3'=>'��ƻ�','4'=>'��Ŀ�ƻ�','5'=>'����')
			)
		);
		$this->addElement(
			'text','dueDate',array(
			'label'=>'�ƻ���λ����:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker',
			'required'=>true
			)
		);
		$this->addElement(
			'select','projectId',array(
			'label'=>'��������:',
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'text','applicName',array(
			'label'=>'�걨��:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactId',
			'required'=>true
			)
		);
		$this->addElement(
			'text','applicDate',array(
			'label'=>'�걨ʱ��:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker',
			'required'=>false
			)
		);
		$this->addElement(
			'text','approvName',array(
			'label'=>'������:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName',
			'required'=>true
			)
		);
		$this->addElement(
			'text','approvDate',array(
			'label'=>'����ʱ��:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker',
			'required'=>false
			)
		);
		$this->addElement(
			'text','total',array(
			'label'=>'�ܽ��:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText',
			'required'=>false
			)
		);
		$this->addElement(
			'textarea','remark',array(
			'label'=>'��ע:',
			'class'=>'tbText',
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

		$this->addElement(
			'text','applicId',array(
			'required' => true,
			'class'=>'hide ac_contactId'
			)
		);

		$this->addElement(
			'text','approvId',array(
			'required' => true,
			'class'=>'hide ac_contactId'
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