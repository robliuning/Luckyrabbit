<?php
//updated on 24th May by Rob

class Project_Forms_ProjectSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text', 'name', array(
			'label' => '*工程名称:',
			'class'=>'tbLarge tbText pfocus'
			)
		);
		$this->addElement(
			'text', 'address', array(
			'label' => '地址:',
			'filters' => array('StringTrim'),
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'select', 'status', array(
			'label' => '工程状况:',
			'multiOptions'=>array('未开工'=>'未开工', '建设中'=>'建设中', '已竣工'=>'已竣工'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'select', 'structype', array(
			'label' => '结构类型:',
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'level', array(
			'label' => '层数:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'period', array(
			'label' => '合同工期(天):',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'startDate', array(
			'label' => '*开工日期:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text', 'contactName', array(
			'label' => '*项目经理:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName'
			)
		);
		$this->addElement(
			'text', 'constructor', array(
			'label' => '建设单位:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'contractor', array(
			'label' => '工程承包单位:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'supervisor', array(
			'label' => '监理单位:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'designer', array(
			'label' => '设计单位:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'license', array(
			'label' => '*施工许可证编号:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'amount', array(
			'label' => '合同金额(元人民币):',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'constrArea', array(
			'label' => '建筑面积（平方米）:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
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