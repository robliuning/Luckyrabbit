<?php
//updated on 31th May by Rob

class Pment_Forms_TrainingSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text', 'traDate', array(
			'label' => '*培训日期:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'textarea', 'content', array(
			'label' => '*培训内容:',
			'class'=>'tbText pfocus',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'text', 'name', array(
			'label' => '*姓名:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'contactName', array(
			'label' => '*填报人:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName'
			)
		);
		$this->addElement(
			'textarea', 'remark', array(
			'label' => '备注:',
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
			'text', 'contactId', array(
			'filters' => array('StringTrim'),
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