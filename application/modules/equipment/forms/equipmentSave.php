<?php
/*
��е�豸��Ϣ��
author:mingtingling
date:2011-4-16
vision:2.0
*/
class Equipment_Forms_EquipmentSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$this->addElement(
		'text','name',array(
			'label'=>'��е�豸����:',
			'class'=>'tbLarge tbText',
			'required'=>true
		   )
		);
		$this->addElement(
		'select','typeId1',array(  /*������Ҫ��*/
			'label'=>'һ������:',
			'class'=>'tbLarge tbText',
			'required'=>true
		   )
		);
		$this->addElement(
		'select','typeId2',array(  /*������Ҫ��*/
			'label'=>'��������:',
			'class'=>'tbLarge tbText',
			'required'=>true
		   )
		);
		$this->addElement(
		'select','typeId3',array(  /*������Ҫ��*/
			'label'=>'��������:',
			'class'=>'tbLarge tbText',
			'required'=>true
		   )
		);		
		$this->addElement(
		'text','spec',array(
			'label'=>'����ͺ�:',
			'class'=>'tbLarge tbText',
			'required'=>false
		   )
		);
		$this->addElement(
		'text','unit',array(
			'label'=>'��λ:',
			'class'=>'tbLarge tbText',
			'required'=>true
		   )
		);
		$this->addElement(
		 'textarea','remark',array(
			'label'=>'��ע:',
			'class'=>'tbLarge tbText',
			'required'=>false,
			'rows'=>5,
			'cols'=>20
		   )
		);
        $this->addElement(
       /*��ťһ*/
          'submit','submit',array(
		    'ignore'=>true,
		    'class'=>'btConfirm radius',
            'name'=>'submit'
	       )
       );
        $this->addElement(
       /*��ť��*/
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