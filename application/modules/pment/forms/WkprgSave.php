<?php
//updated on 24th May by Rob

class Pment_Forms_WkprgSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text', 'wkNum', array(
			'label' => '周数:',
			'class'=>'tbMedium tbText',
			'disabled'=>'disabled'
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
			'textarea', 'wkPlan', array(
			'label' => '*本周计划完成:',
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'textarea', 'wkAct', array(
			'label' => '*本周实际完成:',
			'class'=>'tbText pfocus',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'textarea', 'nextPlan', array(
			'label' => '*下周计划完成:',
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'textarea', 'problem', array(
			'label' => '存在问题:',
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'textarea', 'resolve', array(
			'label' => '需解决问题:',
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
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