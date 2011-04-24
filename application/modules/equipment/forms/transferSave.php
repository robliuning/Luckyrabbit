<?php
/*
��е�豸���������
author:mingtingling
date:2011-4-17
vision:2.0
*/
class Equipment_Forms_TransferSave extends Zend_Form
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
		  'text','trsDate',array(
			  'label'=>'��������:',
			  'class'=>'tbLarge tbText datepicker',
			  'required'=>true
		   )
		);
		$this->addElement(
		  'select','origId',array(
			  'label'=>'����������:',
			  'class'=>'tbLarge tbText',
			  'required'=>true
		   )
		);
		$this->addElement(
		  'select','destId',array(
			  'label'=>'����Ŀ�ĵ�:',
			  'class'=>'tbLarge tbText',
			  'required'=>true
		   )
		);
		$this->addElement(
		  'select','applicName',array(
			  'label'=>'�걨��:',
			  'class'=>'tbLarge tbText ac_contactName',
			  'required'=>true
			)
		);
		$this->addElement(
		  'text','applicDate',array(
			  'label'=>'�걨����:',
			  'class'=>'tbLarge tbText datepicker',
			  'required'=>false
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
				'text','applicId',array(
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