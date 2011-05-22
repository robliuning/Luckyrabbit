<?php

class Admin_Form_Login extends Zend_Form
{

	public function init()
	{
		$this->setMethod('post');
		
		$this->addElement(
			'text','username',array(
			'label'=>'用户名: ',
			'filters'=>array('StringTrim','StringToLower'),
			'class'=>'tbLarge tbText pfocus'
			)
		);
		
		$this->addElement(
			'password', 'password', array(
			'label' => '登陆密码: ',
			'filters' => array('StringTrim'),
			'class'=>'tbLarge tbText'
			)
		);
	
		$this->addElement(
			'submit','submit',array(
			'ignore'=>true,
			'label'=>'登陆',
			'class'=>'btConfirm radius',
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