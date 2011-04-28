<?php
/*
机械设备采购单表表单
author:mingtingling
date:2011-4-16
vision:2.0
*/
class Equipment_Forms_PurchaseSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'select','projectId',array(
			'label'=>'工程名称:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'select','venId',array(
			'label'=>'供应商名称:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'text','buyerName',array(
			'label'=>'采购员:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName',
			'required'=>true
			)
		);
		$this->addElement(
			'text','purDate',array(
			'label'=>'采购日期:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker',
			'required'=>false
			)
		);
		$this->addElement(
			'select','planType',array(
			'label'=>'计划类型:',
			'class'=>'tbMedium tbText',
			'required'=>true,
			'multiOptions'=>array('0'=>'日计划','1'=>'周计划','2'=>'月计划','3'=>'年计划','4'=>'项目计划','5'=>'其他')			
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
			'select','destId',array(
			'label'=>'入库地:',
			'class'=>'tbLarge tbText',
			'required'=>false
			)
		);
		$this->addElement(
			'text','freight',array(
			'label'=>'运费:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText',
			'required'=>false
			)
		);
		$this->addElement(
			'text','invoice',array(
			'label'=>'原始采购单号:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
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

		$this->addElement(
			'text','buyerId',array(
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