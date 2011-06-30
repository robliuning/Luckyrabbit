<?php
//updated on 24th May by Rob

class Pment_Forms_PlogSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text', 'logDate', array(
			'label' => '*日期:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'select', 'weatherAm', array(
			'label' => '天气(上午):',
			'multiOptions'=>array('晴'=>'晴','阴'=>'阴','多云'=>'多云','雨'=>'雨','小雨'=>'小雨','大雨'=>'大雨','阵雨'=>'阵雨','暴雨'=>'暴雨','雨夹雪'=>'雨夹雪','小雪'=>'小雪','大雪'=>'大雪','暴风雪'=>'暴风雪','沙尘暴'=>'沙尘暴','雾'=>'雾','大雾'=>'大雾'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'select', 'weatherPm', array(
			'label' => '天气(下午):',
			'multiOptions'=>array('晴'=>'晴','阴'=>'阴','多云'=>'多云','雨'=>'雨','小雨'=>'小雨','大雨'=>'大雨','阵雨'=>'阵雨','暴雨'=>'暴雨','雨夹雪'=>'雨夹雪','小雪'=>'小雪','大雪'=>'大雪','暴风雪'=>'暴风雪','沙尘暴'=>'沙尘暴','雾'=>'雾','大雾'=>'大雾'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'tempHi', array(
			'label' => '最高温度:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText pfocus'
			)
		);
		$this->addElement(
			'text', 'tempLo', array(
			'label' => '最低温度:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'part', array(
			'label' => '*施工部位:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'number', array(
			'label' => '施工人数:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'operator', array(
			'label' => '*负责操作人:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'foreman', array(
			'label' => '*责任工长:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'textarea', 'safety', array(
			'label' => '安全情况:',
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
			'label' => '解决问题:',
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'textarea', 'relatedFile', array(
			'label' => '往来文件:',
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'textarea', 'changeSig', array(
			'label' => '变更签证:',
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'textarea', 'material', array(
			'label' => '材料设备情况:',
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