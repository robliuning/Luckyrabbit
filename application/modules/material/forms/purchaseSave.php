<?php
	/*
	Created by Meimo
	Date 2011.4.1
	*/
class Material_Forms_purchaseSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'select', 'projectId', array(
			'label' => '��������:',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'select', 'venId', array(
			'label' => '��Ӧ��:',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'buyerName', array(
			'label' => '�ɹ�Ա:',
			'required' => true,
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName'
			)
		);
		$this->addElement(
			'text', 'Date', array(
			'label' => '�ɹ�����:',
			'required' => false,
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'select', 'destId', array(
			'label' => '����:',
			'required' => true,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'freight', array(
			'label' => '�˷�:',
			'required' => false,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'invoice', array(
			'label' => 'ԭʼ����:',
			'required' => false,
			'filters' => array('StringTrim'),
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'approvName', array(
			'label' => '������:',
			'required' => false,
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName'
			)
		);
		$this->addElement(
			'text', 'approvDate', array(
			'label' => '����ʱ��:',
			'required' => false,
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text', 'total', array(
			'label' => '�ܽ��:',
			'required' => false,
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'textarea', 'remark', array(
			'label' => '��ע:',
			'required' => false,
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
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
?>