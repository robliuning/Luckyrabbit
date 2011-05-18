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
			'label'=>'��������:',
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'select','venId',array(
			'label'=>'����������:',
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'textarea','renRes',array(
			'label'=>'��������:',
			'class'=>'tbText',
			'required'=>false
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'text','personName',array(
			'label'=>'������:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName',
			'required'=>true
			)
		);
		$this->addElement(
			'text','startDate',array(
			'label'=>'���޿�ʼʱ��:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker',
			'required'=>false,
			)
		);
		$this->addElement(
			'text','endDate',array(
			'label'=>'���޽���ʱ��:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker',
			'required'=>false
			)
		);
		$this->addElement(
			'select','planType',array(
			'label'=>'�ƻ�����:',
			'class'=>'tbMedium tbText',
			'required'=>true,
			'multiOptions'=>array('0'=>'�ռƻ�','1'=>'�ܼƻ�','2'=>'�¼ƻ�','3'=>'��ƻ�','4'=>'��Ŀ�ƻ�','5'=>'����')
			)
		);
		$this->addElement(
			'text','approvName',array(
			'label'=>'������:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName',
			'required'=>false
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
			'text','freight',array(
			'label'=>'�˷�:',
			'filters'=>array('StringTrim'),
			'class'=>'tnMedium tbText',
			'required'=>false
			)
		);
		$this->addElement(
			'text','invoice',array(
			'label'=>'ԭʼ���޵���:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required'=>false
			)
		);

		$this->addElement(
			'text','total',array(
			'label'=>'�ܽ��:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLMedium tbText',
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