<?php
/*
机械设备需求计划表单
author:mingtingling
date:2011-4-16
vision:2.0
*/
class Equipment_Forms_PlanSave extends Zend_Form
{
   public function init()
	{
	   $this->setMethod('post');
	   $this->addElement(
		'select','planType',array(
		    'label'=>'计划类型:',
		    'class'=>'tbLarge tbText',
		    'required'=>true,
		    'multiOptions'=> array('0'=>'日计划','1'=>'周计划','2'=>'月计划','3'=>'年计划','4'=>'项目计划','5'=>'其他')
	     )
	   );
	   $this->addElement(
		'text','dueDate',array(
		    'label'=>'计划到位时间:',
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
		'select','applicId',array(
		    'label'=>'申报人:',
		    'class'=>'tbLarge tbText',
		    'required'=>true
	     )
	   );
	   $this->addElement(
		'text','applicDate',array(
		    'label'=>'申报时间:',
		    'class'=>'tbLarge tbText',
		    'required'=>false
	     )
	   );
	   $this->addElement(
		'select','approvId',array(
		    'label'=>'审批人:',
		    'class'=>'tbLarge tbText',
		    'required'=>true
	     )
	   );
	   $this->addElement(
		'text','approvDate',array(
		    'label'=>'审批时间:',
		    'class'=>'tbLarge tbText',
		    'required'=>false
	     )
	   );
	   $this->addElement(
		'text','total',array(
		    'label'=>'总金额:',
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
       /*按钮一,清空*/
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
        $this->addElement(
       /*按钮三*/
          'submit','submit3',array(
		    'ignore'=>true,
		    'class'=>'btConfirm radius',
            'name'=>'submit'
	       )
       );
        $this->addElement(
       /*按钮四,返回*/
          'submit','submit4',array(
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