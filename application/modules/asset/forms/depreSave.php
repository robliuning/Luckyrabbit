<?php
/*
�̶��ʲ��۾ɱ��
author:mingtingling
date:2011-4-17
vision:2.0
*/
class Asset_Forms_DepreSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$this->addElement(
			'select','purId',array(
			'label'=>'�̶��ʲ���������:',
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'select','projectId',array(
			'label'=>'��������:',
			'class'=>'tbLarge tbText',
			'required'=>true
			)
		);
		$this->addElement(
			'text','quantity',array(
			'label'=>'����:',
			'class'=>'tb tbTeMediumxt',
			'required'=>true
			)
		);
		$this->addElement(
			'text','inDate',array(
			'label'=>'��������:',
			'class'=>'tbMedium tbText datepicker',
			'required'=>true
			)
		);
		$this->addElement(
			'text','outDate',array(
			'label'=>'��������:',
			'class'=>'tbMedium tbText datepicker',
			'required'=>true		
			)
		);
		$this->addElement(
			'text','depre',array(
			'label'=>'�۾�ϵ��:',
			'class'=>'tbMedium tbText',
			'required'=>false
			)
		);
		$this->addElement(
			'text','depreAmt',array(
			'label'=>'�۾ɽ��:',
			'class'=>'tbLarge tbText',
			'required'=>false
			)
		);
		$this->addElement(
			'textarea','remark',array(
			'label'=>'��ע:',
			'class'=>'tbLarge tbText',
			'required'=>false,
			'cols' => 60,
			'rows' => 20
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