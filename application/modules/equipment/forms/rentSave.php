<?php
/*
	Richard Song
	2011.4.27
*/
class Equipment_Forms_RentSave extends Zend_Form
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
			'select','venId',array(
			'label'=>'租赁商名称:',
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'textarea','renRes',array(
			'label'=>'租赁责任:',
			'class'=>'tbText',
			'required'=>false
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'text','personName',array(
			'label'=>'经办人:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName',
			'required'=>true
			)
		);
		$this->addElement(
			'text','startDate',array(
			'label'=>'租赁开始时期:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker',
			'required'=>false,
			)
		);
		$this->addElement(
			'text','endDate',array(
			'label'=>'租赁结束时间:',
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
			'required'=>false
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
			'text','freight',array(
			'label'=>'运费:',
			'filters'=>array('StringTrim'),
			'class'=>'tnMedium tbText',
			'required'=>false
			)
		);
		$this->addElement(
			'text','invoice',array(
			'label'=>'原始租赁单号:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required'=>false
			)
		);

		$this->addElement(
			'text','total',array(
			'label'=>'总金额:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLMedium tbText',
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
			'text','personId',array(
			'required' => true,
			'class' => 'hide ac_contactId'
			)
		);	
		$this->addElement(
			'text','approvId',array(
			'required' => true,
			'class' => 'hide ac_contactId'
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