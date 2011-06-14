<?php
//update in 13th June by Rob

class Contract_Forms_ContractorSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text','name',array(
			'label'=>'*承包商名称:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			)
		);
		$this->addElement(
			'text','licenseNo',array(
			'label'=>'*安全生产许可证:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			)
		);
		$this->addElement(
			'textarea','busiField',array(
			'label'=>'业务范围:',
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'text','contact',array(
			'label'=>'*联系人:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText',
			)
		);
		$this->addElement(
			'text','phoneNo',array(
			'label'=>'*联系电话:' ,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText',
			)
		);
		$this->addElement(
			'text','otherContact',array(
			'label'=>'其他联系方式:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			)
		);
		$this->addElement(
			'text','address',array(
			'label'=>'地址:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			)
		);
		$this->addElement(
			'textarea','remark',array(
			'label'=>'备注:',
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