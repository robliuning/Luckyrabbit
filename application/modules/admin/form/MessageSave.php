<?php
//updated on 24th May by Rob

class Admin_Form_MessageSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'select', 'groupId', array(
			'label' => '*收件组:',
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'title', array(
			'label' => '*标题:',
			'filters' => array('StringTrim'),
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'textarea', 'content', array(
			'label' => '*内容:',
			'required' => false,
			'class'=>'tbText',
			'cols'=> 80,
			'rows'=> 15
			)
		);
		$this->addElement(
			'submit','submit',array(
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