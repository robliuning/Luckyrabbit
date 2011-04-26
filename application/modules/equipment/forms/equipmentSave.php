<?php
/*
机械设备信息表单
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
			'label'=>'机械设备名称:',
			'class'=>'tbLarge tbText',
			'required'=>true
		   )
		);
		$this->addElement(
		'select','typeId1',array(  /*可能需要改*/
			'label'=>'一级类型:',
			'class'=>'tbLarge tbText',
			'required'=>true
		   )
		);
		$this->addElement(
		'select','typeId2',array(  /*可能需要改*/
			'label'=>'二级类型:',
			'class'=>'tbLarge tbText',
			'required'=>true
		   )
		);
		$this->addElement(
		'select','typeId3',array(  /*可能需要改*/
			'label'=>'三级类型:',
			'class'=>'tbLarge tbText',
			'required'=>true
		   )
		);		
		$this->addElement(
		'text','spec',array(
			'label'=>'规格型号:',
			'class'=>'tbLarge tbText',
			'required'=>false
		   )
		);
		$this->addElement(
		'text','unit',array(
			'label'=>'单位:',
			'class'=>'tbLarge tbText',
			'required'=>true
		   )
		);
		$this->addElement(
		 'textarea','remark',array(
			'label'=>'备注:',
			'class'=>'tbLarge tbText',
			'required'=>false,
			'cols' => 60,
			'rows' => 20
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