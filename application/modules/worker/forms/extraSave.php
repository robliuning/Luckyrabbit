<?php
/*
	Richard Song
	2011.4.27
*/
class Worker_Forms_extraSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text', 'workerName', array(
			'label' => '工人姓名: ',
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
			'text', 'startDate', array(
			'label' => '开始日期:',
			'required' => true,			
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text', 'endDate', array(
			'label' => '结束日期:',
			'required' => true,
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text', 'cost', array(
			'label' => '派工费用:',
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
			'cols'=>60,
			'rows'=>4
			)
		);
		$this->addElement(
			'text', 'workerId', array(
			'required' => true,
			'class'=>'hide ac_workerId'
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