<?php
/*
	Richard Song
	2011.4.27
*/
class Vehicle_Forms_VehicleSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text', 'plateNo', array(
			'label' => '车牌号:',
			'required' => true,
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'name', array(
			'label' => '车辆名称:',
			'required' => true,
			'filters' => array('StringTrim'),
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'color', array(
			'label' => '车辆颜色:',
			'required' => false,
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'license', array(
			'label' => '车辆行驶证号:',
			'required' => false,
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'contactName', array(
			'label' => '车辆负责人:',
			'required' => true,
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName'
			)
		);
		$this->addElement(
			'text', 'user', array(
			'label' => '主要使用人员:',
			'required' => false,
			'class'=>'tbLarge tbText'
			'filters' => array('StringTrim'),
			)
		);
		$this->addElement(
			'text', 'fuelCons', array(
			'label' => '标准油耗:',
			'required' => false,
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText',
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
			'text', 'contactId', array(
			'required' => true,
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