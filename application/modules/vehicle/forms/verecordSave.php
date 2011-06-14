<?php
//updated on 14th May By Rob

class Vehicle_Forms_VerecordSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'select', 'veId', array(
			'label' => '车牌号:',
			'class'=>'tbLarge tbText pfocus'
			)
		);
		$this->addElement(
			'text', 'startDate', array(
			'label' => '*出车日期:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text', 'endDate', array(
			'label' => '*还车日期:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'textarea', 'route', array(
			'label' => '行程: ',
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'text', 'mileBf', array(
			'label' => '*出车公里数:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'mileAf', array(
			'label' => '*还车公里数:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'textarea', 'purpose', array(
			'label' => '事由: ',
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'text', 'contactName', array(
			'label' => '*用(派)车人:',
			'filters' => array('StringTrim'),
			'class'=>'tbLarge tbText ac_contactName'
			)
		);
		$this->addElement(
			'text', 'user', array(
			'label' => '随车人员:',
			'filters' => array('StringTrim'),
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'mileRef', array(
			'label' => '加油登记公里数:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'amount', array(
			'label' => '加油金额:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'textarea', 'remark', array(
			'label' => '备注: ',
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
			'text', 'contactId', array(
			'class'=>'hide ac_contactId',
			)
		);
		$this->setElementDecorators(
			array(
				'ViewHelper',
				'Errors',
				array(array('data'=>'HtmlTag'),
				array('tag'=>'td','class'=>'element')),
				array('Label',array('tag'=>'td')),
				array(array('row'=>'HtmlTag'),array('tag'=>'tr')),
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