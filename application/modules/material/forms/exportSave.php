<?php
/*
	Richard Song
	2011.4.27
*/
class Material_Forms_exportSave extends Zend_Form
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
			'select', 'expType', array(
			'label' => '��������:',
			'multiOptions'=>array('����ʹ��','����','�˻�','�˻�','����'),
			'required' => true,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'expDate', array(
			'label' => '��������:',
			'required' => true,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'select', 'destId', array(
			'label' => '�����:',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
	   $this->addElement(
			'text', 'applicName', array(
			'label' => '�걨��:',
			'required' => true,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName'
			)
		);
	   	$this->addElement(
			'text', 'applicDate', array(
			'label' => '�걨����:',
			'required' => true,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName'
			)
		);
		$this->addElement(
			'select', 'palnType', array(
			'label' => '�ƻ�����:',
			'multiOptions'=>array('�ռƻ�','�ܼƻ�','�¼ƻ�''��ƻ�''��Ŀ�ƻ�','����'),
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'approvName', array(
			'label' => '������:',
			'required' => false,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName'
			)
		);
	 	$this->addElement(
			'text', 'approvDate', array(
			'label' => '����ʱ��:',
			'required' => false,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text', 'total', array(
			'label' => '�ܽ��:',
			'required' => false,
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
?>