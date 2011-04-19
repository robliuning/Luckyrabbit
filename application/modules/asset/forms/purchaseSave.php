<?php
/*
�̶��ʲ����ñ��
author:mingtingling
date:2011-4-17
vision:2.0
*/
class Asset_Forms_PurchaseSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$this->addElement(
		  'text','name',array(
			  'label'=>'�̶��ʲ�����:',
			  'class'=>'tbLarge tbText',
			  'required'=>true
		   )
		);
		$this->addElement(
		  'select','venId',array(
			  'label'=>'��Ӧ������:',
			  'class'=>'tbLarge tbText',
			  'required'=>true
		   )
		);
		$this->addElement(
		  'text','type',array(
			  'label'=>'�̶��ʲ����:',
			  'class'=>'tbLarge tbText',
			  'required'=>false
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
		  'text','invoice',array(
			  'label'=>'�̶��ʲ�����ԭʼ����:',
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
		  'text','price',array(
			  'label'=>'����:',
			  'class'=>'tbLarge tbText',
			  'required'=>false
		   )
		);
		$this->addElement(
		  'text','quantity',array(
			  'label'=>'����:',
			  'class'=>'tbLarge tbText',
			  'required'=>true
		   )
		);
		$this->addElement(
		   'text','amount',array(
			  'label'=>'���:',
			  'class'=>'tbLarge tbText',
			  'required'=>false
		   )
		);
		$this->addElement(
		   'select','contactId',array(
			   'label'=>'�ɹ�Ա:',
			   'class'=>'tbLarge tbText',
			   'required'=>false
		   )
		);
		$this->addElement(
		    'text','purDate',array(
			   'label'=>'�ɹ�����:',
			   'class'=>'tbLarge tbText',
			   'required'=>false
		   )
		);
		$this->addElement(
		    'select','approvId',array(
			   'label'=>'������:',
			   'class'=>'tbLarge tbText',
			   'required'=>false
		   )
		);
		$this->addElement(
		    'text','approvDate',array(
			   'label'=>'��������:',
			   'class'=>'tbLarge tbText',
			   'required'=>false
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