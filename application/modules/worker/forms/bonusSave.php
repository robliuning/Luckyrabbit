<?php
/*
	Richard Song
	2011.4.27
*/
class Worker_Forms_bonusSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text', 'name', array(
			'label' => '工人姓名:',
			'required' => true,
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText ac_workerName'
			)
		);
		$this->addElement(
			'select', 'projectId', array(
			'label' => '工程名称:',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'bonDate', array(
			'label' => '日期:',
			'required' => true,
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'select', 'typeId', array(
			'label' => '奖励类型:',
			'required' => true,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'textarea', 'detail', array(
			'label' => '详情:',
			'required' => false,
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'text', 'amount', array(
			'label' => '金额:',
			'required' => true,
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'textarea', 'remark', array(
			'label' => '备注:',
			'required' => false,
			'class'=>'tbText',
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
			'text', 'workerId', array(
			'required' => true,
			'class' => 'hide ac_workerId'
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