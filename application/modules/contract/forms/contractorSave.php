<?php
/*
author:ming tingling
create date:2011.4.4
review:mingtingling
date:2011.4.9
vision:2.0
*/
class Contract_Forms_ContractorSave extends Zend_Form
{
	 public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text','name',array(
			'label'=>'承包商名称:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'text','artiPerson',array(
			'label'=>'法定负责人:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText',
			'required'=>false
			)
		);
		$this->addElement(
			'text','licenseNo',array(
			'label'=>'许可证号:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required'=>false
			)
		);
		$this->addElement(
			'textarea','busiField',array(
			'label'=>'承包商业务范围:',
			'class'=>'tbText',
			'required'=> false,
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'text','phoneNo',array(
			'label'=>'联系电话:' ,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText',
			'required'=>false
			)
		);
		$this->addElement(
			'text','otherContact',array(
			'label'=>'其他联系方式:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required'=>false
			)
		);
		$this->addElement(
			'text','address',array(
			'label'=>'地址:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required'=>false
			)
		);
		$this->addElement(
			'textarea','remark',array(
			'label'=>'备注:',
			'class'=>'tbText',
			'required'=>false,
			'cols' => 60,
			'rows' => 4
			)
		);

		$this->addElement(
			/*按钮一*/
			'submit','submit',array(
			'ignore'=>true,
			'class'=>'btConfirm radius',
			'name'=>'submit'
			)
		);
		$this->addElement(
			/*按钮二*/
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