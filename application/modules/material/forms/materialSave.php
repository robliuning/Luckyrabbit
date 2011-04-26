<?php
	/*
	Created by Meimo
	Date 2011.4.14
	*/
class Material_Forms_MaterialSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text', 'name', array(
			'label' => '材料名称:',
			'required' => true,
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'typeName', array(
			'label' => '类型:',
			'required' => true,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'spec', array(
			'label' => '规格型号:',
			'required' => false,
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'unit', array(
			'label' => '单位:',
			'required' => true,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'total', array(
			'label' => '总金额:',
			'required' => false,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'textarea', 'remark', array(
			'label' => '备注:',
			'required' => false,			
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
			'text','typeId',array(
			'required' => true,
			'class'=>'hide'
			)
		);

		$this->setElementDecorators(array(
			'ViewHelper',
			'Errors',
			array(array('data'=>'HtmlTag'),
			array('tag'=>'td','class'=>'element')),
			array('Label',array('tag'=>'td')),
			array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
			)
		);

		$this->setDecorators(array(
			'FormElements',
			array('HtmlTag',array('tag'=>'table')),
			'Form'
			)
		);
	}
}
?>