<?php
//updated on 14th May By Rob
class Vehicle_Forms_RepairSave extends Zend_Form
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
			'text', 'rDate', array(
			'label' => '*车辆维修日期:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'textarea', 'reason', array(
			'label' => '损坏原因: ',
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'textarea', 'detail', array(
			'label' => '维修项目: ',
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'text', 'contactName', array(
			'label' => '*责任人:',
			'filters' => array('StringTrim'),
			'class'=>'tbLarge tbText ac_contactName'
			)
		);
		$this->addElement(
			'text', 'spot', array(
			'label' => '事故地点:',
			'filters' => array('StringTrim'),
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'textarea', 'descr', array(
			'label' => '事故描述: ',
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'text', 'amount', array(
			'label' => '*维修金额:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'select', 'insFlag', array(
			'label' => '*是否出险:',
			'class'=>'tbLarge tbText',
			'multiOptions'=> array('0'=>'未出险', '1'=>'出险')
			)
		);
		$this->addElement(
			'text', 'indem', array(
			'label' => '赔付金额:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText',
			'disabled' => 'disabled',
			'value' => '选择出险时填写'
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