<?php
//updated on 24th May by Rob

class Pment_Forms_MonprgSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

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
			'textarea', 'subTask', array(
			'label' => '*单项任务名称:',
			'class'=>'tbText pfocus',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'text', 'startDate', array(
			'label' => '*开始日期:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text', 'endDate', array(
			'label' => '*结束日期:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text', 'contactName', array(
			'label' => '*编制人:',
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