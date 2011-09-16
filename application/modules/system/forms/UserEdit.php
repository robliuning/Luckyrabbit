<?php
//updated on 24th May by Rob

class System_Forms_UserEdit extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		
		$this->addElement(
			'text', 'username', array(
			'class'=>'hide',
			'value'=>'forFirefoxBug'
			)
		);
		$this->addElement(
			'password', 'password_old', array(
			'label' => '*旧密码:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText pfocus'
			)
		);
		$this->addElement(
			'password', 'password', array(
			'label' => '*新密码(6位-12位):',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'password', 'password_repeat', array(
			'label' => '*重复密码:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
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