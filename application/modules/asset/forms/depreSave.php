<?php
/*
固定资产折旧表表单
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
			  'label'=>'固定资产购置名称:',
			  'class'=>'tbLarge tbText',
			  'required'=>true
		   )
		);
		$this->addElement(
		  'select','projectId',array(
			  'label'=>'工程名称:',
			  'class'=>'tbLarge tbText',
			  'required'=>true
		   )
		);
		$this->addElement(
		  'text','quantity',array(
			  'label'=>'数量:',
			  'class'=>'tbLarge tbText',
			  'required'=>true
		   )
		);
		$this->addElement(
		  'text','inDate',array(
			  'label'=>'进场日期:',
			  'class'=>'tbLarge tbText',
			  'required'=>true
		   )
		);
		$this->addElement(
		  'text','outDate',array(
			  'label'=>'出场日期:',
			  'class'=>'tbLarge tbText',
			  'required'=>true		
		   )
		);
		$this->addElement(
		  'text','depre',array(
			  'label'=>'折旧系数:',
			  'class'=>'tbLarge tbText',
			  'required'=>false
		   )
		);
		$this->addElement(
		  'text','depreAmt',array(
			  'label'=>'折旧金额:',
			  'class'=>'tbLarge tbText',
			  'required'=>false
		   )
		);
		$this->addElement(
		    'textarea','remark',array(
			    'label'=>'备注:',
			    'class'=>'tbLarge tbText',
			    'required'=>false,
			    'rows'=>5,
			    'cols'=>20
		   )
		);
        $this->addElement(
       /*按钮一*/
          'submit','submit',array(
		    'ignore'=>true,
		    'class'=>'btConfirm radius',
            'name'=>'submit'
	       )
       );
        $this->addElement(
       /*按钮二*/
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