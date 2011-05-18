<?php
//updated on 14th May By Rob
class Vehicle_Forms_VehicleSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text', 'plateNo', array(
			'label' => '*车牌号:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText pfocus'
			)
		);
		$this->addElement(
			'text', 'name', array(
			'label' => '*车辆名称:',
			'filters' => array('StringTrim'),
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'color', array(
			'label' => '车辆颜色:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'license', array(
			'label' => '车辆行驶证号:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'contactName', array(
			'label' => '*车辆负责人:',
			'filters' => array('StringTrim'),
			'class'=>'tbLarge tbText ac_contactName'
			)
		);
		$this->addElement(
			'text', 'pilotName', array(
			'label' => '*司机:',
			'filters' => array('StringTrim'),
			'class'=>'tbLarge tbText ac_pilotName'
			)
		);
		$this->addElement(
			'text', 'user', array(
			'label' => '主要使用人员:',
			'class'=>'tbLarge tbText',
			'filters' => array('StringTrim'),
			)
		);
		$this->addElement(
			'text', 'fuelCons', array(
			'label' => '标准油耗 (单位:升/100公里):',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText',
			'value'=>0
			)
		);
		$this->addElement(
			'text', 'price', array(
			'label' => '购买金额 (元-人民币):',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText',
			'value'=>0
			)
		);
		$this->addElement(
			'text', 'pDate', array(
			'label' => '购买时间:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText datepicker',
			)
		);
		$this->addElement(
			'text', 'brand', array(
			'label' => '购买品牌:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText',
			)
		);
		$this->addElement(
			'textarea', 'remark', array(
			'label' => '备注:',
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
		$this->addElement(
			'text', 'pilot', array(
			'class'=>'hide ac_pilot',
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