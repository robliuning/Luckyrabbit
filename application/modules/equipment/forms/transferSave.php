<?php
/*
机械设备调拨单表表单
author:mingtingling
date:2011-4-17
vision:2.0
*/
class Equipment_Forms_TransferSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'select','projectId',array(
			'label'=>'工程名称:',
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'text','trsDate',array(
			'label'=>'调拨日期:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker',
			'required'=>true
			)
		);
		$this->addElement(
			'select','origId',array(
			'label'=>'调拨出发地:',
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'select','destId',array(
			'label'=>'调拨目的地:',
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'text','applicName',array(
			'label'=>'申报人:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName',
			'required'=>true
			)
		);
		$this->addElement(
			'text','applicDate',array(
			'label'=>'申报日期:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker',
			'required'=>false
			)
		);
		$this->addElement(
			'text','approvName',array(
			'label'=>'审批人:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName',
			'required'=>true
			)
		);
		$this->addElement(
			'text','approvDate',array(
			'label'=>'审批时间:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker',
			'required'=>false
			)
		);
		$this->addElement(
			'text','total',array(
			'label'=>'总金额:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText',
			'required'=>false
			)
		);
		$this->addElement(
			'textarea','remark',array(
			'label'=>'备注:',
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