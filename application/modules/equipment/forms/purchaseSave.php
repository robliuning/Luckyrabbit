<?php
/*
��е�豸�ɹ������
author:mingtingling
date:2011-4-16
vision:2.0
*/
class Equipment_Forms_PurchaseSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$this->addElement(
		  'select','projectId',array(
			  'label'=>'��������:',
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
		  'select','buyerName',array(
			  'label'=>'�ɹ�Ա:',
			  'class'=>'tbLarge tbText ac_buyerName',
			  'required'=>true
		   )
		);
		$this->addElement(
		  'text','purDate',array(
			  'label'=>'�ɹ�����:',
			  'class'=>'tbLarge tbText datepicker',
			  'required'=>false
		   )
		);
		$this->addElement(
		  'select','planType',array(
			  'label'=>'�ƻ�����:',
			  'class'=>'tbLarge tbText',
			  'required'=>true,
			  'multiOptions'=>array('0'=>'�ռƻ�','1'=>'�ܼƻ�','2'=>'�¼ƻ�','3'=>'��ƻ�','4'=>'��Ŀ�ƻ�','5'=>'����')			
		   )
		);
		$this->addElement(
		  'select','approvName',array(
			  'label'=>'������:',
			  'class'=>'tbLarge tbText ac_contactName',
			  'required'=>true
		   )
		);
		$this->addElement(
		  'text','approvDate',array(
			  'label'=>'����ʱ��:',
			  'class'=>'tbLarge tbText datepicker',
			  'required'=>false
		   )
		);
		$this->addElement(
		  'select','destId',array(
			  'label'=>'����:',
			  'class'=>'tbLarge tbText',
			  'required'=>false
		   )
		);
		$this->addElement(
		   'text','freight',array(
			  'label'=>'�˷�:',
			  'class'=>'tbLarge tbText',
			  'required'=>false
		   )
		);
		$this->addElement(
		   'text','invoice',array(
			   'label'=>'ԭʼ�ɹ�����:',
			   'class'=>'tbLarge tbText',
			   'required'=>false
		   )
		);
		$this->addElement(
		    'text','total',array(
			   'label'=>'�ܽ��:',
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

			$this->addElement(
				'text','buyerId',array(
				'required' => true,
				'class'=>'hide ac_contactId'
				)
			);
			
			$this->addElement(
				'text','approvId',array(
				'required' => true,
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