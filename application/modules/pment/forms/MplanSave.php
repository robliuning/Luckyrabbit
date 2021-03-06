<?php
//updated in 4th July by Rob

class Pment_Forms_MplanSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text', 'planName', array(
			'label' => '材料计划名称:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText pfocus'
			)
		);
		$this->addElement(
			'select', 'typeId', array(
			'label' => '材料计划类型:',
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'select', 'yearNum', array(
			'label' => '年份:',
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'select', 'monNum', array(
			'label' => '月份:',
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'pDate', array(
			'label' => '填报日期:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'textarea', 'remark', array(
			'label' => '备注:',
			'class' => 'tbText',
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'submit', 'submit', array(
			'ignore' => true,
			'class' => 'btConfirm radius',
			'name' => 'submit'
			)
		);
		$this->addElement(
			'submit', 'submit2', array(
			'ignore' => true,
			'class' => 'btConfirm radius',
			'name' => 'submit'
			)
		);
		$this->setElementDecorators(
			array(
				'ViewHelper',
				'Errors',
				array(array('data' => 'HtmlTag'),
				array('tag' => 'td', 'class' => 'element')),
				array('Label', array('tag' => 'td')),
				array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
			)
		);
		$this->setDecorators(
			array(
				'FormElements',
				array('HtmlTag', array('tag' => 'table')),
				'Form'
			)
		);
	}
}
?>