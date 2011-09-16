<?php
//updated on 24th May by Rob

class System_Forms_UserSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text', 'username', array(
			'label' => '*用户名:',
			'class'=>'tbMedium tbText pfocus'
			)
		);
		$this->addElement(
			'password', 'password', array(
			'label' => '*密码(6位-12位):',
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
			'select', 'groupId', array(
			'label' => '*所属用户组:',
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'contactName', array(
			'label' => '*真实姓名:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName'
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