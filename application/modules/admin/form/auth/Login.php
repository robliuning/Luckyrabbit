<?php

class Admin_Form_Auth_Login extends Zend_Form
{

    public function init()
    {
		$this->setMethod('post');
		
	/*	$uName = new Zend_Form_Element_Text('uName');
		$uName ->setLabel('用户名')
		->setRequired(true)
		->addFilter('StringTrim')
		->setAttribs(array('class'=>'testeasdfasdf'));
		$this->addElement($uName);
	
	*/	
		$this->addElement(
			'text','username',array(
			'label'=>'用户名: ',
			'required'=>true,
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			)
		);
		
		$this->addElement(
			'password', 'password', array(
			'label' => '密码: ',
			'required' => true,
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
    }


}

